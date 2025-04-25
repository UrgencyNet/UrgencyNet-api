<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
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
    
}
