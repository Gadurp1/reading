<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
  <form class="w-100" action="/search" method="get">
    @csrf
    <input class="form-control form-control-dark w-100"
           type="text"
           placeholder="Search Google Books Api By Title and Author"
           aria-label="Search"
           name="search_term"
    >
  </form>

  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link"
         href="{{ route('logout') }}"
         onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </li>
  </ul>
</nav>
