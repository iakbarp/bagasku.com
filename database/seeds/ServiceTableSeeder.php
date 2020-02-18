<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        foreach (User::where('role', \App\Support\Role::OTHER)->get() as $user) {
            \App\Model\Services::create([
                'user_id' => $user->id,
                'subkategori_id' => rand(\App\Model\SubKategori::min('id'), \App\Model\SubKategori::max('id')),
                'harga' => $faker->numerify('########'),
                'deskripsi' => '<p>' . $faker->paragraph . '</p>',
                'hari_pengerjaan' => rand(1, 30),
                'judul' => Factory::create()->jobTitle,
            ]);
        }
    }
}