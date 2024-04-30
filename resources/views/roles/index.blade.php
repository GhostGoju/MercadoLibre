<x-app title="Roles">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Listado Roles</h1>
        </div>

        <the-role-list :roles="{{ $roles }}"/>
    </section>
</x-app>
