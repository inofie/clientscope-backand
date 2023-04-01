<?php

use Illuminate\Database\Seeder;

class DefaultDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->statusSeeder();
        $this->roleSeeder();
        $this->userSeeder();
        $this->userRoleSeeder();
    }

    private function statusSeeder()
    {
        \DB::table('status')->insert([
            [
                'company_user_id' => 0,
                'creator_user_id' => 0,
                'title'           => 'Active',
                'slug'            => str_slug('Active'),
                'type'            => 'default',
                'created_at'      => \Carbon\Carbon::now()
            ],
            [
                'company_user_id' => 0,
                'creator_user_id' => 0,
                'title'           => 'Disabled',
                'slug'            => str_slug('Disabled'),
                'type'            => 'default',
                'created_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }

    private function roleSeeder()
    {
        $status_id = get_status_id('active');
        \DB::table('roles')->insert([
            [
                'title'      => 'Super Admin',
                'slug'       => str_slug('Super Admin'),
                'status_id'  => $status_id,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'title'      => 'Company',
                'slug'       => str_slug('Company'),
                'status_id'  => $status_id,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'title'      => 'Team Lead',
                'slug'       => str_slug('Team Lead'),
                'status_id'  => $status_id,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'title'      => 'Sales Representative',
                'slug'       => str_slug('Sales Representative'),
                'status_id'  => $status_id,
                'created_at' => \Carbon\Carbon::now(),
            ]
        ]);
    }

    private function userSeeder()
    {
        \DB::table('users')->insert([
            'parent_id'        => 0,
            'name'             => 'Retro Cube',
            'username'         => str_slug('Retro Cube'),
            'email'            => 'admin@retrocube.com',
            'mobile_no'        => '1-8882051816',
            'password'         => \Illuminate\Support\Facades\Hash::make('admin@123'),
            'platform_type'    => 'custom',
            'is_mobile_verify' => 1,
            'is_email_verify'  => 1,
            'status_id'        => get_status_id('active'),
            'token'            => md5('admin@retrocube.com'),
            'created_at'       => \Carbon\Carbon::now(),

        ]);
    }

    private function userRoleSeeder()
    {
        $getUser = \DB::table('users')->where('email','admin@retrocube.com')->first();
        $getRole = \DB::table('roles')->where('slug','super-admin')->first();
        \DB::table('user_role')->insert([
            'user_id'    => $getUser->id,
            'role_id'    => $getRole->id,
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
