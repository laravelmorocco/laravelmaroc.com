<?php

declare(strict_types=1);

namespace LaravelFeature\Featurable;

use LaravelFeature\Model\Feature as FeatureModel;
use LaravelFeature\Model\Feature;

trait Featurable
{
    public function hasFeature($featureName)
    {
        $model = FeatureModel::where('name', '=', $featureName)->first();

        if (true === (bool) $model->is_enabled) {
            return true;
        }

        $feature = $this->features()->where('name', '=', $featureName)->first();
        return ($feature) ? true : false;
    }

    public function features()
    {
        return $this->morphToMany(Feature::class, 'featurable');
    }
}
