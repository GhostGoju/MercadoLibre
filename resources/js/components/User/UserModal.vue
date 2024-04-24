<template>
	<div class="modal fade" id="product_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
								<label for="name">Apellidos</label>
								<Field name="name" v-slot="{ errorMessage, field }" v-model="user.name">
									<input type="text" id="name" v-model="user.name"
										:class="`form-control ${errorMessage || back_errors['name'] ? 'is-invalid' : ''}`"
										v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['name'] }}</span>
								</Field>
							</div>

							<!-- Email -->
							<div class="col-12">
								<label for="name">Email</label>
								<Field name="name" v-slot="{ errorMessage, field }" v-model="user.name">
									<input type="text" id="name" v-model="user.name"
										:class="`form-control ${errorMessage || back_errors['name'] ? 'is-invalid' : ''}`"
										v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['name'] }}</span>
								</Field>
							</div>



							<!-- Passwords -->
							<div class="col-12">
								<label for="name">Password</label>
								<Field name="name" v-slot="{ errorMessage, field }" v-model="user.name">
									<input type="text" id="name" v-model="user.name"
										:class="`form-control ${errorMessage || back_errors['name'] ? 'is-invalid' : ''}`"
										v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['name'] }}</span>
								</Field>
							</div>








						</section>
					</div>

					<!-- Buttons -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="sumbit" class="btn btn-primary">Almacenar</button>
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
				stock: yup.number().required().positive().integer(),
				description: yup.string(),
				category: yup.string().required()
			});
		},
	},
	data() {
		return {
			is_create: true,
			user: {
			},
			category: null,
			categories_data: [],
			load_category: false,
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
		createFormData(data) {
			const form_data = new FormData()
			if (this.file) form_data.append('file', this.file, this.file.name)
			for (const prop in data) {
				form_data.append(prop, data[prop])
			}
			return form_data
		},
		reset() {
			this.is_create = true
			this.user = {}
			this.$parent.user = {}
			this.back_errors = {}
			this.file = null
			this.image_preview = '/storage/images/users/default.png'
			document.getElementById('file').value = ''
			setTimeout(() => this.$refs.form.resetForm(), 100);

		}

	}
}
</script>

<style lang='scss' scoped></style>
