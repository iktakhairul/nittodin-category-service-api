<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryResourceCollection;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return CategoryResourceCollection
     */
    public function index(Request $request)
    {
        $categories = DB::table('categories')->get();

        return new CategoryResourceCollection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return CategoryResource
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "group_id"      => 'required',
            "name"          => 'required',
            "category_code" => 'required',
        ]);

        $data = [
            "group_id"      => $request['group_id'],
            "name"          => $request['name'],
            "slug"          => $request['slug'],
            "icon"          => $request['icon'],
            "category_code" => $request['category_code'],
            "serial_no"     => $request['serial_no'],
            "short_details" => $request['short_details'],
            "status"        => $request['status'],
            "created_at"    => Carbon::now(),
        ];

        $category_id = DB::table('categories')->insertGetId($data);
        $category = DB::table('categories')->where('id', $category_id)->first();

        return new CategoryResource($category);
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
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return CategoryResource
     */
    public function update(Request $request, Category $category)
    {
        $category = $this->categoryRepository->update($category, $request->all());

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response|string
     */
    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->delete();

        return response()->json(null, 204);
    }
}
