<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear chached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // All permissions to create
        $permissions = [
            'user_management_access','permission_create','permission_edit','permission_show','permission_delete','permission_access','role_create','role_edit','role_show','role_delete','role_access','user_create','user_edit','user_show','user_delete','user_access','category_create','category_edit','category_show','category_delete','category_access','prompt_create','prompt_edit','prompt_show','prompt_delete','prompt_access','question_create','question_edit','question_show','question_delete','question_access','content_create','content_edit','content_show','content_delete','content_access','tone_create','tone_edit','tone_show','tone_delete','tone_access','answer_create','answer_edit','answer_show','answer_delete','answer_access','audit_log_show','audit_log_access','setting_edit','brand_edit','brand_access','setting_access','locale_create','locale_edit','locale_show','locale_delete','locale_access','chat_create','chat_edit','chat_show','chat_delete','chat_access','theme_create','theme_edit','theme_show','theme_delete','theme_access','page_create','page_edit','page_show','page_delete','page_access','section_create','section_edit','section_show','section_delete','section_access','component_create','component_edit','component_show','component_delete','component_access','chat_bot_create','chat_bot_edit','chat_bot_show','chat_bot_delete','chat_bot_access','content_page_create','content_page_edit','content_page_show','content_page_delete','content_page_access','menu_access','menu_create','menu_edit','menu_show','menu_delete','user_management_access'
        ];

        $roles = [
            'admin','user'
        ];
        $permissions = collect($permissions)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });
        $roles = collect($roles)->map(function ($role) {
            return ['name' => $role, 'guard_name' => 'web'];
        });

        $createPerimssions = Permission::insert($permissions->toArray());
        $createRoles = Role::insert($roles->toArray());

        $adminUser = User::find(User::STATIC_ADMIN_DATABASE_ID);
        $adminRole = Role::find(User::ROLE_ADMIN);
        $adminUser->assignRole($adminRole);
        $adminRole->givePermissionTo(Permission::get());        
    }
}
