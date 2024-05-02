
<x-app title="Carrito">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Carrito</h1>
        </div>

        <carrito :cartitems="{{ $cartItems }}"/>
    </section>
</x-app>

