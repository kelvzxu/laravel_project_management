<template>
  <jet-dashboard :team="team" :project="project">
    <template #report_name>Report Overview</template>
    <template #project_name>{{ project.name }}</template>
    <template #report>
      <div id="report" class="container project_overview_report">
        <hours-and-project-cost :project="project" :hours="hours" />
        <div class="o_title mt-2">
          <h2><b>Time by people</b></h2>
        </div>
        <div class="o_timesheet_plan_sale_timesheet_people_time">
          <div class="table-responsive">
            <table id="time_by_people" class="table">
              <thead>
                <tr>
                  <th></th>
                  <th>Member</th>
                  <th class="text-nowrap text-right pr-5">Hours Spent</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(data, i) in participants" :key="i">
                  <td style="width: 3%; vertical-align: middle">
                    <img
                      class="img rounded-circle pr-1 mb-2"
                      width="25"
                      height="25"
                      :src="data.responsible.profile_photo_url"
                      :title="data.responsible.name"
                      loading="lazy"
                    />
                  </td>
                  <td style="width: 15%; vertical-align: middle">
                    <a
                      type="action"
                      data-model="account.analytic.line"
                      data-views='[[0, "list"]]'
                      tabindex="-1"
                      data-domain='[["project_id", "in", [9]]]'
                      data-context='{"search_default_employee_id": 1}'
                    >
                      {{ data.responsible.name }}
                    </a>
                  </td>
                  <td
                    class="text-right pr-5"
                    style="width: 10%; vertical-align: middle"
                  >
                    {{ FormatHours(data.hours) }}
                  </td>
                  <td style="vertical-align: middle">
                    <div class="border rounded">
                      <div
                        class="progress"
                        style="width: 0%; margin-bottom: 0em"
                      ></div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </template>
  </jet-dashboard>
</template>

<script>
// Dependence Page
import JetDashboard from "./Dashboard";
import HoursAndProjectCost from "./HoursAndCost";

export default {
  props: ["project", "team", "hours", "participants"],

  components: {
    JetDashboard,
    HoursAndProjectCost,
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