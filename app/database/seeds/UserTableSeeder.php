<?php
/**
 * Created by PhpStorm.
 * User: Dude
 * Date: 26.07.14
 * Time: 15:36
 */

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
            'username'      => 'fgreinus',
            'email'         => 'florian.greinus@gmail.com',
            'ldapdn'      => 'cn=fgreinus fgreinus,ou=people,ou=tbc,ou=development,dc=rising-gods,dc=de',
        ));
    }
}
