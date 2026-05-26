<?php

use App\Models\User;
use App\Models\Admin;
use App\Models\Event;
use App\Models\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest cannot access admin events page', function () {
    $this->get(route('events.index'))->assertRedirect(route('login'));
});

test('admin can view events list', function () {
    $admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($admin, 'admin')
        ->get(route('events.index'));

    $response->assertStatus(200);
});

test('admin can create event and it notifies all users', function () {
    $admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
    ]);

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $response = $this->actingAs($admin, 'admin')
        ->post(route('events.store'), [
            'title' => 'Mega Concert Show',
            'type' => 'small_concert',
            'event_date' => now()->addDays(5)->format('Y-m-d'),
            'description' => 'A wonderful concert featuring local acoustic artists.',
            'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800',
        ]);

    $response->assertRedirect(route('events.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('events', [
        'title' => 'Mega Concert Show',
        'type' => 'small_concert',
        'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800',
    ]);

    $this->assertDatabaseHas('notifications', [
        'user_id' => $user1->id,
        'title' => '🗓️ Small Concert 🎸: Mega Concert Show',
    ]);

    $this->assertDatabaseHas('notifications', [
        'user_id' => $user2->id,
        'title' => '🗓️ Small Concert 🎸: Mega Concert Show',
    ]);
});

test('user can see upcoming events and notification on dashboard', function () {
    $user = User::factory()->create();
    
    $user->membership()->create([
        'tier' => 'Bronze',
        'points' => 100,
        'status' => 'active',
        'expires_at' => now()->addYear(),
        'payment_method' => 'gcash',
    ]);

    $event = Event::create([
        'title' => 'Super Art Gallery',
        'type' => 'art_gallery',
        'event_date' => now()->addDays(3)->format('Y-m-d'),
        'description' => 'Beautiful paintings from modern digital artists.',
    ]);

    Notification::create([
        'user_id' => $user->id,
        'title' => '🗓️ Art Gallery 🎨: Super Art Gallery',
        'message' => 'Beautiful paintings from modern digital artists.',
        'is_read' => false,
    ]);

    $response = $this->actingAs($user)
        ->get(route('user.dashboard'));

    $response->assertStatus(200);
    $response->assertSee('Super Art Gallery');
    $response->assertSee('Art Gallery');
});
