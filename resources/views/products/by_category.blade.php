<x-app title="Productos">

    <section class="d-flex flex-wrap justify-content-center" id="productList">
        @foreach ($products as $product)
            <div class="card mx-2 my-3 card_size">
                <img src="{{ $product->file->route }}" class="card-img-top" alt="Presentacion Producto">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('products.show', $product->id) }}"
                            class="text-decoration-none text-dark">{{ $product->name }}</a></h5>

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

                        {{-- CARRITO --}}
                        <form action="{{ route('carts.addToCart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">

                            <div type="submit" class="main-section">
                                <button class="first-button">+</button>
                                <button class="second-button"> <svg viewBox="0 0 24 24" width="20" height="20"
                                        stroke="#ffd300" stroke-width="2" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" class="css-i6dzq1">
                                        <circle cx="9" cy="21" r="1"></circle>
                                        <circle cx="20" cy="21" r="1"></circle>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                        </path>
                                    </svg> Add To Cart</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        @endforeach
    </section>
</x-app>
