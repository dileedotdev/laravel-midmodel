<?php

use Dinhdjj\Midmodel\Enums\ActionStatus;
use Dinhdjj\Midmodel\Models\ExecutedAction;

beforeEach(function (): void {
    $this->action = factoryAction()
        ->has(factoryExecutedAction()->count(5)->state([
            'status' => ActionStatus::DOING,
        ]))
        ->has(factoryExecutedAction()->count(4)->state([
            'status' => ActionStatus::SUCCESS,
        ]))
        ->has(factoryExecutedAction()->count(3)->state([
            'status' => ActionStatus::FAILED,
        ]))
        ->has(factoryExecutedAction()->count(2)->state([
            'status' => ActionStatus::ERROR,
        ]))
        ->create()
    ;
});

it('has executed actions', function (): void {
    expect($this->action->executedActions[0])->toBeInstanceOf(ExecutedAction::class);
    expect($this->action->executedActions)->toHaveCount(ExecutedAction::count());
    expect($this->action->executedActions[4]->id)->toBe(5);
});
