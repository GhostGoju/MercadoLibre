<template>
	<div class="modal fade" id="role_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ is_create ? 'Crear' : 'Editar' }} Rol</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<backend-error :errors="back_errors" />

				<!-- Formulario -->
				<Form @submit="saveRole" :validation-schema="schema" ref="form">
					<div class="modal-body">
						<section class="row">

							<!-- Nombre -->
							<div class="col-12 mt-2">
								<label for="name">Nombre</label>
								<Field name="name" v-slot="{ errorMessage, field }" v-model="role.name">
									<input type="text" id="name" v-model="role.name"
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
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Guardar</button>
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
	props: ['role_data'],
	components: { Field, Form },
	watch: {
		role_data(new_value) {
			this.role = { ...new_value }
			if (!this.role.id) return
			this.is_create = false
		}
	},
	computed: {
		schema() {
			return yup.object({
				name: yup.string().required(),
			});
		},
	},
	data() {
		return {
			is_create: true,
			role: {
			},
			back_errors: {},
		}
	},
	created() {
		this.index()
	},

	methods: {
		index() {
		},

		async saveRole() {
			try {
				const role = this.createFormData(this.role)
				if (this.is_create) await axios.post('/roles/store', role)
				else await axios.post(`/roles/update/${this.role.id}`, role)
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

		reset() {
			this.is_create = true
			this.role = {}
			this.$parent.role = {}
			this.back_errors = {}
		}

	}
}
</script>

<style lang='scss' scoped></style>
