<?php

namespace Dinhdjj\Midmodel\Commands;

use Illuminate\Console\Command;

class MidmodelCommand extends Command
{
    public $signature = 'midmodel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
