<template>
    <div class="login-container">
        <h2>Login</h2>
        <form @submit.prevent="login">
            <div>
                <label for="email">Email</label>
                <input type="email" v-model="email" required />
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" v-model="password" required />
            </div>
            <button type="submit">Login</button>
            <div v-if="error" class="error">{{ error }}</div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
    setup() {
        const email = ref('');
        const password = ref('');
        const error = ref(null);
        const router = useRouter();

        const login = async () => {
            error.value = null;
            try {
                await axios.post('/login', { email: email.value, password: password.value });
                router.push('/'); // Redirect after successful login
            } catch (err) {
                error.value = 'Invalid email or password';
            }
        };

        return {
            email,
            password,
            error,
            login,
        };
    },
};
</script>

<style>
.login-container {
    max-width: 400px;
    margin: auto;
    padding: 1em;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.login-container h2 {
    text-align: center;
}

.error {
    color: red;
    text-align: center;
}
</style>
