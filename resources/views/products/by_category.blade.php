<x-app title="Productos">

    <section class="d-flex flex-wrap justify-content-center" id="productList">
        @foreach ($products as $product)
            <div class="card mx-2 my-3 card_size">
                <img src="{{ $product->file->route }}" class="card-img-top" alt="Presentacion Producto">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('products.show', $product->id) }}"
                            class="text-decoration-none text-dark">{{ $product->name }}</a></h5>
                    <div class="row">
                        <span class="mt-2">
                            <strong>Categoria: </strong> {{ $product->category->name }}
                        </span>
                        <span class=".col-md">
                            <strong>Und. Disponibles: </strong> {{ $product->stock }}
                        </span>
                        <span class=".col-md">
                            <strong>Precio: $</strong> {{ $product->price }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
</x-app>
