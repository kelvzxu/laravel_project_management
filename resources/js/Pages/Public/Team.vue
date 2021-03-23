<template>
  <jet-profile :users="users">
    <template #content>
      <table-responsive>
        <template #header>
          <tr>
            <th
              class="o_handle_cell o_column_sortable o_list_number_th"
              style="min-width: 33px; width: 33px"
            ></th>
            <th style="width: 171px">Team Name</th>
            <th style="width: 190px">Description</th>
            <th style="width: 190px">Team Leader</th>
            <th style="width: 180px">Country</th>
          </tr>
        </template>
        <template #content>
          <tr
            class="data_row"
            v-for="(team, i) in teams"
            :key="i"
            @click="viewDetail(team)"
          >
            <td>
              <span
                class="row_handle fa fa-arrows ui-sortable-handle o_field_widget"
                name="sequence"
              ></span>
            </td>
            <td>{{ team.name }}</td>
            <td>{{ team.description }}</td>
            <td>{{ team.owner.name }}</td>
            <td>Indonesia</td>
          </tr>
        </template>
      </table-responsive>
    </template>
  </jet-profile>
</template>

<script>
import TableResponsive from "@/Jetstream/TableResponsive";
// Page
import JetProfile from "./dashboard";

export default {
  props: ["users", "teams"],

  components: {
    JetProfile,
    TableResponsive,
  },
  methods: {
    viewDetail(row) {
      this.$inertia.visit(route("teams.show", row.access_token));
    },
  },
};
</script>