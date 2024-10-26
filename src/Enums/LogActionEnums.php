<?php

namespace tyasa81\EzLoggable\Enums;

enum LogActionEnums: string
{
    case CREATE = 'crt';
    case SET = 'set';
    case INCREASE = 'inc';
    case DECREASE = 'dec';
}
