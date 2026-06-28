<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class PintCommand extends Command
{
    protected $signature = 'pint';

    protected $description = 'Run Laravel Pint using the project binary.';

    public function handle(): int
    {
        $binary = base_path('vendor/bin/pint');

        $process = new Process([PHP_BINARY, $binary], base_path());
        $process->setTimeout(null);
        $process->run(function (string $type, string $buffer): void {
            $this->output->write($buffer);
        });

        return $process->getExitCode() ?? self::FAILURE;
    }
}
