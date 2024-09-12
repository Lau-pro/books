<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Http\Requests\StorebookRequest;
use App\Http\Requests\UpdatebookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;



class BookController extends Controller
{
    public $genre = ['Mystery', 'Horror novels', 'Fantasy novels', 'Non-fiction', 'Fiction', 'Romance novels'];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headers = ['isbn', 'author', 'title', 'genre', 'published date', 'action'];
        $books = Book::where('user_id', '=', Auth::user()->id)->orderBy('created_at')->paginate(5);
        return view('book.viewbooks', ['books' => $books], ['header' => $headers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.addbook', ['genres' => $this->genre]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebookRequest $request)
    {
        $book = $request->except(['_token']);
        $book['user_id'] = Auth::user()->id;

        book::insert($book);
        toastr()->success('New Book is Added to list.');
        return redirect(route('book.view'));
    }

    /**
     * Display the specified resource.
     */
    public function show(book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(book $book, Request $request)
    {

        $book = book::where('id', '=', $request->id)->first();

        if ($book) {
            $currentGenre = $book->genre;
            $allGenres = $this->genre;
            $filteredGenres = array_filter($allGenres, function ($genre) use ($currentGenre) {
                return $genre !== $currentGenre;
            });

            return view('book.editbook', [
                'book' => $book,
                'genre' => $filteredGenres
            ]);
        }
        return redirect()->route('books.index')->with('error', 'Book not found.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebookRequest $request, book $book)
    {
        $bookUpdate = book::where('id', $request->id)
            ->update([
                'title' => $request->input('title'),
                'author' => $request->input('author'),
                'isbn' => $request->input('isbn'),
                'genre' => $request->input('genre'),
                'published_date' => $request->input('published_date')
            ]);
        if ($bookUpdate) {
            toastr()->success('Book Updated Succesfully.');
            return redirect()->route('book.view');
        }

        toastr()->error('Book Failed to Update.');
        return redirect()->route('book.view');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(book $book, Request $request)
    {
        $book = book::where('id', $request->id)->delete();
        if ($book) {
            Toastr()->success('Book has been deleted.');
            return redirect()->route('book.view');
        }
        Toastr()->error('Nothing happen, Action result Failed.');
        return redirect()->route('book.view');
    }
}
