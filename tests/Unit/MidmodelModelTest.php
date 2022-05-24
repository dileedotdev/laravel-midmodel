<?php

use Dinhdjj\Midmodel\Enums\ActionStatus;
use Dinhdjj\Midmodel\Enums\MidmodelStatus;
use Dinhdjj\Midmodel\Models\ExecutedAction;
use Dinhdjj\Midmodel\Models\Midmodel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

beforeEach(function (): void {
    $this->midmodel = factoryMidmodel()
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

it('has a owner', function (): void {
    expect($this->midmodel->owner)->toBeInstanceOf(Model::class);
});

it('has executed actions', function (): void {
    expect($this->midmodel->executedActions[0])->toBeInstanceOf(ExecutedAction::class);
    expect($this->midmodel->executedActions)->toHaveCount(ExecutedAction::count());
    expect($this->midmodel->executedActions[4]->id)->toBe(5);
});

it('delete executed actions on deleting', function (): void {
    expect(ExecutedAction::count())->toBe(14);
    $this->midmodel->delete();
    expect(ExecutedAction::count())->toBe(0);
});

test('its refreshStatus method is working', function (): void {
    Event::fake();

    /** @var Midmodel */
    $midmodel = factoryMidmodel()->create();
    expect($midmodel->status)->toBe(MidmodelStatus::SUCCESS);

    factoryExecutedAction($midmodel)->create([
        'status' => ActionStatus::PENDING,
    ]);
    $midmodel->refreshStatus();
    expect($midmodel->refresh()->status)->toBe(MidmodelStatus::DOING);

    ExecutedAction::query()->delete();
    factoryExecutedAction($midmodel)->create([
        'status' => ActionStatus::DOING,
    ]);
    $midmodel->refreshStatus();
    expect($midmodel->status)->toBe(MidmodelStatus::DOING);

    factoryExecutedAction($midmodel)->create([
        'status' => ActionStatus::FAILED,
    ]);
    $midmodel->refreshStatus();
    expect($midmodel->status)->toBe(MidmodelStatus::FAILED);

    ExecutedAction::query()->delete();
    factoryExecutedAction($midmodel)->create([
        'status' => ActionStatus::ERROR,
    ]);
    $midmodel->refreshStatus();
    expect($midmodel->status)->toBe(MidmodelStatus::FAILED);

    ExecutedAction::query()->delete();
    factoryExecutedAction($midmodel)->create([
        'status' => ActionStatus::SUCCESS,
    ]);
    $midmodel->refreshStatus();
    expect($midmodel->status)->toBe(MidmodelStatus::SUCCESS);

    factoryExecutedAction($midmodel)->create([
        'status' => ActionStatus::FAILED,
        'safe' => true,
    ]);
    $midmodel->refreshStatus();
    expect($midmodel->status)->toBe(MidmodelStatus::SUCCESS);
});

test('its refreshStatus with save arg is false', function (): void {
    Event::fake();

    /** @var Midmodel */
    $midmodel = factoryMidmodel()->create();
    expect($midmodel->status)->toBe(MidmodelStatus::SUCCESS);

    factoryExecutedAction($midmodel)->create([
        'status' => ActionStatus::PENDING,
    ]);
    $midmodel->refreshStatus(false);
    expect($midmodel->status)->toBe(MidmodelStatus::DOING);
    expect($midmodel->refresh()->status)->toBe(MidmodelStatus::SUCCESS);
});
