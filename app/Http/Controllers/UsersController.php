<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryEloquent;
use App\Validators\UserValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UsersController extends Controller
{
    protected UserRepositoryEloquent $repository;
    protected UserValidator $validator;

    public function __construct(UserRepositoryEloquent $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function show(int $id)
    {
        $user = $this->repository->findOrNull($id);

        if (!$user) {
            return new JsonResponse([
                'message' => 'User not found.'
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        return $this->repository->find($id);
    }

    public function me(Request $request): JsonResponse
    {
        return new JsonResponse($request->user());
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $user = $this->repository->create($request->all());

            return new JsonResponse([
                'message' => 'User created.',
                'data'    => $user->toArray(),
            ]);
        } catch (ValidatorException $e) {
            return new JsonResponse([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            if ($id !== $request->user()->id) {
                throw new ValidatorException(new MessageBag(['error' => 'You are not authorized to update user']));
            }

            $user = $this->repository->update($request->all(), $id);

            return new JsonResponse([
                'message' => 'User updated.',
                'data'    => $user->toArray(),
            ]);
        } catch (ValidatorException $e) {

            return new JsonResponse([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);

        }
    }

    public function destroy(int $id): JsonResponse
    {
        $user = $this->repository->findOrNull($id);

        if (!$user) {
            return new JsonResponse(['message' => 'User not found.'], ResponseAlias::HTTP_NOT_FOUND);
        }
        $this->repository->delete($id);

        return new JsonResponse(['message' => 'User deleted.']);
    }

}
