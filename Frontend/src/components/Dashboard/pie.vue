<template>
  <!-- <Bar :data="chartData" /> -->
  <div class="max-w-md max-h-30 flex justify-center align-center">
    <Pie :data="chartData" />
  </div>
</template>

<script>
import { Bar, Pie } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'

ChartJS.register(ArcElement, Tooltip, Legend)

export default {
  name: 'App',
  components: { Pie },
  props: {
    first: Number,
    second: Number,
    third: Number
  },
  data() {
    return {
      chartData: {
        labels: ['Shortlisted', 'Pending', 'Declined',],
        datasets: [
          {
            backgroundColor: ['#41B883', '#808080', '#DD1B16'],
            // data: [this.first, this.second, this.third],
            data: [10, 5, 8],
            borderColor: ['#ffffff00']
          }
        ]
      }
    }
  }
}
</script>