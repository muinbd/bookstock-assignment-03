<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    // 1Show all authors
    public function index()
    {
        $authors = DB::table('authors')->get();

        return view('authors.index', compact('authors'));
    }

    // Show create form
    public function create()
    {
        return view('authors.create');
    }

    // Store author
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio'  => 'nullable|string'
        ]);

        DB::table('authors')->insert([
            'name' => $request->name,
            'bio' => $request->bio,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('authors.index')
            ->with('success', 'Author created successfully.');
    }

    // Delete author
    public function destroy($id)
    {
        $author = DB::table('authors')->where('id', $id)->first();

        if (!$author) {
            return redirect()->route('authors.index')
                ->with('error', 'Author not found.');
        }

        // Check if author is used in books
        $bookExists = DB::table('books')
            ->where('author_id', $id)
            ->exists();

        if ($bookExists) {
            return redirect()->route('authors.index')
                ->with('error', 'Cannot delete author with existing books.');
        }

        DB::table('authors')->where('id', $id)->delete();

        return redirect()->route('authors.index')
            ->with('success', 'Author deleted successfully.');
    }
}
