<x-app title="Inicio">
    <section class="my-3 d-flex justify-content-center">
    </section>

    <section class="d-flex flex-wrap justify-content-center" id="productList">
        @foreach ($products->groupBy('category_id') as $categoryId => $groupedProducts)
            <section class="d-flex gap-2 justify-content-center w-100 border-bottom">
                <a href="{{ route('products.byCategory', ['category_id' => $categoryId]) }}"
                    class="text-decoration-none text-dark">
                    <h2>{{ $groupedProducts->first()->category->name }}</h2>
                </a>
            </section>

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
            @php
                $count++;
            @endphp
        @endforeach
    @endforeach
</section>
</x-app>
