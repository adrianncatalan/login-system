<template>
    <div>
        <form class="register-ts" @submit.prevent="registerUser">
            <label for="name">Name</label>
            <input type="text" name="name">

            <label for="lastname">Lastname</label>
            <input type="text" name="lastname">

            <label for="username">Username</label>
            <input type="text" name="username">

            <label for="email">Email</label>
            <input type="email" name="email">

            <label for="phone">Phone</label>
            <input type="text" name="phone">

            <label for="password">Password</label>
            <input type="password" name="password">

            <button type="submit">Register</button>
        </form>
    </div>
</template>

<script>
import register from './services/register.ts'

export default {
    name: 'RegisterView',
    methods: {
        async registerUser() {
            try {
                await register();
            } catch (error) {
                console.error('Error registering user:', error);
            }
        }
    },
}
</script>

<style scoped>
div>form {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
</style>
