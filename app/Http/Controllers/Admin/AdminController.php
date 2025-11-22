<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    /**
     * Display the admin management page
     */
    public function index()
    {
        // Get all admins from the database
        $admins = Admin::all();

        // Get all users who are not admins
        $adminEmails = Admin::pluck('email')->toArray();
        $nonAdminUsers = User::whereNotIn('email', $adminEmails)->get();

        return view('admin.pages.admin', [
            'admins' => $admins,
            'nonAdminUsers' => $nonAdminUsers,
        ]);
    }

    /**
     * Promote a user to admin
     */
    public function promote(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ], [
            'user_id.required' => 'User ID is required',
            'user_id.exists' => 'The selected user does not exist',
        ]);

        try {
            DB::beginTransaction();

            // Get the user
            $user = User::findOrFail($validated['user_id']);

            // Check if user is already an admin
            $existingAdmin = Admin::where('email', $user->email)->first();
            if ($existingAdmin) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'This user is already an admin',
                ], 422);
            }

            // Create admin record
            $admin = Admin::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt(uniqid()), // Generate random password
                'status' => 1,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => ucfirst($user->name) . ' has been promoted to admin',
                'admin' => [
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'email' => $admin->email,
                    'status' => $admin->status,
                    'created_at' => $admin->created_at->format('M d, Y'),
                ],
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Admin promotion error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while promoting the user',
            ], 500);
        }
    }

    /**
     * Remove admin privileges
     */
    public function destroy(Request $request, Admin $admin)
    {
        try {
            // Prevent self-demotion if they're the last admin
            $adminCount = Admin::count();
            $currentAdmin = auth('admin')->user();

            if ($admin->id === $currentAdmin->id && $adminCount === 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot remove the last admin from the system',
                ], 403);
            }

            DB::beginTransaction();

            // Delete the admin record
            $admin->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Admin privileges removed successfully',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Admin removal error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while removing admin privileges',
            ], 500);
        }
    }
}
