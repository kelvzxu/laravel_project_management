<template>
  <jet-dashboard :team="team" :project="project">
    <template #report_name>{{ project.name }}</template>
    <template #project_name>Project Costs Report</template>
    <template #report>
      <jet-line-chart :chart-data="datacollection" :options="chartOptions" />
    </template>
  </jet-dashboard>
</template>

<script>
// Dependence Page
import JetDashboard from "./Dashboard";
// Component
import JetLineChart from "@/Graphic/BarChart";

export default {
  props: ["project", "team", "costs"],

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
        labels: [],
        datasets: [
          {
            label: "Project Cost",
            backgroundColor:
              "#" + ((Math.random() * 0xffffff) << 0).toString(16),
            data: [],
          },
        ],
      };
      let data = this.costs;
      let i;
      for (i in data) {
        this.datacollection.labels.push(data[i].month);
        this.datacollection.datasets[0].data.push(data[i].cost);
      }
    },
    increase() {
      this.height += 10;
    },
  },
};
</script>
