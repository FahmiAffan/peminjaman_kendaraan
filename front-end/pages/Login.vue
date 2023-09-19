<template>
  <div class="light-blue darken-1">
    <v-alert
      style="position: absolute !important; right: 10px; top: 10px"
      :value="wrongPassword"
      type="error"
      dismissible
      prominent
      transition="scroll-x-transition"
      >Password Anda Salah</v-alert
    >
    <v-container class="mc-1 d-flex align-center" style="height: 100vh">
      <v-row justify="center">
        <v-col class="mc-1 d-flex justify-center" cols="6">
          <v-card
            height="400px"
            width="400px"
            class="px-5 rounded-lg d-flex flex-column justify-space-between"
          >
            <div>
              <h1 class="pt-3" style="font-size: 44px">Login</h1>
              <div class="mt-5">
                <v-text-field
                  solo
                  placeholder="username"
                  type="email"
                  v-model="username"
                ></v-text-field>
                <v-text-field
                  solo
                  placeholder="password"
                  type="password"
                  v-model="password"
                ></v-text-field>
              </div>
            </div>
            <div>
              <v-btn
                block
                class="mb-5 white--text"
                color="light-blue darken-1"
                @click="LogIn()"
                >Login</v-btn
              >
            </div>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
// const router = useRouter();
export default {
  name: 'LoginPage',
  data() {
    return {
      username: [],
      password: [],
      logedIn: null,
      wrongPassword: false,
    }
  },
  methods: {
    LogIn() {
      let self = this
      self.wrongPassword = false
      this.$axios
        .$post('http://127.0.0.1:8080/api/login', {
          username: this.username,
          password: this.password,
        })
        .then(function (response) {
          if (response.success == true && response.user_data.role == 'client') {
            localStorage.setItem('token', response.token)
            self.$router.push({ path: '/Client/' })
          } else if (
            response.success == true &&
            response.user_data.role == 'admin'
          ) {
            localStorage.setItem('token', response.token)
            self.$router.push({ path: '/Admin/' })
          } else {
            self.wrongPassword = true
            console.log('password anda salah')
          }
        })
        .catch(function (error) {
          console.log(error)
        })
    },
  },
  mounted() {
    const tokenAvilable = localStorage.getItem('token')
    if (tokenAvilable != null) {
      let self = this
      self.$router.push({ path: '/' })
    }
  },
}
</script>

<style>
.mc-1 {
  border: 1px solid red;
}
.theme--light.v-text-field--solo > .v-input__control > .v-input__slot {
  background: rgba(196, 196, 196, 0.219);
}
.v-text-field__details {
  min-height: 0;
}
.v-messages {
  min-height: 0;
}
</style>
