<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::paginate(10);

        if(request()->wantsJson()){
            return response()->json([
                'data' => $data
            ]);
        }
        return view('admin.category.index',compact('data'));
    }


    public function create()
    {
        return view('admin.category.create');
    }


    public function store(CategoryRequest $request)
    {

        Category::create($request->only('name'));

        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'بەسەرکەوتوی دروستکرا'
            ]);
        }

        return redirect()->back()->with(['msg'=>'بەسەرکەوتوی دروستکرا']);
    }

    public function edit($id)
    {
        $data = Category::findOrFail($id);

        if(request()->wantsJson()){
            return response()->json([
                'data'=>$data
            ]);
        }

        return view('admin.category.edit', compact('data'));
    }


    public function update(CategoryRequest $request, $id)
    {
       Category::findOrFail($id)->update($request->only('name'));

       if(request()->wantsJson()){
            return response()->json([
                'msg'=>'بەسەرکەوتوی تازەکرایەوە'
            ]);
        }
        return redirect()->back()->with(['msg'=>'بەسەرکەوتوی تازەکرایەوە']);

    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

       if(request()->wantsJson()){
            return response()->json([
                'msg'=>'بەسەرکەوتوی سڕایەوە'
            ]);
        }
        return redirect()->route('category.index');
    }
}
