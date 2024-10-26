<?php

namespace tyasa81\EzLoggable;

use tyasa81\EzLoggable\Repositories\LogRepository;

class EzLoggable
{
    protected LogRepository $logRepository;

    public function __construct(protected ?string $connection = null)
    {
        $this->logRepository = new LogRepository($connection);
    }

    public function log(int $user_id, string $loggable_type, int $loggable_id, string $acted_by_type, int $acted_by_id, string $action, string $column, string $before, string $after, ?string $description = null)
    {
        return $this->logRepository->create($user_id, $loggable_type, $loggable_id, $acted_by_type, $acted_by_id, $action, $column, $before, $after, $description);
    }
}
