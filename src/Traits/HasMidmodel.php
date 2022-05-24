<?php

namespace Dinhdjj\Midmodel\Traits;

use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property \Dinhdjj\Midmodel\Models\Midmodel $midmodel
 */
trait HasMidmodel
{
    protected static function bootHasMidmodel(): void
    {
        static::deleting(function (self $model): void {
            if (method_exists($model, 'isForceDeleting') ? $model->isForceDeleting() : true) {
                $model->midmodel->delete();
            }
        });
    }

    public function midmodel(): MorphOne
    {
        return $this->morphOne(config('midmodel.midmodel.model'), 'owner')->withDefault(fn () => $this->midmodel()->create());
    }
}
