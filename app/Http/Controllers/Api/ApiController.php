<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\Sender;
use App\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

class ApiController extends Controller
{
    use ApiResponser;
    /**
     * custom pagination function
     * @param $collection
     * @return LengthAwarePaginator
     */
    public function paginate($collection)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perpage = 15;
        $results = $collection->slice(($page - 1)*$perpage,$perpage)->values();
        $paginated = new LengthAwarePaginator($results,$collection->count(),$perpage,$page,[
            'path'=> LengthAwarePaginator::resolveCurrentPath(),
        ]);
        $paginated->appends(request()->all());
        return $paginated;
    }

}
