<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignDefaultRole extends Command
{
    protected $signature = 'assign:default-role';
    protected $description = 'Assign a default role to users without roles';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // $usersWithoutRoles = User::doesntHave('roles')->get();
        $user = User::find(21);
        $defaultRole = Role::findByName('productManager'); // Replace 'default-role' with your desired role name
        $user->assignRole($defaultRole);

        // foreach ($usersWithoutRoles as $user) {
        //     $user->assignRole($defaultRole);
        //     $this->info("Assigned role to user: {$user->email}");
        // }

        $this->info('Default roles assigned successfully!');
    }
}
