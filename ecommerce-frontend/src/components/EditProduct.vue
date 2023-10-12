<template>
    <div class="edit-product">
        <form @submit.prevent="submitForm" class="edit-product-form">
            <input class="input-field" v-model="product.name" placeholder="Product Name">
            <p v-if="errors.name" class="error">{{ errors.name }}</p>

            <input class="input-field" v-model="product.description" placeholder="Product Description">
            <p v-if="errors.description" class="error">{{ errors.description }}</p>

            <input class="input-field" v-model="product.price" placeholder="Product Price">
            <p v-if="errors.price" class="error">{{ errors.price }}</p>

            <button type="submit" class="submit-button">Update Product</button>
        </form>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import axios from '@/axios';    


export default {
    setup() {
        const product = ref({id: null, name: '', description: '', price:''})
        const errors = ref({})

        const route = useRoute()
        product.value.id = route.params.id.substring(1)

        const router = useRouter()

        const validateInput = () => {
            const errorMessages = {}
            if (!product.value.name) {
                errorMessages.name = 'Name is required'
            }
            if (!product.value.description) {
                errorMessages.description = 'description is required'
            }
            if (!product.value.price || isNaN(product.value.price)) {
                errorMessages.price = 'price is required and must be a number'
            }

            return errorMessages
        }

        const submitForm = async () => {
            const errorMessages = validateInput()
            if (Object.keys(errorMessages).length > 0) {
                errors.value = errorMessages
                return
            }

            try {
                await axios.put(`/products/${product.value.id}`, product.value)
                router.push('/')
            } catch (error) {
                console.error("An error ocurred while updating: ", error)
            }
        }

        onMounted(async () => {
            try {
                const response = await axios.get(`/products/${product.value.id}`)
                product.value.name = response.data.name
                product.value.description = response.data.description
                product.value.price = response.data.price
            } catch (error) {
                console.error("An error ocurred while updating: ", error)
            }
        })

        return { product, submitForm, errors}
    }
}

</script>

<style scoped>
.error {
    color: white;
    font-size: 1rem;
}

.edit-product-form {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 30rem;
    margin: 2rem auto;
    padding: 2rem;
    background-color: rebeccapurple;
    border-radius: 8px;
}

.input-field {
    width: 100%;
    display: block;
    margin: 1rem 0;
    padding: 1rem;
    font-size: 1em;
}

.submit-button {
    padding: .5rem .5rem;
    background-color: greenyellow;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1.3rem;
    width: 51%;
}
</style>