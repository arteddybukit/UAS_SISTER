<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookListDetailResource;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();   
        return BookListDetailResource::collection($books->loadMissing('admin_name:id,username'));
    }

    public function show($id)
    {
        $book = Book::with('admin_name:id,username')->findOrFail($id);
        //return response()->json(['data' => $books]);
        return new BookListDetailResource($book);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'penerbit' => 'required',
        ]);

        $request['author'] = Auth::user()->id;
        $book = Book::create($request->all());
        return new BookListDetailResource($book->loadMissing('admin_name:id,username'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'penerbit' => 'required',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());

        return new BookListDetailResource($book->loadMissing('admin_name:id,username'));
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return new BookListDetailResource($book->loadMissing('admin_name:id,username'));
    }
}
