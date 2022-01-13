<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return response()->json([
            'categories' => $categories,
        ], 200);
    }

    public function store(Request $request){
        $this->validate($request, [
           'name' => 'required|unique:categories',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        return ['message', 'ok'];
    }
    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
        ], 200);
    }
    public function edit($id){
        $category = Category::findOrFail($id);
        return response()->json([
           'category' => $category,
        ],200);
    }
    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|unique:categories,name,'.$id,
        ]);
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        return ['message', 'ok'];
    }
    //delete by checkbox
    public function deleteByCheckbox($id){
       $make_array = explode(',', $id);
       foreach ($make_array as $categoryId){
           $category = Category::find($categoryId);
           $category->delete();
       }
    }
}
