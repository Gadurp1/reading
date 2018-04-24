@extends('layouts.auth')

@section('content')


<form method="POST" class="form-signin" action="{{ route('login') }}">
    @csrf
    <div class="text-center mb-4">
        <img class="mb-4" src="{{ asset('/imgs/book-icon.png') }}" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Reading List App</h1>
        <p> Add books from the Google Books API into an orderable reading list.</p>
    </div>
    <div class="form-label-group">

      <input id="email"
          type="email"
          class="form-control form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
          name="email"
          value="{{ old('email') }}"
          required autofocus
          >
          <label for="inputEmail">Email address</label>

          @if ($errors->has('email'))
          <span class="invalid-feedback">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
      </div>

      <div class="form-label-group">
          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
          <label for="inputPassword">Password</label>

          @if ($errors->has('password'))
          <span class="invalid-feedback">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
      </div>
      <div class="checkbox mb-3">
          <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
          </label>
      </div>

      <button type="submit" class="btn btn-primary btn-block">
        {{ __('Login') }}
      </button>

      <a class="btn btn-link" href="{{ route('register') }}">
          Register New Account
      </a>
</form>

@endsection
