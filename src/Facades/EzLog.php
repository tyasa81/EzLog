<?php

namespace tyasa81\EzLoggable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \tyasa81\EzLoggable\EzLoggable
 * 
 * @method static log(int $user_id, string $loggable_type, int $loggable_id, string $acted_by_type, int $acted_by_id, string $action, string $column, string $before = "", string $after, string $description = null)
 * 
 */
class EzLog extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \tyasa81\EzLoggable\EzLoggable::class;
    }
}
