<x-app title="Inicio">
    <section class="my-3 d-flex justify-content-center">
    </section>

    <section class="d-flex flex-wrap justify-content-center" id="productList">
        @foreach ($products->groupBy('category_id') as $categoryId => $groupedProducts)
            @php
                $count = 0;
            @endphp
            @foreach ($groupedProducts as $product)
                @if ($count >= 5)
                @break
            @endif

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
                        <a class="btn btn-outline-success" type="button"
                            href="{{ route('products.show', $product->id) }}">
							<i class="fa-solid fa-cart-plus"></i>
                        </a>

                    </div>
                </div>
            </div>
            @php
                $count++;
            @endphp
        @endforeach
    @endforeach
</section>
</x-app>
