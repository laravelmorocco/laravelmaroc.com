<?php

declare(strict_types=1);

namespace Rinvex\Support\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Rinvex\Support\Validators\UniqueWithValidator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;

final class SupportServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        // Add strip_tags validation rule
        Validator::extend('strip_tags', fn ($attribute, $value) => is_string($value) && strip_tags($value) === $value, trans('validation.invalid_strip_tags'));

        // Add time offset validation rule
        Validator::extend('timeoffset', fn ($attribute, $value) => array_key_exists($value, timeoffsets()), trans('validation.invalid_timeoffset'));

        Collection::macro('similar', fn (Collection $newCollection) => $newCollection->diff($this)->isEmpty() && $this->diff($newCollection)->isEmpty());

        // Add support for unique_with validator
        ValidatorFacade::extend('unique_with', UniqueWithValidator::class.'@validateUniqueWith', trans('validation.unique_with'));
        ValidatorFacade::replacer('unique_with', fn () => call_user_func_array([new UniqueWithValidator(), 'replaceUniqueWith'], func_get_args()));
    }
}
