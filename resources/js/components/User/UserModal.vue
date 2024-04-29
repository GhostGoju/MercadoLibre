<template>
	<div class="modal fade" id="user_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ is_create ? 'Crear' : 'Editar' }} usuario</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<backend-error :errors="back_errors" />

				<!-- Formulario -->
				<Form @submit="saveUser" :validation-schema="schema" ref="form">
					<div class="modal-body">
						<section class="row">

							<!-- Nombre -->
							<div class="col-12 mt-2">
								<label for="name">Nombre</label>
								<Field name="name" v-slot="{ errorMessage, field }" v-model="user.name">
									<input type="text" id="name" v-model="user.name"
										:class="`form-control ${errorMessage || back_errors['name'] ? 'is-invalid' : ''}`"
										v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['name'] }}</span>
								</Field>
							</div>
							<!-- apellido -->
							<div class="col-12 mt-2">
								<label for="last_name">Apellido</label>
								<Field name="last_name" v-slot="{ errorMessage, field }" v-model="user.last_name">
									<input type="text" id="last_name" v-model="user.last_name"
										:class="`form-control ${errorMessage || back_errors['last_name'] ? 'is-invalid' : ''}`"
										v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['last_name'] }}</span>
								</Field>
							</div>
							<!-- email -->
							<div class="col-12 mt-2">
								<label for="email">Email</label>
								<Field name="email" v-slot="{ errorMessage, field }" v-model="user.email">
									<input type="email" id="email" v-model="user.email"
										:class="`form-control ${errorMessage || back_errors['email'] ? 'is-invalid' : ''}`"
										v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['email'] }}</span>
								</Field>
							</div>



							<!-- Role -->
							<div class="col-12 mt-2" v-if="load_role">
								<Field name="role" v-slot="{ errorMessage, field, valid }" v-model="role">
									<label for="role">Rol</label>

									<v-select id="role" :options="roles_data" v-model="role"
										:reduce="role => role.id" v-bind="field" label="role"
										placeholder="Selecciona Rol" :clearable="false"
										:class="`${errorMessage ? 'is-invalid' : ''}`">
									</v-select>
									<span class="invalid-feedback" v-if="!valid">{{ errorMessage }}</span>
								</Field>
							</div>
						</section>
					</div>

					<!-- Buttons -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Almacenar</button>
					</div>
				</Form>
			</div>
		</div>
	</div>
</template>

<script>

import { Field, Form } from 'vee-validate'
import * as yup from 'yup';
import { successMessage, handlerErrors } from '@/helpers/Alerts.js'

export default {
	props: ['users'],
	components: { Field, Form },
	watch: {
		user_data(new_value) {
			this.user = { ...new_value }
			if (!this.user.id) return
			this.is_create = false
			this.role = this.user.role_id
		}
	},
	computed: {
		schema() {
			return yup.object({
				name: yup.string().required(),
				last_name: yup.string().required(),
				email: yup.string().required(),
				password: yup.string().required(),
				role: yup.string().required(),
			});
		},
	},
	data() {
		return {
			is_create: true,
			user: {
			},
			role: null,
			roles_data: [],
			load_role: false,
			back_errors: {},
		}
	},
	created() {
		this.index()
	},

	methods: {
		index() {
			// this.getRoles()
		},

		async saveUser() {
			try {
				this.user.role_id = this.role
				const user = this.createFormData(this.user)
				if (this.is_create) await axios.post('/users/store', user)
				else await axios.post(`/users/update/${this.user.id}`, user)
				await successMessage({ reload: true })
			} catch (error) {
				this.back_errors = await handlerErrors(error)
			}
		},
		createFormData(data) {
			const form_data = new FormData()
			for (const prop in data) {
				form_data.append(prop, data[prop])
			}
			return form_data
		},


		async getRoles() {
			// try {
			// 	const { data: { roles } } = await axios.get('roles')
			// 	this.roles_data = roles
			// 	this.load_role = true
			// } catch (error) {
			// 	await handlerErrors(error)
			// }
		},


		reset() {
			this.is_create = true
			this.user = {}
			this.role = null
			this.$parent.user = {}
			this.back_errors = {}
			setTimeout(() => this.$refs.form.resetForm(), 100);
		}

	}
}
</script>

<style lang='scss' scoped></style>
