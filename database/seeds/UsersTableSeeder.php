<?php

use Illuminate\Database\Seeder;

/*
 * Modelos
 */
use App\Container\Users\Src\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( User::class, 1 )->create([
            'name' => 'root',
            'email' => 'root@app.com',
            'password' => bcrypt('root'),
        ]);
    }
}
