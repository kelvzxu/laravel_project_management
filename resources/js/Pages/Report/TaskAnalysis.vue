<template>
  <jet-dashboard :team="team" :project="project">
    <template #report_name>{{ project.name }}</template>
    <template #project_name>Task Analysis Report</template>
    <template #button>
      <button
        type="button"
        title="Bar Chart"
        class="btn btn-secondary"
        @click="BarChart"
      >
        <i class="fas fa-chart-bar"></i>
      </button>
      <button type="button" class="btn btn-secondary" @click="DoughnutChart">
        <i class="fas fa-chart-pie"></i>
      </button>
    </template>
    <template #report>
      <jet-bar-chart
        v-if="barchart"
        :chart-data="datacollection"
        :options="chartOptions"
      />
      <jet-doughnut-chart
        v-if="doughnutchart"
        :chart-data="data2collection"
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
import JetDoughnutChart from "@/Graphic/DoughnutChart";

export default {
  props: ["project", "team", "task_analysis"],

  components: {
    JetDashboard,
    JetBarChart,
    JetDoughnutChart,
  },
  data() {
    return {
      barchart: true,
      doughnutchart: false,
      datacollection: null,
      data2collection: null,
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
        labels: [this.project.name],
        datasets: [],
      };
      this.data2collection = {
        labels: [],
        datasets: [
          {
            label: [this.project.name],
            backgroundColor: [],
            data: [],
          },
        ],
      };
      let data = this.task_analysis;
      let i;
      for (i in data) {
        console.log(data[i].name);
        this.datacollection.datasets.push({
          label: data[i].name,
          backgroundColor: "#" + ((Math.random() * 0xffffff) << 0).toString(16),
          data: [data[i].task],
        });
        this.data2collection.labels.push(data[i].name);
        this.data2collection.datasets[0].data.push(data[i].task);
        this.data2collection.datasets[0].backgroundColor.push(
          "#" + ((Math.random() * 0xffffff) << 0).toString(16)
        );
      }
    },
    increase() {
      this.height += 10;
    },
    DoughnutChart() {
      this.barchart = false;
      this.doughnutchart = true;
    },
    BarChart() {
      this.barchart = true;
      this.doughnutchart = false;
    },
  },
};
</script>
