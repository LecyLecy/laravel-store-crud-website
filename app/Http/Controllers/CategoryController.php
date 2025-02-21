<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function createCategoryButton() {
        return view('createCategory');
    }

    public function createCategory(Request $request) {

        $request->validate([
            'category' => 'required',
        ]);

        Category::create( [
            'category' => $request->category,
        ]);

        return redirect ('/create')->with('success', 'Category created successfully!');;
    }
}