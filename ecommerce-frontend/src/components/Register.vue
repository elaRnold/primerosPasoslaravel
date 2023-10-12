<template>
    <div class="form-container">
        <form @submit.prevent="register" class="register-form">
            <input type="text" v-model="name" name="name" placeholder="Name" required>
            <input type="email" v-model="email" name="email" placeholder="Email" required>
            <input type="password" v-model="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
    </div>
</template>

<script>
import axios from "@/axios";

export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
        }
    },

    methods: {
        async register() {
            try {
                const response = await axios.post("/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password
                })

            } catch (error) {
                console.error("An error occurred: ", error)
                if (error) {
                    console.error("Error details: ", error.response.data)
                }
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

.register-form {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    width: 30rem;
    padding: 2rem;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: #8a95a0;
}

.register-form input,
.register-form button {
    padding: 1rem;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 1rem;
}

.register-form input {
    background-color: #cfd9e5;
}

.register-form button {
    background-color: #007BFF;
    color: white;
    cursor: pointer;
}
</style>