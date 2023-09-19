<template>
  <div>
    <SideBarVue />
    <v-btn color="green" @click="print" class="white--text">Expor Excel</v-btn>
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
  name: 'HistoriPage',
  data() {
    return {
      pemesanan: [],
    }
  },
  components: {
    SideBarVue,
  },
  methods: {
    print() {
      this.$axios
        .$get('api/export')
        .then((response) => {
          // Handle the response and data
          // You may want to format the data here if needed
          const link = document.createElement('a')
          link.href = 'http://127.0.0.1:8080/api/export'
          link.download = 'data-pemesanan.xlsx'

          link.click()
        })
        .catch((error) => {
          console.error('Error fetching data:', error)
        })
    },
  },
  mounted() {
    this.$axios.$get('api/pemesanan').then((res) => (this.pemesanan = res))
  },
}
</script>

<style>
</style>
