<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Super Admin
        \App\Models\Admin::firstOrCreate(
            ['email' => 'admin@nccc.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('admin123'),
            ]
        );

        // 2. Seed Test Users and Memberships
        
        // Bronze member - expiring soon (active)
        $user1 = \App\Models\User::firstOrCreate(
            ['email' => 'bronze@example.com'],
            ['name' => 'Bronze Member', 'password' => bcrypt('password')]
        );
        \App\Models\Membership::updateOrCreate(
            ['user_id' => $user1->id],
            [
                'tier' => 'Bronze',
                'points' => 250,
                'expires_at' => now()->addDays(14),
                'last_renewed_at' => now()->subMonths(11.5),
                'status' => 'active',
            ]
        );
 
        // Silver member - already expired
        $user2 = \App\Models\User::firstOrCreate(
            ['email' => 'silver@example.com'],
            ['name' => 'Silver Member', 'password' => bcrypt('password')]
        );
        \App\Models\Membership::updateOrCreate(
            ['user_id' => $user2->id],
            [
                'tier' => 'Silver',
                'points' => 1200,
                'expires_at' => now()->subDays(5),
                'last_renewed_at' => now()->subYear()->subDays(5),
                'status' => 'active',
            ]
        );
 
        // Gold member - long term active
        $user3 = \App\Models\User::firstOrCreate(
            ['email' => 'gold@example.com'],
            ['name' => 'Gold Member', 'password' => bcrypt('password')]
        );
        \App\Models\Membership::updateOrCreate(
            ['user_id' => $user3->id],
            [
                'tier' => 'Gold',
                'points' => 8500,
                'expires_at' => now()->addMonths(11),
                'last_renewed_at' => now()->subMonth(),
                'status' => 'active',
            ]
        );

        // User without a membership (can be used to test manual creation)
        \App\Models\User::firstOrCreate(
            ['email' => 'nomember@example.com'],
            ['name' => 'No Membership User', 'password' => bcrypt('password')]
        );

        $this->call([
            ShopSeeder::class,
            RewardSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
