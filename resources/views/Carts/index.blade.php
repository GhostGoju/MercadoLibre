<x-app title="Categorias">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Listado Categorias</h1>
        </div>

        <div>
            <h2>Elementos del Carrito:</h2>
            <ul>
                @foreach($cartItems as $item)
                    <li>Producto: {{ $item->product_id }}, Cantidad: {{ $item->quantity }}</li>
                @endforeach
            </ul>
        </div>



		{{-- <carrito :cartItems="{{ $cartItems }}"/> --}}
    </section>
</x-app>
