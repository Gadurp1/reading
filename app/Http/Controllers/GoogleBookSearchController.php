<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Scriptotek\GoogleBooks\GoogleBooks;
use JavaScript;
use App\Book;

class GoogleBookSearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search_term = $request->search_term;
        $g_books = new GoogleBooks(['maxResults' => 25]);
        $books = $g_books->volumes->search($search_term);

        return view('search-results')
            ->with('books', $books)
            ->with('search_term', $search_term);

    }

    /**
     * Show Details for Selected Google Book.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book_id = null;

        $book = auth()->user()->readingList()
            ->where('google_id', $id)
            ->select('books.id')
            ->first();

        if($book !== NULL) {
            $book_id = $book->id;
        }

        $g_books = new GoogleBooks(['maxResults' => 12]);
        $g_books_response = $g_books->volumes->get($id);
        $volume = $g_books_response->__toString();

        $related_books = $g_books->volumes
            ->search($g_books_response->volumeInfo->authors[0]);

        return view('google-books.show', compact('book_id', 'related_books'))
            ->with('volume', $volume);

    }
}
