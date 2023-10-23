<?php

namespace Harmony\Sail\Console;

use G4T\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sail:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the Harmony Sail Docker files';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('vendor:publish', ['--tag' => 'sail-docker']);
        $this->call('vendor:publish', ['--tag' => 'sail-database']);

        file_put_contents(
            $this->Harmony->basePath('docker-compose.yml'),
            str_replace(
                [
                    './vendor/Harmony/sail/runtimes/8.3',
                    './vendor/Harmony/sail/runtimes/8.2',
                    './vendor/Harmony/sail/runtimes/8.1',
                    './vendor/Harmony/sail/runtimes/8.0',
                    './vendor/Harmony/sail/database/mysql',
                    './vendor/Harmony/sail/database/pgsql'
                ],
                [
                    './docker/8.3',
                    './docker/8.2',
                    './docker/8.1',
                    './docker/8.0',
                    './docker/mysql',
                    './docker/pgsql'
                ],
                file_get_contents($this->Harmony->basePath('docker-compose.yml'))
            )
        );
    }
}
