@extends('layouts.app')

@section('content')

  <google-book-details :book='{{ $volume }}' gid="{!! $book_id !!}"> </google-book-details>

  <div class="mt-5">

      <div class="row container mr-auto ">
          <div class="col-2 display-sm-none">
          </div>
          <div class="col-md-9 col-sm-12">
            <div class="row">
                <h1 class="page-title m-3">
                    Related Books
                </h1>
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
