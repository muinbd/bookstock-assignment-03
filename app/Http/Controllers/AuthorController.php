<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    // 1Show all authors
    public function index()
    {
        $authors = DB::table('authors')
            ->leftJoin('books', 'authors.id', '=', 'books.author_id')
            ->select(
                'authors.id',
                'authors.name',
                'authors.email',
                'authors.status',
                DB::raw('COUNT(books.id) as books_count')
            )
            ->groupBy(
                'authors.id',
                'authors.name',
                'authors.email',
                'authors.status'
            )
            ->orderBy('authors.created_at', 'desc')
            ->get();

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
            'email' => 'required|email|unique:authors,email',
            'status' => 'required|in:active,inactive',
        ]);

        DB::table('authors')->insert([
            'name' => trim($request->name),
            'email' => trim($request->email),
            'bio' => $request->bio ? trim($request->bio) : null,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('authors.index')
            ->with('success', 'Author created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $author = DB::table('authors')->where('id', $id)->first();

        if (!$author) {
            abort(404);
        }

        return view('authors.edit', compact('author'));
    }


    // Update author
    public function update(Request $request, $id)
    {
        $author = DB::table('authors')->where('id', $id)->first();

        if (!$author) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'status' => 'required|in:active,inactive'
        ]);

        DB::table('authors')->where('id', $id)->update([
            'name' => trim($request->name),
            'email' => trim($request->email),
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('authors.index')
            ->with('success', 'Author updated successfully.');
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
