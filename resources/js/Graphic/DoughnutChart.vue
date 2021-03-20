<script>
import { Doughnut, mixins } from "vue-chartjs";
export default {
  extends: Doughnut,
  props: ["chartData", "options"],
  mounted() {
    // this.chartData is created in the mixin.
    // If you want to pass options please create a local options object
    // this.renderChart(this.data, {
    //   borderWidth: "10px",
    //   hoverBackgroundColor: "red",
    //   hoverBorderWidth: "10px",
    // });
    this.renderChart(this.chartData, this.options);
  },
};
</script>