
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reading List</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">

</head>

  <body>
      <div id="app">
        @include('nav')
        <div class="container-fluid">
          <div class="row">
              @include('side-nav')

              <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                  @yield('content')
              </main>
          </div>
        </div>
      </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
  </body>
</html>
