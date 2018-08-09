<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User([
            'name'     => 'admin',
            'email'    => 'admin@usacademy.cz',
            'password' => '$2y$10$MLvKfgyOfWy7pmyrbxSO6.p0BUHfNub56kBeIaURDFLYyvQKyKFou',
        ]);

        $user->save();
    }
}
