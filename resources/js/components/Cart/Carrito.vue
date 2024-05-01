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
				<tr v-for="(cartItem, index) in cartItems" :key="index">
					<td>{{ cartItem.product_id.name }}</td>
					<td>{{ cartItem.quantity }}</td>
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
