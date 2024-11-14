<?php

namespace tyasa81\EzLoggable\Repositories;

use tyasa81\DbRepositories\EloquentTrait;
use tyasa81\DbRepositories\RepositoryInterface;
use tyasa81\EzLoggable\Models\Log;

class LogRepository implements RepositoryInterface
{
    use EloquentTrait;

    private $model;

    public function __construct(?string $connector = null)
    {
        $this->model = new Log;
        if ($connector) {
            $this->model = $this->model->on($connector);
        }
    }

    public function create(int $user_id, string $loggable_type, int $loggable_id, string $acted_by_type, int $acted_by_id, string $action, string $column, ?string $before = null, ?string $after = null, ?string $description = null)
    {
        return $this->model->create([
            'user_id' => $user_id,
            'loggable_type' => $loggable_type,
            'loggable_id' => $loggable_id,
            'acted_by_type' => $acted_by_type,
            'acted_by_id' => $acted_by_id,
            'action' => $action,
            'column' => $column,
            'before' => $before,
            'after' => $after,
            'description' => $description,
        ]);
    }
}
