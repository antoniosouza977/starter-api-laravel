<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository extends \Prettus\Repository\Eloquent\BaseRepository
{
    public function findOrNull(int $id, $columns = ['*']): ?Model
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->find($id, $columns);
        $this->resetModel();

        return $this->parserResult($model);
    }
}
