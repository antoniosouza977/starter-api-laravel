<?php

namespace App\Repositories;

use App\Entities\RestrictedRoute;
use App\Repositories\Interfaces\RouteRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class RouteRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RouteRepositoryEloquent extends BaseRepository implements RouteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RestrictedRoute::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
