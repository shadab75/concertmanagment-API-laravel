<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckAccessMiddleware;
use App\Http\Requests\NewCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends Controller
{


    //
    public function index()
    {

        return response()->json([
        //    'data'=>Category::paginate(10)
            //in this method it doesnt show pagination
            CategoryResource::collection(Category::paginate(10))
        ],200);

    }

    public function store(Request $request)
    {

      $category=Category::query()->create([
           'title'=>$request->get('title')
        ]);
        return response()->json([
            'data'=>New CategoryResource($category)
        ],201);

    }

    public function update(Category $category,UpdateCategoryRequest $request)
    {
        $category->update([
           'title'=>$request->get('title')
        ]);
        return response()->json([
            'data'=>New CategoryResource($category)
        ])->setStatusCode(200);
    }

    public function show(Category $category)
    {
       return response()->json([
          'data'=>new CategoryResource($category)
       ])->setStatusCode(200 );
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
           'msg'=>'data has been deleted'
        ],200);
    }
}
