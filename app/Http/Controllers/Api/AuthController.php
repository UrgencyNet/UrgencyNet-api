<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

/**
 * Class AuthController
 *
 * Handles user authentication-related API actions: registration, login, logout.
 */
class AuthController extends Controller
{
    /**
     * Register a new user via API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $userData = $request->validated();
        $userData['password'] = Hash::make($userData['password']);
        
        // If location is provided, convert to JSON
        if (isset($userData['location'])) {
            $userData['location'] = json_encode($userData['location']);
        }

        $user = User::create($userData);

        $token = $user->createToken('emergency-system-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user->makeHidden(['encrypted_private_key']),
                'token' => $token,
            ],
            'message' => 'User registered successfully'
        ], 201);
    }

    /**
     * Log in an existing user via API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'The provided credentials are incorrect.',
                'errors' => [
                    'email' => ['Invalid credentials']
                ]
            ], 401);
        }
    
        $token = $user->createToken('emergency-system-token')->plainTextToken;
    
        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user->makeHidden(['encrypted_private_key']),
                'token' => $token,
            ],
            'message' => 'Login successful.'
        ]);
    }

    /**
     * Log out the authenticated user (revoke token).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        // add validation for logout if needed (e.g., device tracking)
        $request->validate([
            // you could add device_id validation here if implementing multi-device logout
        ]);
    
        $request->user()->currentAccessToken()->delete();
    
        return response()->json([
            'success' => true,
            'data' => [],
            'message' => 'Logout successful.'
        ]);
    }
}
