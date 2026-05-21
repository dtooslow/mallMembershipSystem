<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reward;

class RewardSeeder extends Seeder
{
    /**
        * Run the database seeds.
        */
    public function run(): void
    {
        $rewards = [
            [
                'name' => 'Premium Coffee Maker',
                'description' => 'Start your day right with a state-of-the-art espresso machine. Perfect for coffee enthusiasts.',
                'points_required' => 15000,
                'stock' => 5,
            ],
            [
                'name' => 'Weekend Getaway Package',
                'description' => 'A two-night stay at our partner luxury resort. Includes breakfast and spa access.',
                'points_required' => 50000,
                'stock' => 2,
            ],
            [
                'name' => 'Exclusive Dining Voucher',
                'description' => 'Experience fine dining with a ₱1000 voucher at our premium steakhouse.',
                'points_required' => 8000,
                'stock' => 20,
            ],
            [
                'name' => 'VIP Cinema Pass',
                'description' => 'Enjoy blockbuster movies with unlimited popcorn and drinks for two.',
                'points_required' => 5000,
                'stock' => 50,
            ]
        ];

        foreach ($rewards as $reward) {
            Reward::firstOrCreate(['name' => $reward['name']], $reward);
        }
    }
}
