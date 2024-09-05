<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepository;
use App\Validators\UserValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityCreating;
use Prettus\Repository\Events\RepositoryEntityUpdated;
use Prettus\Repository\Events\RepositoryEntityUpdating;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model(): string
    {
        return User::class;
    }

    public function validator(): string
    {
        return UserValidator::class;
    }

    public function create(array $attributes)
    {
        $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);

        event(new RepositoryEntityCreating($this, $attributes));

        $model = $this->model->newInstance($attributes);
        $model->save();
        $this->resetModel();

        event(new RepositoryEntityCreated($this, $model));

        return $model;
    }

    /**
     * @throws RepositoryException
     * @throws ValidatorException
     */
    public function update(array $attributes, $id)
    {
        $this->applyScope();

        $this->validator->with($attributes)->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);

        $model = $this->model->newQuery()->findOrFail($id);

        event(new RepositoryEntityUpdating($this, $model));

        $model->fill($attributes);
        $model->save();
        $this->resetModel();

        event(new RepositoryEntityUpdated($this, $model));

        return $this->parserResult($model);
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot(): void
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
