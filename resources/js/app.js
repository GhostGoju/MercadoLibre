import './bootstrap'
import { createApp } from 'vue'
import vSelect from 'vue-select'

// Components ---------------------------------------------------
import TheProductList from './components/Product/TheProductList.vue'
import TheCategoryList from './components/Category/TheCategoryList.vue'
import TheCategoryList from './components/User/TheUserList.vue'
import BackendError from './components/components/BackendError.vue'

const app = createApp({
	components: {
		TheProductList,
		TheCategoryList,
		TheUserList,
	}
})

app.component('v-select', vSelect)
app.component('backend-error', BackendError)
app.mount('#app')
