<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        foreach (\App\Support\Role::ALL as $role) {
            if ($role == \App\Support\Role::ADMIN) {
                User::create([
                    'name' => "ADMIN",
                    'email' => "admin@bagasku.com",
                    'password' => bcrypt('secret'),
                    'role' => $role
                ]);
            } elseif ($role == \App\Support\Role::ROOT) {
                User::create([
                    'name' => "ADMIN",
                    'email' => "root@bagasku.com",
                    'password' => bcrypt('secret'),
                    'role' => $role
                ]);

            } elseif ($role == \App\Support\Role::OTHER) {
                for ($c = 0; $c < (($role == \App\Support\Role::OTHER) ? 10 : 2); $c++) {
                    $user = User::create([
                        'name' => $faker->name,
                        'email' => $faker->safeEmail,
                        'password' => bcrypt('secret'),
                        'role' => $role
                    ]);

                    \App\Model\Bio::create([
                        'user_id' => $user->id
                    ]);

                    \App\Model\Project::create([
                        'user_id' => $user->id,
                        'judul' => Factory::create()->jobTitle,
                        'deskripsi' => '<ul><li>' . $faker->sentence($nbWords = 10, $variableNbWords = true) .
                            '</li></ul>',
                        'waktu_pengerjaan' => rand(1, 10),
                        'harga' => $faker->numerify('########'),
                        'pribadi' => false,
                        'subkategori_id' => rand(\App\Model\SubKategori::min('id'),\App\Model\SubKategori::max('id'))
                    ]);


                }
            }
        }
    }
}