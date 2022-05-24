<?php

use Dinhdjj\Midmodel\Models\Midmodel;
use Dinhdjj\Midmodel\Tests\Account;
use Dinhdjj\Midmodel\Tests\SoftDeletesAccount;
use function Pest\Laravel\assertDatabaseCount;

it('auto create midmodel if not exists ', function (): void {
    $account = Account::create();
    assertDatabaseCount('midmodels', 0);

    expect($account->midmodel)->toBeInstanceOf(Midmodel::class);
    expect($account->midmodel->owner)->toBeInstanceOf(Account::class);
    assertDatabaseCount('midmodels', 1);
});

it('delete midmodel when deleting', function (): void {
    $account = Account::create();
    $account->midmodel;
    assertDatabaseCount('midmodels', 1);
    $account->delete();
    assertDatabaseCount('midmodels', 0);
});

it('does not delete midmodel when soft deleting', function (): void {
    $account = SoftDeletesAccount::create();
    $account->midmodel;
    assertDatabaseCount('midmodels', 1);
    $account->delete();
    assertDatabaseCount('midmodels', 1);
});

it('delete midmodel when force deleting', function (): void {
    $account = SoftDeletesAccount::create();
    $account->midmodel;
    assertDatabaseCount('midmodels', 1);
    $account->forceDelete();
    assertDatabaseCount('midmodels', 0);
});
