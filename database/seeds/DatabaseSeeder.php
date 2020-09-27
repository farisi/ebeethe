<?php

use Illuminate\Database\Seeder;
use App\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $user = DB::table('users')->insert([
            'name'=>'Administrator',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('p455w0rd'),
        ]);

        $roleAdm = Role::create([
            'name'=>'admin',
            'display_name'=>'Administrator'
        ]);

        $roleOpr = Role::create([
            'name'=>'operator',
            'display_name'=>'Operator'
        ]);

        $user->roles->attach([$roleAdm->id]);
    }
}
