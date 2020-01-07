<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
  <div class="container-fluid">

    <!-- Brand -->
    <a class="navbar-brand waves-effect" href="{{ route('panel') }}">
      <strong class="blue-text">Laravel 6.0</strong>
    </a>

    <!-- Collapse -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <!-- Left -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
          <a class="nav-link waves-effect" href="{{ route('panel') }}">Inicio
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Exportar | Importar 1 Tabla
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item waves-effect" href="{{ route('admin.users.excel.index') }}">
              Usuarios - Con Laravel Excel
            </a>
            <a class="dropdown-item waves-effect" href="{{ route('admin.users.index') }}">
              Usuarios - Con Trait
            </a>
            <a class="dropdown-item waves-effect" href="{{ route('admin.categories.index') }}">
              Categorías - Con Trait
            </a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Importar Tablas Relacionadas
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item waves-effect" href="{{ route('admin.csvUploads.index') }}">
              Con Validaciones - Zaengle
            </a>
            <a class="dropdown-item waves-effect" href="{{ route('admin.importsExcel.index') }}">
              Con Laravel Excel
            </a>
            <a class="dropdown-item waves-effect" href="{{ route('import.relatedTables.products') }}">
              Productos - Categorías
            </a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Importar Validación Model
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item waves-effect" href="{{ route('import.users') }}">
              Usuarios
            </a>
            <a class="dropdown-item waves-effect" href="{{ route('import.categories') }}">
              Categorías
            </a>
          </div>
        </li>
      </ul>

      <!-- Right -->
      <ul class="navbar-nav nav-flex-icons">
        <li class="nav-item">
          <a href="https://www.facebook.com/mdbootstrap" class="nav-link waves-effect">
            <i class="fab fa-facebook-f"></i>
          </a>
        </li>
        <li class="nav-item">
          <a href="https://twitter.com/MDBootstrap" class="nav-link waves-effect">
            <i class="fab fa-twitter"></i>
          </a>
        </li>
        <li class="nav-item">
          <a href="https://github.com/mdbootstrap/bootstrap-material-design" class="nav-link border border-light rounded waves-effect"
           >
            <i class="fab fa-github mr-2"></i>MDB GitHub
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>