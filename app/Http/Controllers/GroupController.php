<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\GroupResource;
use App\Http\Resources\GroupResourceCollection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return object
     * @return GroupResourceCollection
     */
    public function index(Request $request)
    {
        $groups = DB::table('groups')->get();

        if (explode("/",$request->path())[0] === 'api'){
            return new GroupResourceCollection($groups);
        }
        return view('group.index', compact('groups'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function create()
    {
        $token = md5(uniqid(mt_rand(), true));
        $editRow = null;

        return view('group.group_inputs', compact('editRow', 'token'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return object
     * @return null
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required|unique:groups',
            'group_code' => 'required|unique:groups',
            'serial_no'  => 'required|unique:groups',
        ]);

        $data = [
            'name'          => $request['name'],
            'slug'          => $request['slug'] ?? $request['name'].'-'.$request['group_code'].'-'.$request['serial_no'],
            'icon'          => $request['icon'],
            'group_code'    => $request['group_code'],
            'serial_no'     => $request['serial_no'],
            'short_details' => $request['short_details'],
            'status'        => $request['status'],
            'created_at'    => Carbon::now(),
        ];

        $group_id = DB::table('groups')->insertGetId($data);
        $group = DB::table('groups')->where('id', $group_id)->first();

        if (explode("/",$request->path())[0] === 'api'){
            return new GroupResource($group);
        }

        return redirect('groups');
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
     * Display a listing of the resource.
     *
     * @return View
     */
    public function edit($id)
    {
        $token = md5(uniqid(mt_rand(), true));
        $editRow = DB::table('groups')->where('id', $id)->first();

        return view('group.group_inputs', compact('editRow', 'token'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param Request $request
     * @return object
     * @return null
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name'       => 'required',
            'group_code' => 'required',
            'serial_no'  => 'required',
        ]);

        DB::table('groups')->where('id', $id)->update([
            'name'          => $request['name'],
            'slug'          => $request['slug'] ?? $request['name'].'-'.$request['group_code'].'-'.$request['serial_no'],
            'icon'          => $request['icon'],
            'group_code'    => $request['group_code'],
            'serial_no'     => $request['serial_no'],
            'short_details' => $request['short_details'],
            'status'        => $request['status'],
            'updated_at'    => Carbon::now(),
        ]);

        $group = DB::table('groups')->where('id', $id)->first();

        if (explode("/",$request->path())[0] === 'api'){
            return new GroupResource($group);
        }

        return redirect('groups');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @param Request $request
     * @return Response|string
     */
    public function destroy($id, Request $request)
    {
        DB::table('groups')->where('id', $id)->delete();

        if (explode("/",$request->path())[0] === 'api'){
            return response()->json(null, 204);
        }

        return redirect('groups');
    }

    /**
     * Update specified resource status.
     *
     * @param $id
     * @return null
     */
    public function update_status($id)
    {
        $category = DB::table('groups')->find($id);

        if($category->status === 'Active')
        {
            DB::table('groups')->where('id', $id)->update(['status' => 'Inactive']);
        }elseif($category->status === 'Inactive')
        {
            DB::table('groups')->where('id', $id)->update(['status' => 'Active']);
        }

        return redirect('groups');
    }
}
