<?php
use App\Models\User;
use App\Models\Membership;

$user = User::firstOrCreate(
    ['email' => 'test_points@example.com'],
    [
        'name' => 'Test Points User',
        'password' => bcrypt('password123'),
    ]
);

$membership = Membership::firstOrCreate(
    ['user_id' => $user->id],
    ['tier' => 'Gold', 'points' => 100000]
);

// Force points to 100000 just in case it already existed
$membership->points = 100000;
$membership->save();

echo "User created with 100,000 points.";
