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
									<input type="number" v-model="item.quantity" @change="updateQuantity(item)"
										class="form-control">
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

		<!-- BOTON DE COMPRAR -->
		<div class="pay-btn-container">
			<button class="Btn" @click="pay">
				Pay
				<svg viewBox="0 0 576 512" class="svgIcon">
					<path
						d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z">
					</path>
				</svg>
			</button>
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
		async removeFromCart(item) {
			try {
				await axios.post(`/carts/removeFromCart/${item.id}`);
				const index = this.cartitems.findIndex(cartItem => cartItem === item);
				if (index !== -1) {
					this.cartitems.splice(index, 1);
				}
			} catch (error) {
				console.error(error);
			}
		},
		async updateQuantity(item) {
			try {
				await axios.post(`/carts/updateQuantity/${item.id}`, { quantity: item.quantity });
			} catch (error) {
				console.error(error);
			}
		},
		async clearCart() {
			try {
				await axios.post('/carts/clearCart');
				this.cartitems = [];
			} catch (error) {
				console.error(error);
			}
		},
		getTotalPrice(item) {
			return item.product.price * item.quantity;
		},
		calculateTotal() {
			return this.cartitems.reduce((total, item) => total + this.getTotalPrice(item), 0);
		},
	}
}
</script>

<style scoped>
.pay-btn-container {
	display: flex;
	justify-content: flex-end;
	padding: 10px;
}

.Btn {
	width: 130px;
	height: 40px;
	display: flex;
	align-items: center;
	justify-content: center;
	background-color: rgb(15, 15, 15);
	border: none;
	color: white;
	font-weight: 600;
	gap: 8px;
	cursor: pointer;
	box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.103);
	position: relative;
	overflow: hidden;
	transition-duration: .3s;
}

.svgIcon {
	width: 16px;
}

.svgIcon path {
	fill: white;
}

.Btn::before {
	width: calc(100% + 40px);
	aspect-ratio: 1/1;
	position: absolute;
	content: "";
	background-color: white;
	border-radius: 50%;
	left: -20px;
	top: 50%;
	transform: translate(-150%, -50%);
	transition-duration: .5s;
	mix-blend-mode: difference;
}

.Btn:hover::before {
	transform: translate(0, -50%);
}

.Btn:active {
	transform: translateY(4px);
	transition-duration: .3s;
}
</style>
