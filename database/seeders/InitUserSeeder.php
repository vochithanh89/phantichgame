<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;


class InitUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::call('permissions:sync');
        Permission::create(['name' => 'access-panel']);

        foreach (Role::$ROLES as $roleKey => $roleName) {
            $role = Role::create(['name' => $roleName]);
            switch ($roleKey) {
                case 'ADMIN':
                    $role->givePermissionTo(Permission::where('name', 'not like', '%Permission%')->where('name', 'not like', '%Role%')->get());
                    break;
                case 'CONTENT_CREATOR':
                    $role->givePermissionTo('access-panel');
                    $role->givePermissionTo(Permission::where('name', 'like', '%Blog%')->get());
                    break;
                case 'USER':
                    break;
            }
        }

        $users = [
            [
                'name' => 'CT03Dev',
                'email' => 'ct03dev@gmail.com',
                'password' => '$2y$10$0SicUU2o88MEBYHLq/Rp1e/mIJZRxf8/81Rbz2dZd1FFWRnddSG9i',
            ],
            [
                'name' => 'Bac Phan',
                'email' => 'bac.phan@beready.academy',
                'password' => '$2y$10$siDCJswaEOAEDxCzhktc6Ok6yQGmVgcHHMw64Zp7LKV5llxM1nvR2',
            ],
        ];
        foreach ($users as $userData) {
            $user = User::create($userData);
            $user->assignRole(Role::all());
        }
    }
}
