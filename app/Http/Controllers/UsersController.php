<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryEloquent;
use App\Validators\UserValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Prettus\Validator\Exceptions\ValidatorException;

class UsersController extends Controller
{
    protected UserRepositoryEloquent $repository;
    protected UserValidator $validator;

    public function __construct(UserRepositoryEloquent $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $user = $this->repository->create($request->all());

            $response = [
                'message' => 'User created.',
                'data'    => $user->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }


    public function update(Request $request, int $id): JsonResponse
    {
        try {

            if ($id !== auth()->user()->id) {
                throw new ValidatorException(new MessageBag(['error' => 'You are not authorized to update user']));
            }

            $user = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'User updated.',
                'data'    => $user->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {

            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);

        }
    }

}
