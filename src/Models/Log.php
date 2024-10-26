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

    public function trackable(): MorphTo
    {
        return $this->morphTo();
    }
}
