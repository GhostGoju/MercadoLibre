<template>
	<div class="modal fade" id="category_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ is_create ? 'Crear' : 'Editar' }} Categoria</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<backend-error :errors="back_errors" />

				<!-- Formulario -->
				<Form @submit="saveCategory" :validation-schema="schema" ref="form">
					<div class="modal-body">
						<section class="row">

							<!-- Nombre -->
							<div class="col-12 mt-2">
								<label for="name">Nombre</label>
								<Field name="name" v-slot="{ errorMessage, field }" v-model="category.name">
									<input type="text" id="name" v-model="category.name"
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
	props: ['category_data'],
	components: { Field, Form },
	watch: {
		category_data(new_value) {
			this.category = { ...new_value }
			if (!this.category.id) return
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
			category: {
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

		async saveCategory() {
			try {
				const category = this.createFormData(this.category)
				if (this.is_create) await axios.post('/categories/store', category)
				else await axios.post(`/categories/update/${this.category.id}`, category)
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
			this.category = {}
			this.$parent.category = {}
			this.back_errors = {}
			setTimeout(() => this.$refs.form.resetForm(), 100);
		}

	}
}
</script>

<style lang='scss' scoped></style>
