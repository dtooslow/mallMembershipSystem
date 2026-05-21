<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            'NCCC Supermarket' => [
                [
                    'name'          => 'Fresh Organic Strawberries',
                    'description'   => 'Sweet, juicy, and handpicked organic strawberries. Perfect for snacking or desserts.',
                    'price'         => 7.99,
                    'sale_price'    => 5.49,
                    'image'         => 'https://images.unsplash.com/photo-1464965911861-746a04b4bca6?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 10,
                ],
                [
                    'name'          => 'Premium Whole Milk 1 Gallon',
                    'description'   => 'Freshly sourced pasteurized whole milk. Packed with calcium and essential vitamins.',
                    'price'         => 4.89,
                    'sale_price'    => 3.99,
                    'image'         => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 8,
                ],
                [
                    'name'          => 'Fresh Baked Sourdough Bread',
                    'description'   => 'Baked fresh daily in-house with a perfectly crispy crust and soft, airy interior.',
                    'price'         => 5.50,
                    'sale_price'    => 4.25,
                    'image'         => 'https://images.unsplash.com/photo-1549931319-a545dcf3bc73?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 8,
                ],
            ],
            'TechHub Electronics' => [
                [
                    'name'          => 'Wireless Noise-Cancelling Headphones',
                    'description'   => 'Immerse yourself in premium sound. Active noise cancellation and up to 30 hours of battery life.',
                    'price'         => 299.99,
                    'sale_price'    => 199.99,
                    'image'         => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 300,
                ],
                [
                    'name'          => 'Mechanical Gaming Keyboard',
                    'description'   => 'Tactile RGB backlighting with mechanical switches for ultimate accuracy and speed.',
                    'price'         => 129.99,
                    'sale_price'    => 89.99,
                    'image'         => 'https://images.unsplash.com/photo-1618384887929-16ec33fab9ef?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 130,
                ],
                [
                    'name'          => 'Smart Fitness Watch v2',
                    'description'   => 'Track your workouts, heart rate, sleep quality, and daily steps with modern style.',
                    'price'         => 199.99,
                    'sale_price'    => 149.99,
                    'image'         => 'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 200,
                ],
            ],
            'Fashion Forward' => [
                [
                    'name'          => 'Designer Denim Jacket',
                    'description'   => 'Classic retro-style blue denim jacket made with high-quality, durable cotton.',
                    'price'         => 89.00,
                    'sale_price'    => 59.99,
                    'image'         => 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 90,
                ],
                [
                    'name'          => 'Polarized Retro Sunglasses',
                    'description'   => 'Unisex retro sunglasses with 100% UV protection and high-end polarized lenses.',
                    'price'         => 45.00,
                    'sale_price'    => 29.99,
                    'image'         => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 45,
                ],
                [
                    'name'          => 'Classic Canvas Sneakers',
                    'description'   => 'Lightweight and comfortable casual sneakers. Perfect for everyday city walking.',
                    'price'         => 65.00,
                    'sale_price'    => 44.99,
                    'image'         => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 65,
                ],
            ],
            'Gourmet Bistro' => [
                [
                    'name'          => 'Truffle Glazed Wagyu Burger',
                    'description'   => 'Juicy Wagyu beef patty topped with white truffle glaze, aged cheddar, and wild arugula.',
                    'price'         => 24.50,
                    'sale_price'    => 18.99,
                    'image'         => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 25,
                ],
                [
                    'name'          => 'Crispy Calamari Basket',
                    'description'   => 'Golden-fried fresh calamari served with a side of house-made zesty garlic aioli.',
                    'price'         => 16.00,
                    'sale_price'    => 12.00,
                    'image'         => 'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 15,
                ],
                [
                    'name'          => 'Classic Chocolate Lava Cake',
                    'description'   => 'Rich, warm chocolate cake with a molten fudge center. Served with vanilla bean ice cream.',
                    'price'         => 10.50,
                    'sale_price'    => 7.99,
                    'image'         => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 10,
                ],
            ],
            'Wellness Pharmacy' => [
                [
                    'name'          => 'Organic Rosewater Facial Toner',
                    'description'   => 'Refreshing and natural toner to hydrate and balance skin tone. Great for sensitive skin.',
                    'price'         => 18.99,
                    'sale_price'    => 14.25,
                    'image'         => 'https://images.unsplash.com/photo-1608248597481-496100c80836?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 20,
                ],
                [
                    'name'          => 'Premium Multivitamin Complex',
                    'description'   => 'Complete daily vitamins and minerals for active health, vitality, and immune support.',
                    'price'         => 32.00,
                    'sale_price'    => 24.99,
                    'image'         => 'https://images.unsplash.com/photo-1584017911766-d451b3d0e843?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 32,
                ],
                [
                    'name'          => 'Soothing Lavender Essential Oil',
                    'description'   => 'Pure essential oil for aromatherapy, massage, and relaxation. Promotes deep, peaceful sleep.',
                    'price'         => 14.50,
                    'sale_price'    => 9.99,
                    'image'         => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 15,
                ],
            ],
            'Kidz Playground' => [
                [
                    'name'          => 'Jumbo Plush Teddy Bear',
                    'description'   => 'Extra-soft, lovable, and cuddly giant teddy bear. Perfect birthday gift for kids.',
                    'price'         => 35.00,
                    'sale_price'    => 24.99,
                    'image'         => 'https://images.unsplash.com/photo-1559251606-c623743a6d76?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 35,
                ],
                [
                    'name'          => 'Magnetic Building Blocks Set',
                    'description'   => '50-piece colorful magnetic tiles to spark kids creativity and 3D architectural thinking.',
                    'price'         => 49.99,
                    'sale_price'    => 39.99,
                    'image'         => 'https://images.unsplash.com/photo-1587654780291-39c9404d746b?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 50,
                ],
                [
                    'name'          => 'Watercolor Painting Set',
                    'description'   => '24-color professional child-safe watercolor tray with fine brushes and paper pads.',
                    'price'         => 20.00,
                    'sale_price'    => 14.99,
                    'image'         => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&q=80&w=600',
                    'points_earned' => 20,
                ],
            ]
        ];


        foreach ($products as $shopName => $shopProducts) {
            $shop = Shop::where('name', $shopName)->first();
            if ($shop) {
                foreach ($shopProducts as $productData) {
                    $shop->products()->firstOrCreate(['name' => $productData['name']], $productData);
                }
            }
        }
    }
}
