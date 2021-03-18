<template>
  <jet-dashboard :team="team" :project="project">
    <template #report_name>Task Analysis</template>
    <template #project_name>{{ project.name }}</template>
    <template #report>

    </template>
  </jet-dashboard>
</template>

<script>
// Dependence Page
import JetDashboard from "./Dashboard";
// Component
import JetLineChart from "@/Graphic/LineChart"

export default {
  props: ["project", "team"],

  components: {
    JetDashboard,
    JetLineChart,
  },
};
</script>
