<template>
  <table-responsive>
    <template #header>
      <tr>
        <th
          class="o_handle_cell o_column_sortable o_list_number_th"
          style="min-width: 33px; width: 33px"
        ></th>
        <th>Project Name</th>
        <th>Manager</th>
      </tr>
    </template>
    <template #content>
      <tr class="data_row" v-for="(project, i) in projects" :key="i">
        <td></td>
        <td>{{ project.name }}</td>
        <td>{{ project.manager.name }}</td>
      </tr>
    </template>
  </table-responsive>
</template>
<script>
import TableResponsive from "@/Jetstream/TableResponsive";

export default {
  props: ["team", "projects"],

  components: {
    TableResponsive,
  },
  data() {
    return {
      isMobile: true,
    };
  },
  created() {
    console.log(this);
  },
};
</script>
