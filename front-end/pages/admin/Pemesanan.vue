<template>
  <div>
    <SideBarVue />
    <div class="d-flex justify-end">
      <v-dialog
        v-model="dialog"
        fullscreen
        hide-overlay
        transition="dialog-bottom-transition"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn color="primary" dark v-bind="attrs" v-on="on" class="ma-5">
            Tambah Pesanan
          </v-btn>
        </template>
        <v-card>
          <v-card-title class="text-h5 grey lighten-2">
            Privacy Policy
          </v-card-title>

          <v-card-text>
            <v-row class="pt-5">
              <v-col cols="12">
                <v-text-field
                  outlined
                  label="Nama Menu"
                  v-model="inputField.driver"
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-select
                  :items="jenisMenu"
                  v-model="inputField.persetujuan_admin"
                ></v-select>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  outlined
                  label="Harga"
                  v-model="inputField.harga"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-card-text>

          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" text @click="dialog = false">
              I accept
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
    <v-simple-table>
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-left">Driver</th>
            <th class="text-left">Konsumsi BBM</th>
            <th class="text-left">Status</th>
            <th class="text-left">Nama Kendaraan</th>
            <th class="text-left">Jenis Angkutan</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in pemesanan" :key="item">
            <td>{{ item.driver }}</td>
            <td>{{ item.konsumsi_bbm }} km/l</td>
            <td>
              <div
                v-if="
                  item.persetujuan_admin == 'setuju' &&
                  item.persetujuan_pihak == 'setuju'
                "
              >
                <v-chip class="ma-2" color="primary" outlined>
                  <v-icon left> mdi-check</v-icon>
                  Berhasil
                </v-chip>
              </div>
              <div
                v-else-if="
                  item.persetujuan_admin == 'setuju' &&
                  item.persetujuan_pihak == 'menunggu'
                "
              >
                <v-chip class="ma-2" color="primary" outlined>
                  <v-icon left> mdi-clock </v-icon>
                  {{ item.persetujuan_pihak }}
                </v-chip>
              </div>
              <div v-else>Gagal Disewa</div>
            </td>
            <td>{{ item.kendaraan.nama_kendaraan }}</td>
            <td>{{ item.kendaraan.jenis_angkutan_kendaraan }}</td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </div>
</template>

<script>
import SideBarVue from '~/components/SideBar.vue'
export default {
  name: 'PemesananPage',
  data() {
    return {
      dialog: false,
      pemesanan: [],
      inputField: {
        driver: '',
        konsumsi_bbm: '',
        persetujuan_admin: '',
        persetujuan_pihak: '',
        id_user: '',
        id_kendaraan: '',
      },
    }
  },
  methods: {
    TambahPesanan() {
      this.$axios
        .$post('api/pemesanan', {
          driver: 'Purna',
          konsumsi_bbm: '8',
          persetujuan_admin: 'setuju',
          persetujuan_pihak: 'menunggu',
          id_user: '1',
          id_kendaraan: '1',
        })
        .then((res) => console.log(res))
    },
  },
  components: {
    SideBarVue,
  },
  mounted() {
    this.$axios.$get('api/pemesanan').then((res) => (this.pemesanan = res))
  },
}
</script>

<style>
</style>
