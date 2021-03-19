<template>
  <jet-dashboard :team="team" :project="project">
    <template #report_name>{{ project.name }}</template>
    <template #project_name>Task Analysis Report</template>
    <template #report>
      <jet-line-chart :chart-data="datacollection" :options="chartOptions" />
    </template>
  </jet-dashboard>
</template>

<script>
// Dependence Page
import JetDashboard from "./Dashboard";
// Component
import JetLineChart from "@/Graphic/LineChart";

export default {
  props: ["project", "team", "task_analysis"],

  components: {
    JetDashboard,
    JetLineChart,
  },
  data() {
    return {
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
        labels: ["Odoo 14"],
        datasets: [],
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
      }
    },
    increase() {
      this.height += 10;
    },
  },
};
</script>
