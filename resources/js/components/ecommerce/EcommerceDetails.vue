<template>
	<section>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive my-4 mx-2" style="overflow-x: hidden">
					<div class="row">
						<div class="col-md-5">
							<img :src="product.file.route" class="img-fluid" alt="Responsive image" />
						</div>
						<div class="col-md-6">
							<table class="table" id="product_details">
								<tbody>
									<tr>
										<th>Producto:</th>
										<td>{{ product.name }}</td>
									</tr>
									<tr>
										<th>Descripción:</th>
										<td>{{ product.description }}</td>
									</tr>
									<tr>
										<th>Categoría:</th>
										<td>{{ product.category.name }}</td>
									</tr>
									<tr>
										<th>Stock:</th>
										<td>{{ product.stock }}</td>
									</tr>
									<tr>
										<th>Precio:</th>
										<td>{{ product.price }}</td>
									</tr>
								</tbody>
							</table>


							<div class="btn-carrito-ecommerce">
								<button class="cta" @click="addToCart(product.id, 1)">
									<span class="hover-underline-animation">Carrito</span>
									<svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10"
										viewBox="0 0 46 16">
										<path id="Path_10" data-name="Path 10"
											d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z"
											transform="translate(30)"></path>
									</svg>
								</button>
							</div>


						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
import axios from 'axios';

export default {
	props: {
		product: {
			type: Object,
			required: true
		}
	},
	methods: {
		addToCart(productId, quantity) {
			axios
				.post('/carts/addToCart', {
					product_id: productId,
					quantity: quantity
				})
				.then(response => {
					alert('Producto agregado al carrito');
				})
				.catch(error => {
					alert('Es necesario iniciar sesión para agregar productos al carrito');
				});
		}
	}
}
</script>

<style>
.btn-carrito-ecommerce {
	display: flex;
	justify-content: end;
	align-content: end;
	margin-top: 8rem;
}
</style>
