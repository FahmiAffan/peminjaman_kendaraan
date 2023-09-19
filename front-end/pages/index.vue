<template>
  <div>Please Wait...</div>
</template>

<script>
export default {
  name: 'IndexPage',
  data() {
    return {}
  },
  mounted() {
    const tokenStr = localStorage.getItem('token')
    let self = this
    if (tokenStr != null) {
      this.$axios
        .$get('http://127.0.0.1:8080/api/user', {
          headers: { Authorization: `Bearer ${tokenStr}` },
        })
        .then(function (response) {
          if (response.role == 'client') {
            self.$router.push({ path: '/client' })
          } else if (response.role == 'admin') {
            self.$router.push({ path: '/Admin' })
          }
        })
        .catch(function (error) {
          console.log(error)
        })
    } else {
      self.$router.push({ path: '/Login' })
    }
  },
}
</script>

<style>
</style>
