<?php

namespace Jameron\Regulator\database\seeds;

use Illuminate\Database\Seeder;

class RegulatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an admin role
        $user_model = config('regulator.user_model_class');

        $admin_user = factory($user_model, 'admin')->create();
        $user = factory($user_model, 'user')->create();

        $admin_role = factory(\Jameron\Regulator\Models\Role::class, 'admin')->create();
        $user_role = factory(\Jameron\Regulator\Models\Role::class, 'user')->create();

        $admin_role->assignUser($admin_user);
        $user_role->assignUser($user);

        // Admin user permissions
        $view_admin_dashboard_permission = factory(\Jameron\Regulator\Models\Permission::class, 'view_admin_dashboard')->create();
        $manage_users_permission = factory(\Jameron\Regulator\Models\Permission::class, 'manage_users')->create();
        $manage_roles_permission = factory(\Jameron\Regulator\Models\Permission::class, 'manage_roles_permissions')->create();
        $view_system_wide_reports_permission = factory(\Jameron\Regulator\Models\Permission::class, 'view_system_wide_reports')->create();

        // User permissions
        $view_user_dashboard_permission = factory(\Jameron\Regulator\Models\Permission::class, 'view_user_dashboard')->create();
        $edit_account_info_permission = factory(\Jameron\Regulator\Models\Permission::class, 'edit_account_info')->create();

        // Admin user permissions
        $admin_role->givePermissionTo($view_admin_dashboard_permission);
        $admin_role->givePermissionTo($manage_users_permission);
        $admin_role->givePermissionTo($manage_roles_permission);
        $admin_role->givePermissionTo($view_system_wide_reports_permission);
        $admin_role->givePermissionTo($edit_account_info_permission);

        // User permissions
        $user_role->givePermissionTo($view_user_dashboard_permission);
        $user_role->givePermissionTo($edit_account_info_permission);

        return $this;
    }
}
