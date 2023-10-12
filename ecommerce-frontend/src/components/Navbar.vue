<template>
    <nav>
        <router-link class="routerLink" to="/login" v-if="!isLoggedIn">Login</router-link>
        <router-link class="routerLink" to="/register" v-if="!isLoggedIn">Register</router-link>
        <router-link class="routerLink" to="/" v-if="isLoggedIn">Product List</router-link>
        <router-link class="routerLink" to="/add-product" v-if="isLoggedIn">Add Product</router-link>
        <a href="#" class="routerLink" @click="logout" v-if="isLoggedIn">Logout</a>
    </nav>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
    computed: {
        ...mapState(['isLoggedIn'])
    },
    methods: {
        ...mapActions(['logout'])
    }
}
</script>

<style scoped>

nav {
    display: flex;
    align-items: center;
    justify-content: space-around;
    margin-top: 3rem;
    background-color: rgb(24, 241, 161);
    width: 30rem;
    height: 2rem;
    margin-left: auto;
    margin-right: auto;

    .routerLink{
        text-decoration: none;
        color: rgb(0, 0, 0);
        font-size: 1.4rem;
    }
}
</style>