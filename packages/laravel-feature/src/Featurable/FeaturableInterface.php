<?php

declare(strict_types=1);

namespace LaravelFeature\Featurable;

interface FeaturableInterface
{
    public function hasFeature($featureName);
}
