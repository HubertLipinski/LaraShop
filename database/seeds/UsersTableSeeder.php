<?php

use App\Models\Cart;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            $admin = Role::where('name', 'admin')->firstOrFail();
            $user = Role::where('name', 'user')->firstOrFail();

            User::create([
                'name'           => 'Admin',
                'surname'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'email_verified_at' => Carbon::now(),
                'remember_token' => Str::random(60),
                'role_id'        => $admin->id,
            ]);

            User::create([
                'name'           => 'User',
                'surname'           => 'User',
                'email'          => 'user@user.com',
                'password'       => bcrypt('password'),
                'email_verified_at' => Carbon::now(),
                'remember_token' => Str::random(60),
                'role_id'        => $user->id
            ]);

        }
    }
}
