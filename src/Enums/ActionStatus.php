<?php

namespace Dinhdjj\Midmodel\Enums;

enum ActionStatus:int
{
    case PENDING = 4; // The action is pending to perform
    case DOING = 0; // The action is doing
    case SUCCESS = 1; // The action is success
    case FAILED = 2; // The action is failed
    case ERROR = 3; // The action is system error
    case CANCELED = 5; // The action is canceled
}
