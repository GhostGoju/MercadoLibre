<template>
    <section>
        <table class="table table-bordered" id="carrito_list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in cartItems" :key="index">
                    <td>{{ item.id }}</td>
                    <td>{{ item.product_id }}</td>
                    <td>{{ item.quantity }}</td>
                </tr>
            </tbody>
        </table>
    </section>
</template>

<script>
export default {
    props: {
        cartItems: {
            type: Array,
            required: true
        }
    }
};
</script>
