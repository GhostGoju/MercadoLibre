<x-app title="Carrito">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Carrito</h1>
        </div>

        <div>
            <ul>
                @foreach($cartItems as $item)
                    <li>Producto: {{ $item->product_id }}, Cantidad: {{ $item->quantity }}</li>
                @endforeach
            </ul>
        </div>



		{{-- <carrito :cartItems="{{ $cartItems }}"/> --}}
    </section>
</x-app>
