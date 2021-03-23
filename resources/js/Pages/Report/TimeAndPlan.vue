<template>
  <div class="container">
    <div class="o_title mt-2">
      <h2><b>Timesheets and Planning</b></h2>
    </div>
    <div class="o_project_plan_project_timesheet_forecast">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th></th>

              <th class="right_bordered">
                <h3>Planning</h3>
              </th>
              <th colspan="5" id="table_plan_title" class="right_bordered">
                <h3>Timesheets</h3>
              </th>
              <th id="table_plan_total"></th>
            </tr>
            <tr>
              <th>
                <span title="">Project Task</span>
              </th>
              <th class="right_bordered">
                <span title="">Total</span>
              </th>
              <th v-for="month in months" :key="month">
                <span title="">{{ month }}</span>
              </th>
              <th class="right_bordered">
                <span title="">Total</span>
              </th>
              <th>
                <span
                  title="What is still to deliver based on sold hours and hours already done. Equals to sold hours - done hours."
                  >Overtime</span
                >
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(data, i) in analysis" :key="i">
              <td>
                <span>{{ data.name }}</span>
              </td>

              <td class="right_bordered">
                <span class="text-muted">{{ FormatHours(data.planned) }}</span>
              </td>

              <td v-for="(row, i) in data.detail" :key="i" class="text-center">
                <span class="text-muted">{{ FormatHours(row.time) }} </span>
              </td>

              <td class="right_bordered">
                <span class="">{{ FormatHours(TotalTime(data.detail)) }} </span>
              </td>

              <td class="text-center">
                <span class="text-muted">{{
                  FormatHours(data.remaining)
                }}</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["project", "hours", "analysis", "months"],
  data() {
    return {
      planned: 0,
      overtime: 0,
      effective: 0,
      timesheet: 0,
    };
  },
  created() {
    this.prepareReportValue(this.hours);
  },
  methods: {
    prepareReportValue(params) {
      if (params) {
        this.planned = params.planned;
        this.overtime = parseFloat(params.overtime);
        this.effective = parseFloat(params.effective);
      }
    },
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
    formatPrice(value) {
      let val = (value / 1).toFixed(2).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
    TotalTime(values) {
      return values.reduce((acc, val) => {
        return acc + parseFloat(val.time);
      }, 0);
    },
  },
};
</script>
