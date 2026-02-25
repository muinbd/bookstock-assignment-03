<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

    // Display All Books

    public function index()
    {
        $books = DB::table('books')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->leftJoin('categories', 'books.category_id', '=', 'categories.id')
            ->select(
                'books.*',
                'authors.name as author_name',
                'categories.name as category_name'
            )
            ->orderBy('books.created_at', 'desc')
            ->get();
        return view('books.index', compact('books'));
    }


    // Show Create Form

    public function create()
    {
        $categories = DB::table('categories')->get();
        $authors = DB::table('authors')->get();

        return view('books.create', compact('categories', 'authors'));
    }


    // Store New Book

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:255', 'unique:books,isbn'],
            'author_id' => ['required', 'integer', 'exists:authors,id'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:available,borrowed,reserved'],
            'published_at' => ['nullable', 'date'],
        ], [
            'title.required' => 'Book title is required.',
            'isbn.required' => 'ISBN is required.',
            'isbn.unique' => 'This ISBN already exists.',
            'author_id.required' => 'Please select an author.',
            'author_id.exists' => 'Selected author is invalid.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'Selected category is invalid.',
            'cover_image.image' => 'Cover must be a valid image file.',
            'cover_image.max' => 'Cover image must be under 2MB.',
        ]);

        $coverPath = null;

        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')
                ->store('covers', 'public');
        }

        DB::table('books')->insert([
            'title' => trim($request->title),
            'isbn' => trim($request->isbn),
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'cover_image' => $coverPath,
            'description' => $request->description ? trim($request->description) : null,
            'status' => $request->status,
            'published_at' => $request->published_at,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }


    // Show Edit Form

    public function edit($id)
    {
        $book = DB::table('books')->where('id', $id)->first();

        if (!$book) {
            abort(404);
        }

        $categories = DB::table('categories')->get();
        $authors = DB::table('authors')->get();

        return view('books.edit', compact('book', 'categories', 'authors'));
    }


    // Update Book

    public function update(Request $request, $id)
    {
        $book = DB::table('books')->where('id', $id)->first();

        if (!$book) {
            abort(404);
        }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:255', 'unique:books,isbn,' . $id],
            'author_id' => ['required', 'integer', 'exists:authors,id'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:available,borrowed,reserved'],
            'published_at' => ['nullable', 'date'],
        ], [
            'isbn.unique' => 'This ISBN already exists.',
        ]);

        $coverPath = $book->cover_image;

        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')
                ->store('covers', 'public');
        }

        DB::table('books')->where('id', $id)->update([
            'title' => trim($request->title),
            'isbn' => trim($request->isbn),
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'cover_image' => $coverPath,
            'description' => $request->description ? trim($request->description) : null,
            'status' => $request->status,
            'published_at' => $request->published_at,
            'updated_at' => now(),
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }


    // Delete Book

    public function destroy($id)
    {
        $book = DB::table('books')->where('id', $id)->first();

        if (!$book) {
            return redirect()->route('books.index')
                ->with('error', 'Book not found.');
        }

        try {
            DB::table('books')->where('id', $id)->delete();

            return redirect()->route('books.index')
                ->with('success', 'Book deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('books.index')
                ->with('error', 'Unable to delete book.');
        }
    }
}
