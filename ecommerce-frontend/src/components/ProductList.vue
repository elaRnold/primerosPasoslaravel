<template>
    <div class="container">
        <ul class="product-list">
            <li class="product-item" v-for="product in products" :key="product.id">
                <span class="product-name">{{ product.name }}</span>
                <div class="action-links">
                    <router-link class="edit-link" :to="{ path: '/edit-product:' + product.id}">Edit</router-link>
                    <router-link class="details-link" :to="{ name: 'ProductDetails', params: { id: product.id} }">View Details</router-link>
                    <button class="delete-btn" @click="deleteProduct(product.id)">Delete</button>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from "@/axios";
import { RouterLink } from "vue-router";

export default {
    // component data
    data() {
        return {
            products: []
        };
    },
    async created() {
        try {
            const response = await axios.get('/products');
            this.products = response.data;
        }
        catch (error) {
            console.error("An error ocurred while fetching the products: ", error);
        }
    },
    methods: {
        async deleteProduct(id) {
            try {
                await axios.delete(`/products/${id}`);
                this.products = this.products.filter(product => product.id !== id);
            }
            catch (error) {
                console.error("An error ocurred while deleting the product: ", error);
            }
        }
    },
    components: { RouterLink },
}
</script>

<style scoped>

.container {
    margin-left: auto;
    margin-right: auto;
    margin-top: 3rem;
    max-width: 50rem;
}

.product-list {
    max-width: 80rem;
    margin: 0 auto;
    padding: 2rem;
    background-color: #149409;
    border-radius: 8px;
}

.product-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
    margin: 8px 0;
    border-bottom: 1px solid #ddd;
}

.product-name {
    font-weight: bold;
    font-size: 1.1rem;
    color: white;
}

.action-links {
    display: flex;
    align-items: center;
}

.edit-link, .details-link, .delete-btn {
    margin: 0 8px;
    font-size: 0.9em;
}

.edit-link, .details-link {
    background-color: rgb(35, 195, 195);
    padding: 5px 10px;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
}

.delete-btn {
    padding: 5px 10px;
    background-color: rgb(221, 79, 79);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

</style>