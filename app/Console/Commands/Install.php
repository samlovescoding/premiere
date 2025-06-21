<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Symfony\Component\Process\Process;

class Install extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kit:install {github_repository_url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Performs starter kit\'s first time installation. ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $githubRepositoryUrl = $this->argument('github_repository_url');

        $this->sh('git remote rename origin upstream');
        $this->sh('git remote add origin ' . $githubRepositoryUrl);
        $this->sh('git push -u origin main');
        $this->sh('cp .env.example .env');
        $this->sh('php artisan key:generate');
        $this->sh('php artisan migrate');
        $this->sh('php artisan storage:link');
        $this->sh('npm install');
        $this->sh('npm run build');
    }

    public function sh($command)
    {
        echo '$ ' . $command . '\n';
        $process = Process::fromShellCommandline($command);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
        echo $process->getOutput();
    }


    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'github_repository_url' => 'What is the GitHub repository URL?',
        ];
    }
}
