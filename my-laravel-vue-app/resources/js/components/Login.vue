<template>
    <div class="login-container">
        <h2>Login</h2>
        <form @submit.prevent="handleLogin">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" v-model="email" required />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" v-model="password" required />
            </div>
            <button type="submit">Login</button>
            <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
        </form>
    </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
    name: 'Login',
    setup() {
        const email = ref('');
        const password = ref('');
        const errorMessage = ref('');

        const handleLogin = async () => {
            errorMessage.value = '';
            try {
                await axios.post('/login', {
                    email: email.value,
                    password: password.value,
                });
                // Redirect to homepage or dashboard
                window.location.href = '/';
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    errorMessage.value = 'Invalid credentials. Please try again.';
                } else {
                    errorMessage.value = 'An error occurred. Please try again.';
                }
            }
        };

        return { email, password, handleLogin, errorMessage };
    },
};
</script>

<style scoped>
.login-container {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
h2 {
    text-align: center;
}
.form-group {
    margin-bottom: 15px;
}
label {
    display: block;
    margin-bottom: 5px;
}
input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}
button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}
button:hover {
    background-color: #0056b3;
}
.error {
    color: red;
    margin-top: 10px;
    text-align: center;
}
</style>
