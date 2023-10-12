<template>
    <form @submit.prevent="submitForm" class="add-product-form">
        <input class="input-field" v-model="name" placeholder="Product Name">
        <p v-if="errors.name" class="error">{{ errors.name }}</p>
        <input class="input-field" v-model="description" placeholder="Product Description">
        <p v-if="errors.description" class="error">{{ errors.description }}</p>
        <input class="input-field" v-model="price" placeholder="Product Price">
        <p v-if="errors.price" class="error">{{ errors.price }}</p>

        <button type="submit" class="submit-button">Add Product</button>
    </form>
</template>

<script>
import axios from "@/axios";

export default {
    data() {
        return {
            name: '',
            description: '',
            price: '',
            errors: {},
        }
    },
    methods: {
        validateInput() {
            const errors = {}
            if (!this.name) errors.name = 'Name is required'
            if (!this.description) errors.description = 'Description is required'
            if (!this.price || isNaN(this.price)) errors.price = 'Price is required and must be a number'
            return errors
        },
        async submitForm() {
            const errors = this.validateInput()

            if (Object.keys(errors).length > 0) {
                this.errors = errors
                return;
            }

            try {

                await axios.post('/products', {
                    name: this.name,
                    description: this.description,
                    price: this.price
                })

                this.$router.push('/')

            } catch (error) {
                console.error('An error ocurred while adding a product')
            }
        }
    }
}
</script>

<style scoped>
.error {
    color: white;
    font-size: 1rem;
}

.add-product-form {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 40rem;
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
    padding: 1rem 2rem;
    background-color: greenyellow;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1.6rem;
    width: 36%;
}

</style>