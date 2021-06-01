<template>
  <jet-dashboard :team="team" :project="project">
    <template #report_name>{{ project.name }}</template>
    <template #project_name>Timesheet and Planning Analysis Report</template>
    <template #button>
      <button
        type="button"
        title="Bar Chart"
        class="btn btn-secondary"
        @click="BarChart"
      >
        <i class="fas fa-chart-bar"></i>
      </button>
      <button type="button" class="btn btn-secondary" @click="LineChart">
        <i class="fas fa-chart-area"></i>
      </button>
    </template>
    <template #report>
      <jet-bar-chart
        v-if="barchart"
        :chart-data="datacollection"
        :options="chartOptions"
      />
      <jet-line-chart
        v-if="linechart"
        :chart-data="datacollection"
        :options="chartOptions"
      />
    </template>
  </jet-dashboard>
</template>

<script>
// Dependence Page
import JetDashboard from "./Dashboard";
// Component
import JetBarChart from "@/Graphic/BarChart";
import JetLineChart from "@/Graphic/LineChart";

export default {
  props: ["project", "team", "analysis"],

  components: {
    JetDashboard,
    JetLineChart,
    JetBarChart,
  },
  data() {
    return {
      barchart: true,
      linechart: false,
      datacollection: null,
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
      },
    };
  },
  mounted() {
    this.fillData();
  },
  methods: {
    fillData() {
      this.datacollection = {
        labels: [],
        datasets: [
          {
            label: "Planned",
            fill: false,
            backgroundColor:
              "#" + ((Math.random() * 0xffffff) << 0).toString(16),
            borderColor: "#" + ((Math.random() * 0xffffff) << 0).toString(16),
            data: [],
          },
          {
            label: "Timesheet",
            fill: false,
            backgroundColor:
              "#" + ((Math.random() * 0xffffff) << 0).toString(16),
            borderColor: "#" + ((Math.random() * 0xffffff) << 0).toString(16),
            data: [],
          },
        ],
      };
      let data = this.analysis;
      let i;
      for (i in data) {
        this.datacollection.labels.push(data[i].month);
        this.datacollection.datasets[0].data.push(data[i].planned);
        this.datacollection.datasets[1].data.push(data[i].timesheet);
      }
    },
    LineChart() {
      this.barchart = false;
      this.linechart = true;
    },
    BarChart() {
      this.barchart = true;
      this.linechart = false;
    },
  },
};
</script>
