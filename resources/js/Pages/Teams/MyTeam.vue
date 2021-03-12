<template>
  <app-layout>
    <app-content>
      <div class="application-content">
        <control-panel>
          <template #title
            ><li
              class="breadcrumb-item active font-weight-bold text-black"
              v-if="isMobile == false"
            >
              Kelvin Leonardi Teams
            </li></template
          >
          <template #search>
            <div
              role="search"
              class="cp_search_view mb-0"
              v-if="isMobile == false"
            >
              <div role="search" class="o_searchview">
                <i role="img" class="searchview_icon fa fa-search"></i>
                <div class="searchview_input_container">
                  <input
                    type="text"
                    placeholder="Search..."
                    role="searchbox"
                    class="searchview_input"
                  />
                </div>
              </div>
            </div>
            <div role="search" class="cp_searchview o_searchview_quick" v-else>
              <div role="search" class="o_searchview">
                <button
                  type="button"
                  class="enable_searchview btn btn-link fa fa-arrow-left"
                ></button>
                <div class="searchview_input_container">
                  <input
                    type="text"
                    placeholder="Search..."
                    role="searchbox"
                    class="searchview_input"
                  />
                </div>
                <button
                  type="button"
                  class="toggle_searchview_full btn fa fa-filter"
                ></button>
              </div>
            </div>
          </template>
          <template #button>
            <inertia-link
              class="btn btn-primary rounded"
              :href="route('teams.create')"
            >
              Create
            </inertia-link>
          </template>
        </control-panel>
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
      </div>
    </app-content>
  </app-layout>
</template>


<script>
import AppContent from "@/Jetstream/ApplicationContent";
import AppLayout from "@/Layouts/AppLayout";
import ControlPanel from "@/Jetstream/ControlPanel";
import TableResponsive from "@/Jetstream/TableResponsive";
import JetSuccessButton from "@/Jetstream/SuccessButton";

export default {
  props: ["teams"],

  components: {
    AppContent,
    AppLayout,
    ControlPanel,
    TableResponsive,
    JetSuccessButton,
  },
  data() {
    return {
      isMobile: true,
    };
  },
  created() {
    this.detectMob();
  },
  methods: {
    detectMob() {
      if (window.innerWidth <= 767) {
        this.isMobile = true;
      } else {
        this.isMobile = false;
      }
    },
    viewDetail(row) {
      this.$inertia.visit(route("teams.show", row.id));
    },
  },
};
</script>
