<template>
  <div>
    <SideBarVue />
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
      pemesanan: [],
    }
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
