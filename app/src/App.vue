<template>
  <div>
    <RegisterView />
  </div>
</template>

<script>
import RegisterView from './views/register/RegisterView.vue'

export default {
  components: {
    RegisterView
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
