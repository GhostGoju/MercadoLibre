<template>
	<div class="cart-container">
	  <table class="cart-table">
		<thead>
		  <tr>
			<th>Producto</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Subtotal</th>
			<th>Acciones</th>
		  </tr>
		</thead>
		<tbody>
		  <tr v-for="(item, index) in carrito" :key="index">
			<td>{{ item.nombre }}</td>
			<td>$ {{ item.precio }}</td>
			<td>
			  <input type="number" v-model="item.cantidad" min="1" @change="actualizarSubtotal(index)" class="quantity-input">
			</td>
			<td>$ {{ item.cantidad * item.precio }}</td>
			<td>
			  <button @click="eliminarProducto(index)" class="delete-button">Eliminar</button>
			</td>
		  </tr>
		</tbody>
	  </table>
	  <div class="total-section">
		<p class="total-text">Total: $ {{ calcularTotal() }}</p>
		<button @click="vaciarCarrito()" class="clear-button">Vaciar Carrito</button>
	  </div>
	</div>
  </template>

  <script>
  export default {
	data() {
	  return {
		carrito: [
		  { nombre: 'Producto 1', precio: 10, cantidad: 1 },
		  { nombre: 'Producto 2', precio: 15, cantidad: 1 },
		  // Otros productos...
		]
	  };
	},
	methods: {
	  actualizarSubtotal(index) {
		this.carrito[index].subtotal = this.carrito[index].precio * this.carrito[index].cantidad;
	  },
	  calcularTotal() {
		return this.carrito.reduce((total, item) => total + (item.subtotal || (item.cantidad * item.precio)), 0);
	  },
	  eliminarProducto(index) {
		this.carrito.splice(index, 1);
	  },
	  vaciarCarrito() {
		this.carrito = [];
	  }
	}
  };
  </script>

  <style scoped>
  .cart-container {
	margin: 20px;
	padding: 20px;
	border: 1px solid #ccc;
	border-radius: 8px;
	background-color: #f9f9f9;
  }

  .cart-table {
	width: 100%;
	border-collapse: collapse;
  }

  .cart-table th,
  .cart-table td {
	padding: 12px;
	text-align: left;
	border-bottom: 1px solid #ddd;
  }

  .cart-table th {
	background-color: #f2f2f2;
  }

  .quantity-input {
	width: 60px;
	padding: 6px;
	border: 1px solid #ddd;
	border-radius: 4px;
  }

  .delete-button {
	padding: 8px 16px;
	background-color: #f44336;
	color: white;
	border: none;
	border-radius: 4px;
	cursor: pointer;
  }

  .delete-button:hover {
	background-color: #cc0000;
  }

  .total-section {
	margin-top: 20px;
	text-align: right;
  }

  .total-text {
	font-size: 18px;
	font-weight: bold;
  }

  .clear-button {
	padding: 10px 20px;
	background-color: #4caf50;
	color: white;
	border: none;
	border-radius: 4px;
	cursor: pointer;
  }

  .clear-button:hover {
	background-color: #388e3c;
  }
  </style>
