<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('admin.buys') }}">{{ $pageName }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('admin.buys') }}">Buys</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('admin.supplies') }}">Supplies</a>
          </li>
        </ul>
        <ul class="navbar-nav me-2 mb-2 mb-md-0">
          <li>
            <a class="nav-link" href="/admin/dologout"><i class="material-icons">logout</i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>