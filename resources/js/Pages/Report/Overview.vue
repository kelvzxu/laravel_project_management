<template>
  <jet-dashboard :team="team" :project="project">
    <template #report_name>Report Overview</template>
    <template #project_name>{{ project.name }}</template>
    <template #report>
      <div id="report" class="container project_overview_report">
        <hours-and-project-cost :project="project" :hours="hours" />
      </div>
    </template>
  </jet-dashboard>
</template>

<script>
// Dependence Page
import JetDashboard from "./Dashboard";
import HoursAndProjectCost from "./HoursAndCost";
import HoursAndCost from "./HoursAndCost.vue";

export default {
  props: ["project", "team", "hours"],

  components: {
    JetDashboard,
    HoursAndProjectCost,
  },
};
</script>

    HoursAndCost