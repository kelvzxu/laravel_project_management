<template>
  <div id="recorded_hours_and_cost">
    <div class="o_title">
      <h2><b>Recorded Hours and Project Costs</b></h2>
    </div>
    <div class="o_profitability_wrapper">
      <div class="o_profitability_section">
        <div>
          <table class="table table-borderless">
            <tbody>
              <tr>
                <th>
                  <span style="color: #00a09d">Hours recorded</span>
                </th>
              </tr>
              <tr>
                <td>{{ FormatHours(planned) }}</td>
                <td title="Total Planned Hours on project task">
                  Planned Hours
                </td>
              </tr>
              <tr>
                <td class="o_timesheet_plan_dashboard_cell">
                  {{ FormatHours(overtime) }}
                </td>
                <td title="total overtime hours on working task">
                  Overtime Hours
                </td>
              </tr>

              <tr>
                <td class="o_timesheet_plan_dashboard_cell">
                  {{ FormatHours(effective) }}
                </td>
                <td title="total effective hours on working task">
                  Effective Hours
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="o_profitability_section">
        <div>
          <table class="table">
            <tbody>
              <tr>
                <th>
                  <span style="color: #00a09d">Project Costs</span>
                </th>
              </tr>
              <tr>
                <td
                  class="o_timesheet_plan_dashboard_cell"
                  style="text-align: right"
                >
                  {{ formatPrice(planned * project.cost_hours) }}
                </td>
                <td title="Revenues linked to Timesheets already invoiced.">
                  Planning Cost
                </td>
              </tr>
              <tr>
                <td
                  class="o_timesheet_plan_dashboard_cell"
                  style="text-align: right"
                >
                  {{
                    formatPrice((overtime + effective) * -project.cost_hours)
                  }}
                </td>
                <td title="Revenues linked to Timesheets already invoiced.">
                  Timesheet Cost
                </td>
              </tr>
              <tr>
                <td class="o_timesheet_plan_dashboard_total">
                  <b>
                    {{
                      formatPrice(
                        planned * project.cost_hours +
                          (overtime + effective) * -project.cost_hours
                      )
                    }}
                  </b>
                </td>
                <td><b>Remaining Cost</b></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["project", "hours"],
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
  },
};
</script>
