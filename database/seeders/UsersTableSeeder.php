<?php
namespace Database\Seeders;

use App\Models\{User, Notice};
use Illuminate\Support\{Facades\Hash, Str};
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
        User::factory()->has(Notice::factory()->count(50))->create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::factory()->has(Notice::factory()->count(50))->count(10)->create();
    }
}
