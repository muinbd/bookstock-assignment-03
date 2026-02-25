<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = DB::table('categories')
            ->leftJoin('books', 'categories.id', '=', 'books.category_id')
            ->select(
                'categories.id',
                'categories.name',
                'categories.description',
                'categories.status',
                DB::raw('COUNT(books.id) as books_count')
            )
            ->groupBy(
                'categories.id',
                'categories.name',
                'categories.description',
                'categories.status'
            )
            ->orderBy('categories.created_at', 'desc')
            ->get();

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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);
        DB::table('categories')->insert([
            'name' => trim($request->name),
            'description' => $request->description ? trim($request->description) : null,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    // Edit Method
    public function edit($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        if (!$category) {
            abort(404);
        }

        return view('categories.edit', compact('category'));
    }

    // Update Method
    public function update(Request $request, $id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        if (!$category) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        DB::table('categories')->where('id', $id)->update([
            'name' => trim($request->name),
            'description' => $request->description ? trim($request->description) : null,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
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
