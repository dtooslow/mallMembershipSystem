<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shops = [
            [
                'name' => 'NCCC Supermarket',
                'category' => 'Groceries',
                'location' => 'Ground Floor, North Wing',
                'image' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'TechHub Electronics',
                'category' => 'Electronics & Gadgets',
                'location' => '2nd Floor, Cyberzone',
                'image' => 'https://images.unsplash.com/photo-1468495244123-6c6c332eeece?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Fashion Forward',
                'category' => 'Apparel & Accessories',
                'location' => '1st Floor, Main Atrium',
                'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Gourmet Bistro',
                'category' => 'Dining',
                'location' => '3rd Floor, Food Hall',
                'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Wellness Pharmacy',
                'category' => 'Health & Beauty',
                'location' => 'Ground Floor, South Wing',
                'image' => 'https://images.unsplash.com/photo-1586015555751-63bb77f4322a?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Kidz Playground',
                'category' => 'Entertainment',
                'location' => '4th Floor, Play Area',
                'image' => 'https://images.unsplash.com/photo-1596464716127-f2a82984de30?auto=format&fit=crop&q=80&w=800',
            ],
        ];

        foreach ($shops as $shop) {
            Shop::firstOrCreate(['name' => $shop['name']], $shop);
        }
    }
}
