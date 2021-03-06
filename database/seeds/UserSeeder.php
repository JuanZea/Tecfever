<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 29;

        App\User::create([
        'is_enabled' => true,
        'name' => 'Juan David',
        'surname' => 'Zea Acevedo',
        'document' => '1007238750',
        'document_type' => 'CC',
        'mobile' => '3218876733',
        'email' => 'j@admin.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'api_token' => Str::random(60),
        ])->assignRole('admin'); // Admin Power

        $users = factory(App\User::class)->times($count)->create();

        // Assign roles
        foreach ($users as $user) {
            if (rand(0, 9) == 0) {
                $user->assignRole('admin');
            } else {
                $user->assignRole('user');
            }
        }

        // Assign shopping carts
        for ($idx = 1; $idx <= $count; $idx++) {
            factory(App\ShoppingCart::class)->create([
                'user_id' => $idx
            ]);
        }
    }
}
