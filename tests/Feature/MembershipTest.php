<?php

use App\Models\User;
use App\Models\Admin;
use App\Models\Membership;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest cannot access user dashboard or apply membership', function () {
    $this->get(route('user.dashboard'))->assertRedirect(route('login'));
    $this->get(route('membership.apply'))->assertRedirect(route('login'));
});

test('user without membership can view apply page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->get(route('membership.apply'));

    $response->assertStatus(200);
    $response->assertSee('Apply for Membership');
});

test('user can submit membership application with dummy payment', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('membership.apply.store'), [
            'payment_method' => 'gcash',
        ]);

    $response->assertRedirect('/');
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('memberships', [
        'user_id' => $user->id,
        'status' => 'pending',
        'payment_method' => 'gcash',
    ]);
});

test('user with pending membership cannot submit another application', function () {
    $user = User::factory()->create();
    Membership::create([
        'user_id' => $user->id,
        'tier' => 'Bronze',
        'points' => 0,
        'status' => 'pending',
        'payment_method' => 'maya',
    ]);

    $response = $this->actingAs($user)
        ->get(route('membership.apply'));
    $response->assertRedirect(route('user.dashboard'));

    $response2 = $this->actingAs($user)
        ->post(route('membership.apply.store'), [
            'payment_method' => 'gcash',
        ]);
    $response2->assertRedirect(route('user.dashboard'));
});

test('admin can approve a pending membership', function () {
    $user = User::factory()->create();
    $membership = Membership::create([
        'user_id' => $user->id,
        'tier' => 'Bronze',
        'points' => 0,
        'status' => 'pending',
        'payment_method' => 'bdo',
    ]);

    $admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin2@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($admin, 'admin')
        ->patch(route('memberships.approve', $membership));

    $response->assertRedirect(route('memberships.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('memberships', [
        'id' => $membership->id,
        'status' => 'active',
    ]);

    $membership->refresh();
    expect($membership->expires_at)->not->toBeNull();
});

test('admin can reject a pending membership', function () {
    $user = User::factory()->create();
    $membership = Membership::create([
        'user_id' => $user->id,
        'tier' => 'Bronze',
        'points' => 0,
        'status' => 'pending',
        'payment_method' => 'bpi',
    ]);

    $admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin2@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($admin, 'admin')
        ->patch(route('memberships.reject', $membership));

    $response->assertRedirect(route('memberships.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('memberships', [
        'id' => $membership->id,
        'status' => 'rejected',
    ]);
});
