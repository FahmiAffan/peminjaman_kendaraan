<template>
  <div>
    <v-app-bar color="#03A9F4" class="navbars" height="80" dense dark>
      <v-app-bar-nav-icon @click.stop="sideBar = !sideBar"></v-app-bar-nav-icon>

      <v-toolbar-title>Nyilih Libom</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>
      <div v-if="logedIn == true">
        <!-- <v-btn icon v-if="user.role != 'admin'">
          <NuxtLink to="/cart">
            <v-badge
              v-if="MenuDataExist == true"
              overlap
              :content="menu.length"
            >
              <v-icon color="white">mdi-shopping-outline</v-icon>
            </v-badge>
            <v-icon v-else-if="MenuDataExist == false" color="white"
              >mdi-shopping-outline</v-icon
            >
          </NuxtLink>
        </v-btn>

        <v-btn style="display: none" v-else></v-btn> -->
      </div>

      <div v-else>
        <v-btn text elevation="0">
          <NuxtLink
            to="/Login"
            class="white--text text-decoration-none text-capitalize"
          >
            Log In
          </NuxtLink>
        </v-btn>
      </div>
    </v-app-bar>
    <v-card width="256">
      <v-navigation-drawer v-model="sideBar" app temporary>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="text-h6">
              {{ user.nama_user }}
            </v-list-item-title>
            <v-list-item-subtitle> {{ user.role }} </v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

        <div v-if="logedIn == true">
          <div v-if="user.role == 'kasir'">
            <v-list dense nav v-for="s in KasirSideBarList" :key="s">
              <v-list-item link :to="s.link">
                <v-list-item-icon>
                  <v-icon>{{ s.icon }}</v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                  <span>{{ s.name }}</span>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </div>
          <div v-if="user.role == 'admin'">
            <v-list dense nav v-for="s in AdminSideBarList" :key="s">
              <v-list-item link :to="s.link">
                <v-list-item-icon>
                  <v-icon>{{ s.icon }}</v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                  <span>{{ s.name }}</span>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </div>
        </div>
        <template v-slot:append>
          <div class="pa-2">
            <v-btn
              v-if="logedIn == true"
              block
              color="red"
              class="white--text"
              @click="logOut()"
            >
              Logout
            </v-btn>
            <div class="d-flex" v-else>
              <v-btn>Register</v-btn>
              <v-btn>login</v-btn>
            </div>
          </div>
        </template>
      </v-navigation-drawer>
    </v-card>
  </div>
</template>

<script>
export default {
  name: 'SidebarComponent',
  data() {
    return {
      sideBar: null,
      logedIn: null,
      ClientSideBarList: [
        {
          icon: 'mdi-view-dashboard',
          name: 'Dashboard',
          link: '/Client/',
        },
      ],
      AdminSideBarList: [
        {
          icon: 'mdi-view-dashboard',
          name: 'Dashboard',
          link: '/Admin',
        },
        {
          icon: 'mdi-view-dashboard',
          name: 'Pemesanan',
          link: '/Admin/Pemesanan',
        },
        {
          icon: 'mdi-view-dashboard',
          name: 'Histori',
          link: '/Admin/Histori',
        },
      ],
      user: [],
    }
  },
  mounted() {
    const tokenStr = localStorage.getItem('token')
    if (localStorage.getItem('token') != null) {
      this.$axios
        .$get('/api/user', {
          headers: { Authorization: `Bearer ${tokenStr}` },
        })
        .then((response) => (this.user = response), (this.logedIn = true))
        .catch(function (error) {
          console.log(error)
        })
    } else {
      this.logedIn = false
    }
  },
  methods: {
    logOut() {
      const tokenStr = localStorage.getItem('token')
      let self = this
      this.$axios
        .$post(
          'http://127.0.0.1:8080/api/logout',
          {},
          {
            headers: { Authorization: `Bearer ${tokenStr}` },
          }
        )
        .then(
          localStorage.removeItem('token'),
          self.$router.push({ path: '/' })
          // location.reload()
        )
        .catch(function (error) {
          console.log(error)
        })
    },
  },
}
</script>

<style>
</style>
