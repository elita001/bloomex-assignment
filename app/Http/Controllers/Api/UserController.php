<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Structure\OrderByItem;
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
        $columns = $request->get('columns');
        $offset = $request->get('start');
        $limit = $request->get('length');
        $search = $request->get('search');
        $searchString = $search['value'] ?? '';
        $order = $request->get('order', []);
        /**
         * @var OrderByItem[]
         */
        $sort = [];
        foreach ($order as $orderItem) {
            if (
                !isset($orderItem['column'])
                || !isset($columns[$orderItem['column']])
                || !isset($columns[$orderItem['column']]['name'])
            )
                continue;
            $dir = $orderItem['dir'] ?? 'asc';
            $sort[] = new OrderByItem($columns[$orderItem['column']]['name'], $dir);
        }
        $userRepository = new UserRepository();
        $data = UserResource::collection($userRepository->getAll($offset, $limit, $searchString, $sort));
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
