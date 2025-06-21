<?php

use App\Enums\RoleEnum;
use App\Models\SpatiePermission\Role;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        foreach (RoleEnum::cases() as $role) {
            Role::firstOrCreate([
                'name' => $role->value,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        foreach (RoleEnum::cases() as $role) {
            Role::where('name', $role->value)->delete();
        }
    }
};
