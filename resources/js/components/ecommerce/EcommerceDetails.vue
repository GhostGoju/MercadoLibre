<template>
	<section>

		<section class="my-3 d-flex justify-content-center">
			<h1 class="cemter">
				<td>{{ product.name }}</td>
			</h1>
		</section>

		<div class="card">
			<div class="card-body">
				<div class="table-responsive my-4 mx-2" style="overflow-x: hidden;">
					<div class="row">

						<div class="col-md-6">
							<img :src="product.file.route" class="img-fluid" alt="Responsive image">
						</div>
						<div class="col-md-6">
							<table class="table" id="product_details">
								<tbody>

									<tr>
										<th>Precio:</th>
										<td>{{ product.price }}</td>
									</tr>
									<tr>
										<th>Stock</th>
										<td>{{ product.stock }}</td>
									</tr>
									<tr>
										<th>Categoría</th>
										<td>{{ product.category}}</td>
									</tr>
									<tr>
										<th>Descripción</th>
										<td>{{ product.description }}</td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
export default {
	props: {
		product: {
			type: Object,
			required: true
		}
	}
}
</script>
