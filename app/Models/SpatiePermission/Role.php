<?php

namespace App\Models\SpatiePermission;

use \Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole {
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
