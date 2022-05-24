<?php

namespace Dinhdjj\Midmodel\Enums;

enum MidmodelStatus:int
{
    case DOING = 0; // The action is doing
    case SUCCESS = 1; // The action is success
    case FAILED = 2; // The action is failed
}
