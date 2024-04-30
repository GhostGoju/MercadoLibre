import './bootstrap'
import { createApp } from 'vue'
import vSelect from 'vue-select'

// Components ---------------------------------------------------
import TheProductList from './components/Product/TheProductList.vue'

import TheUserList from './components/User/TheUserList.vue'

import TheCategoryList from './components/Category/TheCategoryList.vue'

import TheRoleList from './components/Role/TheRoleList.vue'

import BackendError from './components/Components/BackendError.vue'

import EcommerceDetails from './components/Ecommerce/EcommerceDetails.vue'

import Carrito from './components/Cart/Carrito.vue'

const app = createApp({
	components: {
		TheProductList,
		TheUserList,
		TheCategoryList,
		TheRoleList,
		EcommerceDetails,
		Carrito,
	}
})

app.component('v-select', vSelect)
app.component('backend-error', BackendError)
app.mount('#app')
