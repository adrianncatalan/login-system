<template>
  <div>
    <form action="">
      <label for="username">Username</label>
      <input type="text" name="username">

      <label for="password">Password</label>
      <input type="password" name="password">

      <button type="submit">Login</button>
    </form>

  </div>
</template>
<script>
export default {

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