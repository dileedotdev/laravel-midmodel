<?php

namespace Dinhdjj\Midmodel\Models;

use Dinhdjj\Midmodel\Enums\ActionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int                                  $id
 * @property bool                                 $safe
 * @property string[]                             $required_infos
 * @property string[]                             $result_infos
 * @property \Dinhdjj\Midmodel\Enums\ActionStatus $status
 * @property string                               $description
 * @property \Dinhdjj\Midmodel\Models\Midmodel    $midmodel
 * @property \Dinhdjj\Midmodel\Models\Action      $action
 */
class ExecutedAction extends Model
{
    use HasFactory;

    protected $hidden = ['required_infos', 'result_infos'];
    protected $fillable = ['safe', 'required_infos', 'result_infos', 'status', 'description'];
    protected $appends = [];
    protected $casts = [
        'status' => ActionStatus::class,
        'required_infos' => 'array',
        'result_infos' => 'array',
    ];

    protected static function booted(): void
    {
        /** @infection-ignore-all */
        static::creating(function (self $action): void {
            $action->status ??= ActionStatus::DOING;
            $action->safe ??= false;
        });
    }

    public function getTable()
    {
        return config('midmodel.executed_action.table');
    }

    public function midmodel(): BelongsTo
    {
        return $this->belongsTo(config('midmodel.midmodel.model'));
    }

    public function action(): BelongsTo
    {
        return $this->belongsTo(config('midmodel.action.model'));
    }
}
