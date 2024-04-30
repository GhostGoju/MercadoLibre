<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">{{ env('APP_NAME') }}</a>

        {{-- Haburguesa --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <!-- Barra de búsqueda -->
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar"
                        id="searchInput">
                </form>
            </ul>



            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">

                {{-- CARRITO --}}
                <li>
                    <a class="nav-link" href="{{ route('carts.index') }}">
                        <i class="fa-solid fa-cart-plus"></i>
                    </a>
                </li>

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                Inicio de sesión
                            </a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                Registro
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->full_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                            @role('Admin')
                                {{-- User --}}
                                <a class="dropdown-item" href="{{ route('users.index') }}">
                                    Usuarios
                                </a>
                            @endrole
                            @role('Admin')
                                {{-- Book --}}
                                <a class="dropdown-item" href="{{ route('products.index') }}">
                                    Productos
                                </a>
                            @endrole
                            @role('Admin')
                                {{-- Category --}}
                                <a class="dropdown-item" href="{{ route('categories.index') }}">
                                    Categorias
                                </a>
                            @endrole
                            @role('Admin')
                                {{-- Category --}}
                                <a class="dropdown-item" href="{{ route('roles.index') }}">
                                    Roles
                                </a>
                            @endrole


                            {{-- Logout --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('searchInput');
        const productList = document.getElementById('productList');

        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.trim().toLowerCase();

            Array.from(productList.querySelectorAll('.card')).forEach(function(product) {
                const productName = product.querySelector('.card-title').textContent
                    .toLowerCase();
                if (productName.includes(searchTerm)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    });
</script>
