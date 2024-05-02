<x-app title="Productos">

    <section class="d-flex flex-wrap justify-content-center" id="productList">
        @foreach ($products as $product)
            <div class="card mx-2 my-3 card_size">
                <img src="{{ $product->file->route }}" class="card-img-top" alt="Presentacion Producto">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->format_description }}</p>
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
                <div class="card-footer">
                    <div class="d-flex gap-2 justify-content-center">

                        {{-- ECOMMERCE --}}
                        <a class="btn btn-outline-secondary" type="button"
                            href="{{ route('products.show', $product->id) }}">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        {{-- CARRITO --}}
                        <form action="{{ route('carts.addToCart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-outline-success add-to-cart-btn">
                                <i class="fa-solid fa-cart-plus"></i> Carrito
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        @endforeach
    </section>
</x-app>
