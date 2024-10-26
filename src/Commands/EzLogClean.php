<?php

namespace tyasa81\EzLoggable\Commands;

use Illuminate\Console\Command;
use tyasa81\EzLoggable\Repositories\LogRepository;

class EzLogClean extends Command
{
    public $signature = 'ezlog:clean {--days=7} {--force}';

    public $description = 'Clean up the logs table';

    public function handle(): int
    {
        $wheres = [];
        
        $days = intval($this->option('days'));
        if($days > 0) {
            $wheres[] = ['created_at', '<', now()->subDays($days)];
        }

        $force = $this->option('force');
        if(!$force) {
            $answer = $this->ask('This will delete all logs older than ' . $days . ' days. Are you sure you want to continue? (y/N)', 'N');
            if($answer !== 'y' && $answer !== 'Y') {
                $this->info('Aborted');
                return self::FAILURE;
            }
        }

        $logRepository = new LogRepository();
        $logRepository->delete($wheres);

        return self::SUCCESS;
    }
}
