<?php

use App\Models\Admin;
use App\Models\User;

test('admin management page requires authentication', function () {
    $response = $this->get('/admin/admin');
    $response->assertRedirect('/admin/login');
});

test('authenticated admin can view admin management page', function () {
    $admin = Admin::first() ?? Admin::factory()->create([
        'name' => 'Test Admin',
        'email' => 'testadmin@example.com',
        'password' => bcrypt('password'),
        'status' => 1,
    ]);

    $response = $this->actingAs($admin, 'admin')->get('/admin/admin');
    $response->assertStatus(200);
    $response->assertSee('Admin Management');
    $response->assertSee('Current Admins');
});

test('admin can promote a user to admin', function () {
    $admin = Admin::first() ?? Admin::factory()->create([
        'name' => 'Test Admin',
        'email' => 'testadmin@example.com',
        'password' => bcrypt('password'),
        'status' => 1,
    ]);

    $user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);

    // Verify user is not an admin
    $this->assertNull(Admin::where('email', $user->email)->first());

    $response = $this->actingAs($admin, 'admin')->postJson('/admin/admins/promote', [
        'user_id' => $user->id,
    ]);

    $response->assertStatus(201);
    $response->assertJsonPath('success', true);
    $response->assertJsonPath('admin.name', $user->name);
    $response->assertJsonPath('admin.email', $user->email);

    // Verify admin was created in database
    $this->assertNotNull(Admin::where('email', $user->email)->first());
});

test('cannot promote user that is already an admin', function () {
    $admin = Admin::first() ?? Admin::factory()->create([
        'name' => 'Test Admin',
        'email' => 'testadmin@example.com',
        'password' => bcrypt('password'),
        'status' => 1,
    ]);

    $user = User::factory()->create([
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
    ]);

    // Create admin with same email
    Admin::create([
        'name' => $user->name,
        'email' => $user->email,
        'password' => bcrypt('password'),
        'status' => 1,
    ]);

    $response = $this->actingAs($admin, 'admin')->postJson('/admin/admins/promote', [
        'user_id' => $user->id,
    ]);

    $response->assertStatus(422);
    $response->assertJsonPath('success', false);
    $response->assertJsonPath('message', 'This user is already an admin');
});

test('admin can remove another admin', function () {
    $currentAdmin = Admin::first() ?? Admin::factory()->create([
        'name' => 'Admin One',
        'email' => 'admin1@example.com',
        'password' => bcrypt('password'),
        'status' => 1,
    ]);

    $adminToRemove = Admin::factory()->create([
        'name' => 'Admin Two',
        'email' => 'admin2@example.com',
        'password' => bcrypt('password'),
        'status' => 1,
    ]);

    $response = $this->actingAs($currentAdmin, 'admin')->deleteJson('/admin/admins/' . $adminToRemove->id);

    $response->assertStatus(200);
    $response->assertJsonPath('success', true);

    // Verify admin was removed from database
    $this->assertNull(Admin::find($adminToRemove->id));
});

test('last admin cannot remove themselves', function () {
    // Create only one admin
    $admin = Admin::factory()->create([
        'name' => 'Only Admin',
        'email' => 'onlyadmin@example.com',
        'password' => bcrypt('password'),
        'status' => 1,
    ]);

    // Delete all other admins
    Admin::where('id', '!=', $admin->id)->delete();

    $response = $this->actingAs($admin, 'admin')->deleteJson('/admin/admins/' . $admin->id);

    $response->assertStatus(403);
    $response->assertJsonPath('success', false);
    $response->assertJsonPath('message', 'Cannot remove the last admin from the system');

    // Verify admin still exists
    $this->assertNotNull(Admin::find($admin->id));
});

test('promote endpoint validates user id', function () {
    $admin = Admin::first() ?? Admin::factory()->create([
        'name' => 'Test Admin',
        'email' => 'testadmin@example.com',
        'password' => bcrypt('password'),
        'status' => 1,
    ]);

    $response = $this->actingAs($admin, 'admin')->postJson('/admin/admins/promote', [
        'user_id' => 99999, // Non-existent user
    ]);

    $response->assertStatus(422);
    $response->assertJsonPath('success', false);
});

