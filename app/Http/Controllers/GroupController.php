<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Http\Resources\GroupResourceCollection;
use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return GroupResourceCollection
     */
    public function index(Request $request)
    {
        $groups = DB::table('groups')->get();

        return new GroupResourceCollection($groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return GroupResource
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name"       => 'required',
            "group_code" => 'required',
        ]);

        $data = [
            "name"          => $request['name'],
            "slug"          => $request['slug'],
            "icon"          => $request['icon'],
            "group_code"    => $request['category_code'],
            "serial_no"     => $request['serial_no'],
            "short_details" => $request['short_details'],
            "status"        => $request['status'],
            "created_at"    => Carbon::now(),
        ];

        $group_id = DB::table('groups')->insertGetId($data);
        $group = DB::table('groups')->where('id', $group_id)->first();

        return new GroupResource($group);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return GroupResource
     */
    public function show($id)
    {
        $group = DB::table('groups')->where('id', $id)->first();

        return new GroupResource($group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param Group $group
     * @return GroupResource
     */
    public function update(Request $request, Group $group)
    {
        $group = $this->groupRepository->update($group, $request->all());

        return new GroupResource($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response|string
     */
    public function destroy($id)
    {
        DB::table('groups')->where('id', $id)->delete();

        return response()->json(null, 204);
    }
}
