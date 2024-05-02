<x-app title="Carrito">
    <section class="container">

		<div class="d-flex justify-content-center my-4">
			<h1>Carrito</h1>
		</div>


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Unidades</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->product->category->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->product->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </section>
</x-app>
