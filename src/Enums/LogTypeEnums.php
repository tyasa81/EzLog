<?php

namespace tyasa81\EzLoggable\Enums;

enum LogTypeEnums: string
{
    case CREATE = 'crt';
    case SET = 'set';
    case INCREASE = 'inc';
    case DECREASE = 'dec';
}
