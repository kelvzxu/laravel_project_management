<template>
  <jet-dashboard :team="team" :project="project">
    <template #report_name>Task Analysis</template>
    <template #project_name>{{ project.name }}</template>
    <template #report> </template>
  </jet-dashboard>
</template>

<script>
// Dependence Page
import JetDashboard from "./Dashboard";

export default {
  props: ["project", "team", "task_analysis"],

  components: {
    JetDashboard,
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
};
</script>
