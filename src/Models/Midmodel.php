<?php

namespace Dinhdjj\Midmodel\Models;

use Dinhdjj\Midmodel\Enums\ActionStatus;
use Dinhdjj\Midmodel\Enums\MidmodelStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int                                                                                $id
 * @property \Dinhdjj\Midmodel\Enums\MidmodelStatus                                             $status
 * @property string                                                                             $description
 * @property int                                                                                $owner_id
 * @property string                                                                             $owner_type
 * @property \Illuminate\Database\Eloquent\Model                                                $owner
 * @property \Dinhdjj\Midmodel\Models\ExecutedAction[]|\Illuminate\Database\Eloquent\Collection $executedActions
 */
class Midmodel extends Model
{
    use HasFactory;

    protected $hidden = [];
    protected $fillable = ['status'];
    protected $appends = [];
    protected $casts = [
        'status' => MidmodelStatus::class,
    ];

    protected static function booted(): void
    {
        /** @infection-ignore-all */
        static::creating(function (self $midmodel): void {
            $midmodel->status ??= MidmodelStatus::SUCCESS;
        });

        static::deleting(function (self $midmodel): void {
            $midmodel->executedActions->each->delete();
        });
    }

    public function getTable()
    {
        return config('midmodel.midmodel.table');
    }

    public function owner(): MorphTo
    {
        return $this->morphTo();
    }

    public function executedActions(): HasMany
    {
        return $this->hasMany(config('midmodel.executed_action.model'));
    }

    public function refreshStatus(bool $save = true, array $saveOption = []): void
    {
        if (
            $this->executedActions()
                ->where('safe', false)
                ->whereIn('status', [ActionStatus::ERROR, ActionStatus::FAILED])
                ->exists()
        ) {
            $this->status = MidmodelStatus::FAILED;
        } elseif (
            $this->executedActions()
                ->where('safe', false)
                ->whereIn('status', [ActionStatus::PENDING, ActionStatus::DOING])
                ->exists()
        ) {
            $this->status = MidmodelStatus::DOING;
        } else {
            $this->status = MidmodelStatus::SUCCESS;
        }

        if ($save) {
            $this->save($saveOption);
        }
    }
}
