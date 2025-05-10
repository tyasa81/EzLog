<?php

namespace tyasa81\EzLoggable\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Log extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function loggable(): MorphTo
    {
        return $this->morphTo();
    }

    public function acted_by(): MorphTo
    {
        return $this->morphTo();
    }
}
