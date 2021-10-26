<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return object
     * @return View
     */
    public function index(Request $request)
    {
        $categories = DB::table('categories')->get();

        if (explode("/",$request->path())[0] === 'api'){
            return new CategoryResourceCollection($categories);
        }

        $groups = DB::table('groups')->get();

        return view('category.index', compact('categories', 'groups'));
    }

    /**
     * Execute input field for store new resource.
     *
     * @return View
     */
    public function create()
    {
        $groups = DB::table('groups')->get();
        $token = md5(uniqid(mt_rand(), true));
        $editRow = null;

        return view('category.category_inputs', compact('editRow', 'groups', 'token'));
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
            'group_id'      => 'required|exists:groups,id',
            'name'          => 'required|unique:categories',
            'category_code' => 'required|unique:categories',
            'serial_no'     => 'required|unique:categories',
        ]);

        $data = [
            "group_id"      => $request['group_id'],
            "name"          => $request['name'],
            "slug"          => $request['slug'] ?? $request['group_id'].'-'.$request['category_code'].'-'.$request['serial_no'],
            "icon"          => $request['icon'],
            "category_code" => $request['category_code'],
            "serial_no"     => $request['serial_no'],
            "short_details" => $request['short_details'],
            "status"        => $request['status'],
            "created_at"    => Carbon::now(),
        ];

        $category_id = DB::table('categories')->insertGetId($data);
        $category = DB::table('categories')->where('id', $category_id)->first();

        if (explode("/",$request->path())[0] === 'api'){
            return new CategoryResource($category);
        }

        return redirect('categories');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return CategoryResource
     */
    public function show($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        return new CategoryResource($category);
    }

    /**
     * Get specific resource for edit.
     *
     * @return View
     */
    public function edit($id)
    {
        $groups = DB::table('groups')->get();
        $token = md5(uniqid(mt_rand(), true));
        $editRow = DB::table('categories')->where('id', $id)->first();

        return view('category.category_inputs', compact('editRow', 'groups', 'token'));
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
            'group_id'      => 'required|exists:groups,id',
            'name'          => 'required',
            'category_code' => 'required',
            'serial_no'     => 'required',
        ]);

        DB::table('categories')->where('id', $id)->update([
            "group_id"      => $request['group_id'],
            "name"          => $request['name'],
            "slug"          => $request['slug'] ?? $request['group_id'].'-'.$request['category_code'].'-'.$request['serial_no'],
            "icon"          => $request['icon'],
            "category_code" => $request['category_code'],
            "serial_no"     => $request['serial_no'],
            "short_details" => $request['short_details'],
            "status"        => $request['status'],
            "updated_at"    => Carbon::now(),
        ]);

        $category = DB::table('categories')->where('id', $id)->first();

        if (explode("/",$request->path())[0] === 'api'){
            return new CategoryResource($category);
        }

        return redirect('categories');
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
        DB::table('categories')->where('id', $id)->delete();

        if (explode("/",$request->path())[0] === 'api'){
            return response()->json(null, 204);
        }

        return redirect('categories');
    }

    /**
     * Update specified resource status.
     *
     * @param $id
     * @return null
     */
    public function update_status($id)
    {
        $category = DB::table('categories')->find($id);

        if($category->status === 'Active') {
            DB::table('categories')->where('id', $id)->update(['status' => 'Inactive']);
        }elseif($category->status === 'Inactive') {
            DB::table('categories')->where('id', $id)->update(['status' => 'Active']);
        }

        return redirect('categories');
    }
}
