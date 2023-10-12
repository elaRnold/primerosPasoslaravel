<template>
    <div class="form-container">
        <form @submit.prevent="login" class="login-form">
            <input type="email" v-model="email" name="email" placeholder="Email" required>
            <input type="password" v-model="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</template>

<script>
import axios from "@/axios";

export default {
    data() {
        return {
            email: "",
            password: "",
        }
    },

    methods: {
        async login() {
            try {
                const response = await axios.post("/login", {
                    email: this.email,
                    password: this.password
                })

                if (response.data.token) {
                    localStorage.setItem('token', response.data.token)
                }

                this.$store.commit('LOGIN')
                this.$router.push('/')

            } catch (error) {
                console.error("An error occurred: ", error)
            }
        }
    }
}
</script>

<style scoped>
.form-container {
    margin-top: 4rem;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-form {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    width: 30rem;
    padding: 2rem;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: #8a95a0;
}

.login-form input,
.login-form button {
    padding: 1rem;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 1rem;
}

.login-form input {
    background-color: #cfd9e5;
}

.login-form button {
    background-color: #007BFF;
    color: white;
    cursor: pointer;
}
</style>