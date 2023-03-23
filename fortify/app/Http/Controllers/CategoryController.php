<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //
    public function view()
    {   
        $categories = Category::all();
        // return view('admin.categories');
        return view('admin.categories', ['categories' => $categories]);
    }

    // public function getAll()
    // {
    //     $categories = Category::all();
    //     return response()->json($categories);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.categories');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.categories');
    }
}
