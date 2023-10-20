<?php

declare(strict_types=1);

namespace Watson\Validating;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

final class ValidatingObserver
{
    /**
     * Register the validation event for saving the model. Saving validation
     * should only occur if creating and updating validation does not.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return boolean
     */
    public function saving(Model $model)
    {
        return $this->performValidation($model, 'saving');
    }

    /**
     * Register the validation event for restoring the model.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return boolean
     */
    public function restoring(Model $model)
    {
        return $this->performValidation($model, 'restoring');
    }

    /**
     * Perform validation with the specified ruleset.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @param  string $event
     * @return boolean
     */
    private function performValidation(Model $model, $event)
    {
        // If the model has validating enabled, perform it.
        if ($model->getValidating()) {
            // Fire the namespaced validating event and prevent validation
            // if it returns a value.
            if (null !== $this->fireValidatingEvent($model, $event)) {
                return;
            }

            if (false === $model->isValid()) {
                // Fire the validating failed event.
                $this->fireValidatedEvent($model, 'failed');

                if ($model->getThrowValidationExceptions()) {
                    $model->throwValidationException();
                }

                return false;
            }
            // Fire the validating.passed event.
            $this->fireValidatedEvent($model, 'passed');
        } else {
            $this->fireValidatedEvent($model, 'skipped');
        }
    }

    /**
     * Fire the namespaced validating event.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @param  string $event
     * @return mixed
     */
    private function fireValidatingEvent(Model $model, $event)
    {
        return Event::until("eloquent.validating: ".get_class($model), [$model, $event]);
    }

    /**
     * Fire the namespaced post-validation event.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @param  string $status
     * @return void
     */
    private function fireValidatedEvent(Model $model, $status): void
    {
        Event::dispatch("eloquent.validated: ".get_class($model), [$model, $status]);
    }
}
