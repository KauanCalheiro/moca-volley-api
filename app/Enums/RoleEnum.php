<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN     = 'admin';
    case MANAGER   = 'manager';
    case PLAYER    = 'player';
    case SPECTATOR = 'spectator';
}
