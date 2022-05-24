<?php

// config for dinhdjj/laravel-midmodel

return [
    /**
     * Related to Midmodel model.
     */
    'midmodel' => [
        'model' => \Dinhdjj\Midmodel\Models\Midmodel::class,
        'table' => 'midmodels',
    ],

    /**
     * Related to Action model.
     */
    'action' => [
        'model' => \Dinhdjj\Midmodel\Models\Action::class,
        'table' => 'midmodel_actions',
    ],

    /**
     * Related to ExecutedAction model, The executed action is a given pending/doing/done/failed/error/canceled/... action.
     */
    'executed_action' => [
        'model' => \Dinhdjj\Midmodel\Models\ExecutedAction::class,
        'table' => 'midmodel_executed_actions',
    ],
];
