<template>
	<section>
		<div class="card">
			<div class="card-header d-flex justify-content-end">
				<button class="btn btn-primary" @click="openModal">Crear Rol</button>
			</div>
			<div class="card-body">
				<div class="table-responsive my-4 mx-2">
					<table class="table table-bordered" id="role_table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(role, index) in roles" :key="index">
								<td>{{ role.id }}</td>
								<td>{{ role.name }}</td>
								<td>
									<div class="d-flex justify-content-center" title="Editar">
										<button type="button" class="btn btn-warning btn-sm"
											@click="editRole(role)">
											<i class="fas fa-pencil-alt"></i>
										</button>
										<button type="button" class="btn btn-danger btn-sm ms-2" title="Eliminar"
											@click="deleteRole(role)">
											<i class="fas fa-trash-alt"></i>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- <product-modal :role_data="role" ref="role_modal" /> -->
			</div>
		</div>
	</section>
</template>

<script>
import RoleModal from './RoleModal.vue';
import { deleteMessage, successMessage } from '@/helpers/Alerts.js'



export default {
	components: {
		RoleModal
	},
	props: ['roles'],
	data() {
		return {
			modal: null,
			role: {}
		}
	},
	mounted() {
		this.index()
	},
	methods: {
		async index() {
			$('#role_table').DataTable()
			const modal_id = document.getElementById('role_modal')
			this.modal = new bootstrap.Modal(modal_id)
			modal_id.addEventListener('hidden.bs.modal', e => {
				this.$refs.role_modal.reset()
			})
		},
		editRole(role) {
			this.role = role;
			this.openModal()
		},
		async deleteRole({ id }) {
			if (!await deleteMessage()) return
			try {
				await axios.delete(`/roles/${id}`)
				await successMessage({ is_delete: true, reload: true })
			} catch (error) {
				console.error(error);
			}
		},
		openModal() {
			this.modal.show()
		},
	}
}
</script>
