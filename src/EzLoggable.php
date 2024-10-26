<?php

namespace tyasa81\EzLoggable;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use tyasa81\EzLoggable\Repositories\LogRepository;

class EzLoggable
{
    protected LogRepository $logRepository;

    public function __construct(protected ?string $connection = null)
    {
        $this->logRepository = new LogRepository($connection);
    }

    public function log(int $user_id, Model|Authenticatable $loggable, Model|Authenticatable $acted_by, string $action, string $column, string $before, string $after, ?string $description = null)
    {
        return $this->logRepository->create($user_id, $loggable->getMorphClass(), $loggable->id, $acted_by->getMorphClass(), $acted_by->id, $action, $column, $before, $after, $description);
    }
}
