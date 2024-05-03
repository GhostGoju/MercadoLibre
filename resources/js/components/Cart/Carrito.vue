<template>
    <section>
        <div class="card cart-container">
            <div class="card-header d-flex justify-content-end">
                <button class="btn btn-primary" @click="clearCart">Vaciar Carrito</button>
            </div>
            <div class="card-body">
                <div class="table-responsive my-4 mx-2">
                    <table class="table cart-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Unidades</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in cartitems" :key="index">
                                <td>{{ item.product.name }}</td>
                                <td>
                                    <input type="number" v-model="item.quantity" @change="updateQuantity(item)" class="form-control">
                                </td>
                                <td>$ {{ item.product.price }}</td>
                                <td>$ {{ getTotalPrice(item) }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" @click="removeFromCart(item)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="total">Total a Pagar: $ {{ calculateTotal() }}</div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        cartitems: {
            type: Array,
            required: true
        }
    },
    methods: {
        removeFromCart(item) {
            axios.post(`/carts/removeFromCart/${item.id}`)
                .then(response => {
                    const index = this.cartitems.findIndex(cartItem => cartItem === item);
                    if (index !== -1) {
                        this.cartitems.splice(index, 1);
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        },
        updateQuantity(item) {
            axios.post(`/carts/updateQuantity/${item.id}`, { quantity: item.quantity })
                .then(response => {
                })
                .catch(error => {
                    console.error(error);
                });
        },
        clearCart() {
            axios.post('/carts/clearCart')
                .then(response => {
                    this.cartitems = [];
                })
                .catch(error => {
                    console.error(error);
                });
        },
        getTotalPrice(item) {
            return item.product.price * item.quantity;
        },
        calculateTotal() {
            let total = 0;
            this.cartitems.forEach(item => {
                total += this.getTotalPrice(item);
            });
            return total;
        }
    }
}
</script>
