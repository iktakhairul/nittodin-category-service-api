<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubCategoryResource;
use App\Http\Resources\SubCategoryResourceCollection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return SubCategoryResourceCollection
     */
    public function index(Request $request)
    {
        $subCategories = DB::table('sub_categories')->get();

        return new SubCategoryResourceCollection($subCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return SubCategoryResource
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "group_id"         => 'required',
            "category_id"      => 'required',
            "name"             => 'required',
            "subcategory_code" => 'required',
        ]);

        $data = [
            "group_id"         => $request['group_id'],
            "category_id"      => $request['category_id'],
            "name"             => $request['name'],
            "slug"             => $request['slug'],
            "icon"             => $request['icon'],
            "subcategory_code" => $request['subcategory_code'],
            "serial_no"        => $request['serial_no'],
            "short_details"    => $request['short_details'],
            "status"           => $request['status'],
            "created_at"       => Carbon::now(),
        ];

        $subCategory_id = DB::table('sub_categories')->insertGetId($data);
        $subCategory = DB::table('sub_categories')->where('id', $subCategory_id)->first();

        return new SubCategoryResource($subCategory);
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
     * Update the specified resource in storage.
     *
     * @param $id
     * @param Request $request
     * @return SubCategoryResource
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            "group_id"         => 'required',
            "category_id"      => 'required',
            "name"             => 'required',
            "subcategory_code" => 'required',
        ]);

        DB::table('sub_categories')->where('id', $id)->update([
            "group_id"         => $request['group_id'],
            "category_id"      => $request['category_id'],
            "name"             => $request['name'],
            "slug"             => $request['slug'],
            "icon"             => $request['icon'],
            "subcategory_code" => $request['subcategory_code'],
            "serial_no"        => $request['serial_no'],
            "short_details"    => $request['short_details'],
            "status"           => $request['status'],
            "updated_at"    => Carbon::now(),
        ]);

        $subCategory = DB::table('sub_categories')->where('id', $id)->first();

        return new SubCategoryResource($subCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response|string
     */
    public function destroy($id)
    {
        DB::table('sub_categories')->where('id', $id)->delete();

        return response()->json(null, 204);
    }
}
