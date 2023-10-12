<template>
    <div v-if="product" class="product-details">
        <h2 class="product-title">{{ product.name }}</h2>
        <p class="product-description"> {{ product.description }}</p>
        <p class="product-price">Price: ${{ product.price }}</p>
    </div>
</template>

<script>
import axios from "@/axios";

export default {
    data() {
        return {
            product: null
        }
    },

    async mounted() {
        const productID = this.$route.params.id
        try {
            const response = await axios.get(`/products/${productID}`)
            this.product = response.data
        } catch (error) {
            console.error("An error ocurred: ", error)
        }
    }
}
</script>