<x-app title="Productos">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Carrito</h1>
        </div>

        <carrito  :cartItems="{{ $cartItems }}"/>
    </section>
</x-app>



{{-- <x-app title="Carrito de Compras">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Carrito de Compras</h1>
        </div>

        <div class="cart-container">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>$ {{ $item->product->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>$ {{ $item->product->price * $item->quantity }}</td>
                            <td>
                                <form action="{{ route('carts.removeFromCart', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total-section">
                <p class="total-text">Total: $ {{ $total }}</p>
                <form action="{{ route('carts.clearCart') }}" method="post">
                    @csrf
                    <button type="submit" class="clear-button">Vaciar Carrito</button>
                </form>
            </div>
        </div>
    </section>
</x-app> --}}
