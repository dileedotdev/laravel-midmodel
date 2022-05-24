<?php

use Dinhdjj\Midmodel\Database\Factories\ActionFactory;
use Dinhdjj\Midmodel\Database\Factories\ExecutedActionFactory;
use Dinhdjj\Midmodel\Database\Factories\MidmodelFactory;
use Dinhdjj\Midmodel\Models\Action;
use Dinhdjj\Midmodel\Models\ExecutedAction;
use Dinhdjj\Midmodel\Models\Midmodel;
use Dinhdjj\Midmodel\Tests\Account;
use Dinhdjj\Midmodel\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function factoryMidmodel($owner = null): MidmodelFactory
{
    return Midmodel::factory()->for($owner ?? Account::create(), 'owner');
}

function factoryAction(): ActionFactory
{
    return Action::factory();
}

function factoryExecutedAction($midmodel = null, $action = null): ExecutedActionFactory
{
    return ExecutedAction::factory()->for($midmodel ?? factoryMidmodel())->for($action ?? factoryAction());
}
