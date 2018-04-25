<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\CreateBookRequest;
use App\Book;
use App\UserBook;
use App\Author;

class BookController extends Controller
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
    * Display a listing of the resource.
    *
    * @return Response
    */
  public function index(Request $request)
  {
     $sort = 'user_books.order';
     $order = 'asc';

     if ( $request->has('sort') &&  $request->has('order')) {
       $sort = $request->sort;
       $order = $request->order;
     }

     $reading_list = auth()->user()
         ->readingList()
         ->select(
             'user_books.id',
             'books.image',
             'user_books.order',
             'books.google_id',
             'authors.last_name'

         )
         ->orderBy($sort, $order)
         ->get();

     return response()->json($reading_list);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(CreateBookRequest $request)
  {
      $user = auth()->user();

      $array = explode(" ", $request->author);
      $first_name = $array[0];
      $last_name = $array[1];
      $author = Author::firstOrCreate(
          ['first_name' => $first_name, 'last_name' => $last_name]
      );

      // Create book if it doesn't already exist in database
      $book = Book::where( 'google_id', $request->google_id )->first();
      if( $book == NULL ) {
          $book = new Book;
          $book->fill( $request->only([
              'title',
              'google_id',
              'description',
              'slug',
              'page_count',
              'image'
          ]));
          $book->author_id = $author->id;
          $book->save();
      }

      $user->subscribeToBook($book->id);
      return $book;
   }
}

?>
