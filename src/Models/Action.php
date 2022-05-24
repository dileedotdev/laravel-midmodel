<?php

namespace Dinhdjj\Midmodel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int                                                                                $id
 * @property string                                                                             $name
 * @property bool                                                                               $safe
 * @property string                                                                             $description
 * @property string[]                                                                           $required_info_names
 * @property string[]                                                                           $result_info_names
 * @property string                                                                             $job
 * @property \Dinhdjj\Midmodel\Models\ExecutedAction[]|\Illuminate\Database\Eloquent\Collection $executedActions
 */
class Action extends Model
{
    use HasFactory;

    protected $hidden = [];
    protected $fillable = ['name', 'description', 'safe', 'required_info_names', 'result_info_names', 'job'];
    protected $appends = [];
    protected $casts = [
        'required_info_names' => 'array',
        'result_info_names' => 'array',
    ];

    protected static function booted(): void
    {
        /** @infection-ignore-all */
        static::creating(function (self $action): void {
            $action->required_info_names ??= [];
            $action->result_info_names ??= [];
            $action->safe ??= false;
        });
    }

    public function getTable()
    {
        return config('midmodel.action.table');
    }

    public function executedActions(): HasMany
    {
        return $this->hasMany(config('midmodel.executed_action.model'));
    }
}
