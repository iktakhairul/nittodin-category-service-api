<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubCategoryResource;
use App\Http\Resources\SubCategoryResourceCollection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return object
     * @return SubCategoryResourceCollection
     */
    public function index(Request $request)
    {
        $subCategories = DB::table('sub_categories')->get();

        if (explode("/",$request->path())[0] === 'api'){
            return new SubCategoryResourceCollection($subCategories);
        }
        $groups = DB::table('groups')->get();
        $categories = DB::table('categories')->get();

        return view('subcategory.index', compact('groups', 'categories', 'subCategories'));
    }

    /**
     * Execute input field for store new resource.
     *
     * @return View
     */
    public function create()
    {
        $groups = DB::table('groups')->get();
        $categories = DB::table('categories')->get();
        $token = md5(uniqid(mt_rand(), true));
        $editRow = null;

        return view('subcategory.sub-category_inputs', compact('editRow', 'groups', 'categories', 'token'));
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
            'group_id'         => 'required|exists:groups,id',
            'category_id'      => 'required|exists:categories,id',
            'name'             => 'required|unique:sub_categories',
            'subcategory_code' => 'required|unique:sub_categories',
            'serial_no'        => 'required|unique:sub_categories',
        ]);

        $data = [
            'group_id'         => $request['group_id'],
            'category_id'      => $request['category_id'],
            'name'             => $request['name'],
            'slug'             => $request['slug'] ?? $request['group_id'].'-'.$request['category_id'].'-'.$request['subcategory_code'].'-'.$request['serial_no'],
            'icon'             => $request['icon'],
            'subcategory_code' => $request['subcategory_code'],
            'serial_no'        => $request['serial_no'],
            'short_details'    => $request['short_details'],
            'status'           => $request['status'],
            'created_at'       => Carbon::now(),
        ];

        $subCategory_id = DB::table('sub_categories')->insertGetId($data);
        $subCategory = DB::table('sub_categories')->where('id', $subCategory_id)->first();

        if (explode("/",$request->path())[0] === 'api'){
            return new SubCategoryResource($subCategory);
        }

        return redirect('sub-categories');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return SubCategoryResource
     */
    public function show($id)
    {
        $subCategory = DB::table('sub_categories')->where('id', $id)->first();

        return new SubCategoryResource($subCategory);
    }
    /**
     * Get specific resource for edit.
     *
     * @return View
     */
    public function edit($id)
    {
        $groups = DB::table('groups')->get();
        $categories = DB::table('categories')->get();
        $token = md5(uniqid(mt_rand(), true));
        $editRow = DB::table('sub_categories')->where('id', $id)->first();

        return view('subcategory.sub-category_inputs', compact('editRow', 'groups', 'categories','token'));
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
            'group_id'         => 'required',
            'category_id'      => 'required',
            'name'             => 'required',
            'subcategory_code' => 'required',
        ]);

        DB::table('sub_categories')->where('id', $id)->update([
            'group_id'         => $request['group_id'],
            'category_id'      => $request['category_id'],
            'name'             => $request['name'],
            'slug'             => $request['slug'] ?? $request['group_id'].'-'.$request['category_id'].'-'.$request['subcategory_code'].'-'.$request['serial_no'],
            'icon'             => $request['icon'],
            'subcategory_code' => $request['subcategory_code'],
            'serial_no'        => $request['serial_no'],
            'short_details'    => $request['short_details'],
            'status'           => $request['status'],
            'updated_at'    => Carbon::now(),
        ]);

        $subCategory = DB::table('sub_categories')->where('id', $id)->first();

        if (explode("/",$request->path())[0] === 'api'){
            return new SubCategoryResource($subCategory);
        }

        return redirect('sub-categories');
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
        DB::table('sub_categories')->where('id', $id)->delete();

        if (explode("/",$request->path())[0] === 'api'){
            return response()->json(null, 204);
        }

        return redirect('sub-categories');
    }

    /**
     * Update specified resource status.
     *
     * @param $id
     * @return null
     */
    public function update_status($id)
    {
        $subCategory = DB::table('sub_categories')->find($id);

        if($subCategory->status === 'Active') {
            DB::table('sub_categories')->where('id', $id)->update(['status' => 'Inactive']);
        }elseif($subCategory->status === 'Inactive') {
            DB::table('sub_categories')->where('id', $id)->update(['status' => 'Active']);
        }

        return redirect('sub-categories');
    }
}
