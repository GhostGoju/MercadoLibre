<x-app title="Categorias">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Listado Categorias</h1>
        </div>

		<the-category-list :categories="{{ $categories }}"/>
    </section>
</x-app>
