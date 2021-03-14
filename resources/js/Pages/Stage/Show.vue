<template>
  <jet-dashboard>
    <template #workspace_icon>{{ project.name[0] }}</template>
    <template #workspace_name>{{ project.name }}</template>
    <template #workspace_sub_header>
      <div class="home-workspace-items-content-sub-header-wrapper">
        <jet-responsive-nav-link
          :href="route('project.show', project.access_token)"
          :active="route().current('teams.show')"
        >
          <jet-workspace-button>
            <i class="fa fa-th-large main-icon"></i>Kanban Board
          </jet-workspace-button>
        </jet-responsive-nav-link>
        <jet-responsive-nav-link
          :href="route('timesheet.show', project.access_token)"
          :active="route().current('timesheet.show')"
        >
          <jet-workspace-button>
            <i class="far fa-stopwatch main-icon"></i>Timesheets
          </jet-workspace-button>
        </jet-responsive-nav-link>
        <jet-responsive-nav-link
          :href="route('project.show', project.access_token)"
          :active="route().current('teams.show')"
        >
          <jet-workspace-button>
            <i class="fas fa-file-chart-line main-icon"></i>Project Report
          </jet-workspace-button>
        </jet-responsive-nav-link>
        <jet-responsive-nav-link
          :href="route('stage.show', project.access_token)"
          :active="route().current('stage.view')"
        >
          <jet-workspace-button class="workspace floating">
            <i class="far fa-layer-group main-icon main-icon"></i>Project Stage
          </jet-workspace-button>
        </jet-responsive-nav-link>
        <jet-responsive-nav-link
          :href="route('stage.show', project.access_token)"
          :active="route().current('stage.view')"
        >
          <jet-workspace-button>
            <i class="fas fa-tags main-icon"></i>Project Tags
          </jet-workspace-button>
        </jet-responsive-nav-link>
        <jet-responsive-nav-link
          :href="route('project.detail', project.access_token)"
          :active="route().current('project.detail')"
        >
          <jet-workspace-button>
            <i class="fa fa-cog main-icon"></i>Project Details
          </jet-workspace-button>
        </jet-responsive-nav-link>
      </div>
    </template>
    <template #page Modal>
      <!-- <create-task :users="users" :project="project" /> -->
    </template>
    <template #board_name>{{ project.name }}</template>
    <template #board_description
      >Date Start : {{ project.date_start }}<br />Deadline:{{
        project.date_end
      }}</template
    >
    <template #board_subs_images_label>Manager </template>
    <template #board_subs_images>
      <img :src="project.manager.profile_photo_url" class="inner-image" />
    </template>
    <template #board_subs> Member / {{ team.users.length + 1 }} </template>
    <template #board_button>
      <create-stage :users="users" :project="project" :team="team" />
    </template>
    <template #board_button_group>
      <jet-board-search
        ><input placeholder="Search... " value="" style="width: 100%"
      /></jet-board-search>
    </template>
    <template #board_component>
      <table-responsive>
        <template #header>
          <tr>
            <th
              class="o_handle_cell o_column_sortable o_list_number_th"
              style="min-width: 33px; width: 33px"
            ></th>
            <th style="width: 171px">Stage Name</th>
            <th style="width: 190px">Projects</th>
            <th style="width: 190px">Closing State</th>
          </tr>
        </template>
        <template #content>
          <tr class="data_row" v-for="(task, i) in project.task_type" :key="i">
            <td>
              <span
                class="row_handle fa fa-arrows ui-sortable-handle o_field_widget"
                name="sequence"
              ></span>
            </td>
            <td>{{ task.name }}</td>
            <td>{{ project.name }}</td>
            <td>{{ task.is_closed }}</td>
          </tr>
        </template>
      </table-responsive>
    </template>
  </jet-dashboard>
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import JetDashboard from "@/Jetstream/Dashboard";
// Workspace Component
import JetBoardSorting from "@/Jetstream/BoardSorting";
import JetBoardSearch from "@/Jetstream/BoardSearch";
import JetBoardDropdown from "@/Jetstream/BoardDropdown";
import JetBoardFilterDropdown from "@/Jetstream/BoardFilterDropdown";
import JetWorkspaceButton from "@/Jetstream/WorkspaceButton";
// List Component
import TableResponsive from "@/Jetstream/TableResponsive";
// Module
import draggable from "vuedraggable";
// Page Component
import CreateStage from "./CreateStage";

export default {
  props: ["team", "users", "project"],

  components: {
    JetDashboard,
    JetResponsiveNavLink,
    CreateStage,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    draggable,
    JetWorkspaceButton,
    TableResponsive,
  },
  data() {
    return {
      FilterDropdown: false,
      TaskUpdate: this.$inertia.form({
        id: "",
        stage_id: "",
      }),
    };
  },
  methods: {
    onAdd(event, stage) {
      this.TaskUpdate.id = event.item.getAttribute("data-id");
      this.TaskUpdate.stage_id = stage;
      this.TaskUpdate.post(route("task_stage.update"), {
        preserveScroll: true,
      });
    },
    ViewTask(row) {
      this.$inertia.visit(route("project_task.view", row.access_token));
    },
    FilterData() {
      if (this.FilterDropdown == false) {
        this.FilterDropdown = true;
      } else {
        this.FilterDropdown = false;
      }
    },
  },
};
</script>
