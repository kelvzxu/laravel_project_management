<template>
  <jet-dashboard :team="team" :project="project">
    <template #report_name>Report Overview</template>
    <template #project_name>{{ project.name }}</template>
    <template #report>
      <div id="report" class="container project_overview_report">
        <hours-and-project-cost :project="project" :hours="hours" />
        <time-people :participants="participants"/>
      </div>
    </template>
  </jet-dashboard>
</template>

<script>
// Dependence Page
import JetDashboard from "./Dashboard";
import HoursAndProjectCost from "./HoursAndCost";
import TimePeople from "./TimeByPeople";

export default {
  props: ["project", "team", "hours", "participants"],

  components: {
    JetDashboard,
    HoursAndProjectCost,
    TimePeople,
  },
  data() {
    return {
       options: {
        text: {
          color: "#FFFFFF",
          shadowEnable: true,
          shadowColor: "#000000",
          fontSize: 14,
          fontFamily: "Helvetica",
          dynamicPosition: false,
          hideText: false,
        },
        progress: {
          color: "#2dbd2d",
          backgroundColor: "gray",
        },
        layout: {
          height: 18,
          width: 250,
          verticalTextAlign: 61,
          horizontalTextAlign: 43,
          zeroOffset: 0,
          strokeWidth: 30,
          progressPadding: 0,
          type: "line",
        },
      },
    };
  },
  created() {
    console.log(this);
  },
  methods: {
    FormatHours(value) {
      let minutes = value * 60;
      return this.time_convert(minutes);
    },
    time_convert(num) {
      let hours = Math.floor(num / 60);
      if (hours < 10) {
        hours = `0${hours}`;
      }
      let minutes = Math.round(num % 60);
      if (minutes < 10) {
        minutes = `0${minutes}`;
      }
      return `${hours}:${minutes}`;
    },
  },
};
</script>