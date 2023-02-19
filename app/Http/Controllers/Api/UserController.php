<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Structure\Db\FilterItem;
use App\Structure\Db\OrderByItem;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $draw = $request->get('draw');
        $columnsParam = $request->get('columns');
        $offset = $request->get('start');
        $limit = $request->get('length');
        $searchParam = $request->get('search');
        $searchString = $searchParam['value'] ?? '';
        $sortParams = $request->get('order', []);
        $filterParams = $request->get('filter', []);
        /**
         * @var OrderByItem[]
         */
        $sort = [];
        foreach ($sortParams as $sortParam) {
            if (
                !isset($sortParam['column'])
                || !isset($columnsParam[$sortParam['column']])
                || !isset($columnsParam[$sortParam['column']]['name'])
            )
                continue;
            $dir = $sortParam['dir'] ?? 'asc';
            $sort[] = new OrderByItem($columnsParam[$sortParam['column']]['name'], $dir);
        }
        /**
         * @var FilterItem[]
         */``
        $filter = [];
        foreach ($filterParams as $filterParam) {
            if (!isset($filterParam['column'])
                || !isset($filterParam['operator'])
                || !isset($filterParam['value'])
            )
                continue;
            $relation = $filterParam['relation'] ?? null;
            $filter[] = new FilterItem(
                $filterParam['column'],
                $filterParam['operator'],
                $filterParam['value'],
                $relation
            );
        }
        $userRepository = new UserRepository();
        $data = UserResource::collection($userRepository->getAll($offset, $limit, $searchString, $sort, $filter));
        $total = $userRepository->count($searchString);
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data,
        ])->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
