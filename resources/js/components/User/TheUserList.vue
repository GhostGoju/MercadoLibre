<template>
	<section>
		<div class="card">
			<div class="card-header d-flex justify-content-end">
				<button class="btn btn-primary" @click="openModal">Crear usuario</button>
			</div>
			<div class="card-body">
				<div class="table-responsive my-4 mx-2">
					<table class="table table-bordered" id="user_table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Email</th>
								<th>Rol</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(user, index) in users" :key="index">
								<td>{{ user.id }}</td>
								<td>{{ user.name }}</td>
								<td>{{ user.last_name }}</td>
								<td>{{ user.email }}</td> <!-- Agrega el campo email -->
								<td>{{ user.roles[0].name }}</td> <!-- Accede al nombre del rol -->
								<td>
									<div class="d-flex justify-content-center" title="Editar">
										<button type="button" class="btn btn-warning btn-sm" @click="edituser(user)">
											<i class="fas fa-pencil-alt"></i>
										</button>
										<button type="button" class="btn btn-danger btn-sm ms-2" title="Eliminar"
											@click="deleteUser(user)">
											<i class="fas fa-trash-alt"></i>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<product-modal :user="users" ref="user_modal" />
			</div>
		</div>
	</section>
</template>

<script>
import UserModal from './UserModal.vue';
import { deleteMessage, successMessage } from '@/helpers/Alerts.js'

export default {
	components: {
		UserModal
	},
	props: ['users'],
	data() {
		return {
			modal: null,
			product: {}
		}
	},
	mounted() {
		this.index()
	},
	methods: {
		async index() {
			$('#user_table').DataTable()
			const modal_id = document.getElementById('user_modal')
			this.modal = new bootstrap.Modal(modal_id)
			modal_id.addEventListener('hidden.bs.modal', e => {
				this.$refs.user_modal.reset()
			})
		},
		editUser(user) {
			this.user = user;
			this.openModal()
		},
		async deleteUser({ id }) {
			if (!await deleteMessage()) return
			try {
				await axios.delete(`/users/${id}`)
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
