<?php

namespace App\Models\SpatiePermission;

use \Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission {
    public $hidden = [
        'created_at',
        'updated_at',
    ];
}
