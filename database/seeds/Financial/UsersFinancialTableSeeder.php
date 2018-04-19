<?php
/**
 * Copyright (c) 2017 - 2017. Todos los derechos reservados. Ley N° 23 de 1982 Colombia.
 */

/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 21/07/2017
 * Time: 11:31 AM
 */

use App\Container\Financial\src\Constants\ConstantRoles;
use App\Container\Permissions\Src\Role;
use App\Container\Users\Src\User;
use \Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersFinancialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ConstantRoles::getRoleNames();

        /*
         * Teacher Role
         */
        factory(User::class)->create([
            'email' => 'teacher@app.com'
        ])->each( function (User $user) {
            $role = Role::select('id')->where('name', ConstantRoles::FINANCIAL_TEACHER_ROLE)->first();
            DB::connection('developer')
                ->table('role_user')
                ->insert([
                    'user_id' => $user->id,
                    'role_id' => $role->id,
                ]);
        });

        /*
         * Student Role
         */
        factory(User::class)->create([
            'email' => 'student@app.com'
        ])->each( function (User $user) {
            $role = Role::select('id')->where('name', ConstantRoles::FINANCIAL_STUDENT_ROLE)->first();
            DB::connection('developer')
                ->table('role_user')
                ->insert([
                    'user_id' => $user->id,
                    'role_id' => $role->id,
                ]);
        });

        /*
         * Secretary Role
         */
        factory(User::class)->create([
            'email' => 'secretary@app.com'
        ])->each( function (User $user) {
            $role = Role::select('id')->where('name', ConstantRoles::FINANCIAL_SECRETARY_ROLE)->first();
            DB::connection('developer')
                ->table('role_user')
                ->insert([
                    'user_id' => $user->id,
                    'role_id' => $role->id,
                ]);
        });

        /*
         * Financial Admin Role
         */
        factory(User::class)->create([
            'email' => 'admin@app.com'
        ])->each( function (User $user) {
            $role = Role::select('id')->where('name', ConstantRoles::FINANCIAL_ADMIN_ROLE)->first();
            DB::connection('developer')
                ->table('role_user')
                ->insert([
                    'user_id' => $user->id,
                    'role_id' => $role->id,
                ]);
        });

        /*
         * Random User Roles
         */
        factory( User::class, 20 )->create()->each( function (User $user) use ( $roles ) {
                $role = Role::select('id')->where('name', $roles[ rand(1, 4) ])->first();
                DB::connection('developer')
                    ->table('role_user')
                    ->insert([
                        'user_id' => $user->id,
                        'role_id' => $role->id,
                    ]);
            });

        /*
         * Random Teachers
         */
        factory(User::class, 20)->create()->each( function (User $user) {
            $role = Role::select('id')->where('name', ConstantRoles::FINANCIAL_TEACHER_ROLE)->first();
            DB::connection('developer')
                ->table('role_user')
                ->insert([
                    'user_id' => $user->id,
                    'role_id' => $role->id,
                ]);
        });
    }
}