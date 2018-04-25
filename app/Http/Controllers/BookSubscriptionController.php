<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BookSubscription;
use App\Batch\Batch;

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
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('reading-list', compact('books'));
  }

  /**
   * Update the specified resource in storage.
   *
   */
  public function update(Request $request)
  {
      $batch_upload = new Batch;
      $batch_upload->update('book_subscriptions', $request->all(), 'id');
  }

  /**
   * Remove book from users reading list.
   *
   */
  public function destroy($id)
  {
      auth()->user()->unsubscribeFromBook($id);
  }
}

?>
