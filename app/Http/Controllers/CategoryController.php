<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = DB::table('categories')->get();

        return view('categories.index', compact('categories'));
    }

    // Show create form
    public function create()
    {
        return view('categories.create');
    }

    // 3️⃣ Store category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        DB::table('categories')->insert([
            'name' => $request->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    // Delete category
    public function destroy($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        if (!$category) {
            return redirect()->route('categories.index')
                ->with('error', 'Category not found.');
        }

        // Check if category is used in books
        $bookExists = DB::table('books')
            ->where('category_id', $id)
            ->exists();

        if ($bookExists) {
            return redirect()->route('categories.index')
                ->with('error', 'Cannot delete category with existing books.');
        }

        DB::table('categories')->where('id', $id)->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
