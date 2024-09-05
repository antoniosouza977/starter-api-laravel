<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryEloquent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    private UserRepositoryEloquent $repository;

    public function __construct(UserRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'username'    => 'required',
            'password'    => 'required',
            'device_name' => 'required',
        ]);


        if (!Auth::attempt($request->only(['username', 'password']))) {
            return response()->json([
                'message' => 'Invalid username or password',
            ], 401);
        }

        $user = $this->repository->findByField('username', $request['username'])->first();
        $user->tokens()
            ->where('name', $request->device_name)
            ->delete();

        $token = $user->createToken($request->device_name, ['*'], now()->addDay())->plainTextToken;

        return new JsonResponse([
            'token' => $token,
            'expiration' => now()->addDay()->timestamp,
        ]);
    }
}
