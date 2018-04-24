@extends('layouts.app')

@section('content')

  <div class="row">
    @foreach( $books as $gbook)
        <list-item google_id='{{ $gbook->id }}'
                   image='{{ $gbook->getCover("thumbnail") }}'
                   title='{{ $gbook->title }}'
                   description='{{ $gbook->description }}'
                   order="null"
        >
        </list-item>
    @endforeach
  </div>
  
@endsection
