<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BookSubscription;

class BookSubscriptionController extends Controller
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
   * Load reading List.
   *
   * @param  int  $id
   * @return Response
   */
  public function index()
  {
      return view('reading-list', compact('books'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function destroy($id)
  {
      auth()->user()->unsubscribeFromBook($id);
  }
}

?>
