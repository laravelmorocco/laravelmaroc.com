<?php

declare(strict_types=1);

namespace LaravelFeature\Repository;

use LaravelFeature\Domain\Exception\FeatureException;
use LaravelFeature\Domain\Repository\FeatureRepositoryInterface;
use LaravelFeature\Domain\Model\Feature;
use LaravelFeature\Featurable\FeaturableInterface;
use LaravelFeature\Model\Feature as Model;
use Exception;

final class EloquentFeatureRepository implements FeatureRepositoryInterface
{
    public function save(Feature $feature): void
    {
        /** @var Model $model */
        $model = Model::where('name', '=', $feature->getName())->first();

        if ( ! $model) {
            $model = new Model();
        }

        $model->name = $feature->getName();
        $model->is_enabled = $feature->isEnabled();

        try {
            $model->save();
        } catch (Exception $e) {
            throw new FeatureException('Unable to save the feature: '.$e->getMessage());
        }
    }

    public function remove(Feature $feature): void
    {
        /** @var Model $model */
        $model = Model::where('name', '=', $feature->getName())->first();
        if ( ! $model) {
            throw new FeatureException('Unable to find the feature.');
        }

        $model->delete();
    }

    public function findByName($featureName)
    {
        /** @var Model $model */
        $model = Model::where('name', '=', $featureName)->first();
        if ( ! $model) {
            throw new FeatureException('Unable to find the feature.');
        }

        return Feature::fromNameAndStatus(
            $model->name,
            $model->is_enabled
        );
    }

    public function enableFor($featureName, FeaturableInterface $featurable): void
    {
        /** @var Model $model */
        $model = Model::where('name', '=', $featureName)->first();
        if ( ! $model) {
            throw new FeatureException('Unable to find the feature.');
        }

        if (true === (bool) $model->is_enabled || true === $featurable->hasFeature($featureName)) {
            return;
        }

        $featurable->features()->attach($model->id);
    }

    public function disableFor($featureName, FeaturableInterface $featurable): void
    {
        /** @var Model $model */
        $model = Model::where('name', '=', $featureName)->first();
        if ( ! $model) {
            throw new FeatureException('Unable to find the feature.');
        }

        if (true === (bool) $model->is_enabled || false === $featurable->hasFeature($featureName)) {
            return;
        }

        $featurable->features()->detach($model->id);
    }

    public function isEnabledFor($featureName, FeaturableInterface $featurable)
    {
        /** @var Model $model */
        $model = Model::where('name', '=', $featureName)->first();
        if ( ! $model) {
            throw new FeatureException('Unable to find the feature.');
        }

        return ($model->is_enabled) ? true : $featurable->hasFeature($featureName);
    }
}
