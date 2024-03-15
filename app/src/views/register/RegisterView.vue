<template>
    <div>
        <form class="register-ts" @submit.prevent="registerUser">
            <label for="name">Name</label>
            <input type="text" name="name" required minlength="3" maxlength="50">

            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" required minlength="3" maxlength="50">

            <label for="username">Username</label>
            <input type="text" name="username" required minlength="5" maxlength="50">

            <label for="email">Email</label>
            <input type="email" name="email" required minlength="5" maxlength="50">

            <label for="phone">Phone</label>
            <input type="text" name="phone" required minlength="8" maxlength="50">

            <label for="password">Password</label>
            <input type="password" name="password" required minlength="8" maxlength="50">

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
