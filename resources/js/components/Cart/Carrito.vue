<template>
	<section>
		<div class="card">
			<div class="card-header d-flex justify-content-end">
				<button class="btn btn-primary" @click="openModal">Vaciar Carrito</button>
			</div>
			<div class="card-body">
				<div class="table-responsive my-4 mx-2">
					<table class="table table-bordered" id="carrito_list">
						<thead>
							<tr>
								<th>producto</th>
								<th>Unidades</th>
								<th>Precio</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(Item, index) in cartitems" :key="index">
								<td>{{ Item.product.name }}</td>
								<td>{{ Item.quantity }}</td>
								<td>{{ Item.product.price }}</td>
								<td>
									<div class="d-flex justify-content-center" title="Editar">
										<button type="button" class="btn btn-danger btn-sm ms-2" title="Eliminar"
											@click="deleteProduct(product)">
											<i class="fas fa-trash-alt"></i>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- <carrito-modal /> -->
			</div>
		</div>
	</section>
</template>



<script>

export default {
	props: {
		cartitems: {
			type: Array,
			required: true
		}
	}
}
</script>






