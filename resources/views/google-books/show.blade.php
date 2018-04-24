@extends('layouts.app')

@section('content')

  <google-book-details :book='{{ $volume }}' gid="{!! $book_id !!}"> </google-book-details>

  <div class=" mt-5">

      <div class="row  mr-auto ">
          <div class="col-md-8 offset-md-2">
            <div class="row">
                <h2>Related Books</h2>
            </div>
            <div class="row">
                @foreach( $related_books as $gbook)
                    <list-item google_id='{{ $gbook->id }}'
                               image='{{ $gbook->getCover("thumbnail") }}'
                               title='{{ $gbook->title }}'
                               description='{{ $gbook->description }}'
                               order="null"
                      >
                    </list-item>
                @endforeach
            </div>
          </div>
      </div>
  </div>

@endsection
