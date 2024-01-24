<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Run the migrations.
     */
    public function up(): void
    {
        $admin_role = Role::factory()->create(['name' => 'admin']);

        $user_data = config('auth.admin_credentials');
        $user_data['role_id'] = $admin_role->id;

        User::factory()->create($user_data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $admin_user = User::query()->where('email', config('auth.admin_credentials.email'))->first();

        if ($admin_user) $admin_user->delete();

        $admin_role = Role::query()->where('name', 'admin')->first();

        if ($admin_role) $admin_role->delete();
    }
};
