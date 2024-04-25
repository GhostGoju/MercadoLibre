<template>
	<div class="modal fade" id="user_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ is_create ? 'Crear' : 'Editar' }} Usuarios</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<backend-error :errors="back_errors" />

				<!-- Formulario -->
				<Form @submit="saveUser" :validation-schema="schema" ref="form">
					<div class="modal-body">
						<section class="row">

							<!-- Name -->
							<div class="col-12">
								<label for="name">Nombre</label>
								<Field name="name" v-slot="{ errorMessage, field }" v-model="user.name">
									<input type="text" id="name" v-model="user.name"
										:class="`form-control ${errorMessage || back_errors['name'] ? 'is-invalid' : ''}`"
										v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['name'] }}</span>
								</Field>
							</div>


							<!-- Last Name -->
							<div class="col-12">
								<label for="last_name">Apellidos</label>
								<Field name="last_name" v-slot="{ errorMessage, field }" v-model="user.last_name">
									<input type="text" id="last_name" v-model="user.last_name"
										:class="`form-control ${errorMessage || back_errors['last_name'] ? 'is-invalid' : ''}`"
										v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['last_name'] }}</span>
								</Field>
							</div>

							<!-- Email -->
							<div class="col-12">
								<label for="email">Email</label>
								<Field name="email" v-slot="{ errorMessage, field }" v-model="user.email">
									<input type="emails" id="email" v-model="user.email"
										:class="`form-control ${errorMessage || back_errors['email'] ? 'is-invalid' : ''}`"
										v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['email'] }}</span>
								</Field>
							</div>



							<!-- Passwords -->
							<div class="col-12">
								<label for="password">Password</label>
								<Field name="password" v-slot="{ errorMessage, field }" v-model="user.password">
									<input type="password" id="password" v-model="user.password"
										:class="`form-control ${errorMessage || back_errors['password'] ? 'is-invalid' : ''}`"
										v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['password'] }}</span>
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
	props: ['user_data'],
	components: { Field, Form },
	watch: {
		user_data(new_value) {
			this.user = { ...new_value }
			if (!this.user.id) return
			this.is_create = false
		}
	},
	computed: {
		schema() {
			return yup.object({
				name: yup.string().required(),
				last_name: yup.string().required(),
				email: yup.string().required(),
				password: yup.string().required()
			});
		},
	},
	data() {
		return {
			is_create: true,
			user: {
			},
			name: null,
			last_name: null,
			email: null,
			password: null,
			back_errors: {},
		}
	},
	created() {
		this.index()
	},

	methods: {

		async saveUser() {
			try {
				const user = this.createFormData(this.user)
				if (this.is_create) await axios.post('/users/store', user)
				else await axios.post(`/user/update/${this.user.id}`, user)
				await successMessage({ reload: true })
			} catch (error) {
				this.back_errors = await handlerErrors(error)
			}
		},
		reset() {
			this.is_create = true
			this.user = {}
			this.name = null
			this.last_name = null
			this.email = null
			this.password = null
			this.$parent.user = {}
			this.back_errors = {}
			setTimeout(() => this.$refs.form.resetForm(), 100);
		}
	}
}
</script>

<style lang='scss' scoped></style>
