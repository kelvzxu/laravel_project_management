<template>
  <jet-dashboard>
    <template #workspace_icon>{{ project.name[0] }}</template>
    <template #workspace_name>{{ project.name }}</template>
    <template #workspace_sub_header>
      <jet-workspace-sub-header :project="project" />
    </template>
    <template #board_name>{{ project.name }}</template>
    <template #board_description><b>Project Activity</b></template>
    <template #board_subs_images_label>Manager </template>
    <template #board_subs_images>
      <img :src="project.manager.profile_photo_url" class="inner-image" />
    </template>
    <template #board_subs> Member / {{ team.users.length + 1 }} </template>
    <template #board_button>
      <jet-wrapper-button @click.native="AddActivity">
        Scedule New
      </jet-wrapper-button>
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
            <th style="width: 171px">Activity Name</th>
            <th style="width: 190px">Activity Type</th>
            <th style="width: 190px">Responsible</th>
            <th style="width: 190px">Due Date</th>
            <th
              style="width: 20px"
              v-if="$page.user.id == project.manager.id"
            ></th>
            <th
              style="width: 20px"
              v-if="$page.user.id == project.manager.id"
            ></th>
          </tr>
        </template>
        <template #content>
          <tr class="data_row" v-for="(activity, i) in activities" :key="i">
            <td>
              <span
                class="row_handle fa fa-arrows ui-sortable-handle o_field_widget"
                name="sequence"
              ></span>
            </td>
            <td>
              <span>{{ activity.name }}</span>
            </td>
            <td>{{ activity.activity_type }}</td>
            <td>
              {{ activity.responsible.name }}
            </td>
            <td>
              {{ activity.due_date }}
            </td>
            <td class="text-center" v-if="$page.user.id == project.manager.id">
              <div @click="editActivity(activity)">
                <i class="far fa-edit" aria-hidden="true"></i>
              </div>
            </td>
            <td class="text-center" v-if="$page.user.id == project.manager.id">
              <div @click="DestroyActivity(activity)">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </div>
            </td>
          </tr>
        </template>
      </table-responsive>
    </template>
  </jet-dashboard>
</template>

<script>
import JetDashboard from "@/Jetstream/Dashboard";
// Workspace Component
import JetBoardSorting from "@/Jetstream/BoardSorting";
import JetBoardSearch from "@/Jetstream/BoardSearch";
import JetBoardDropdown from "@/Jetstream/BoardDropdown";
import JetBoardFilterDropdown from "@/Jetstream/BoardFilterDropdown";
import JetWorkspaceSubHeader from "@/Jetstream/WorkspaceSubHeader";
import JetWrapperButton from "@/Jetstream/WrapperButton";
// List Component
import TableResponsive from "@/Jetstream/TableResponsive";
// Module
import draggable from "vuedraggable";

export default {
  props: ["team", "users", "project", "activities"],

  components: {
    JetDashboard,
    JetWrapperButton,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    draggable,
    TableResponsive,
    JetWorkspaceSubHeader,
  },
  data() {
    return {
      FilterDropdown: false,
      TaskUpdate: this.$inertia.form({
        id: "",
        stage_id: "",
      }),
      UpdateForm: this.$inertia.form(
        {
          //
        },
        {
          bag: "deleteTask",
        }
      ),
    };
  },
  methods: {
    AddActivity() {
      this.$inertia.get(route("activity.create", this.project.access_token), {
        preserveScroll: true,
      });
    },
    DestroyActivity(activity) {
      this.$inertia.delete(route("activity.destroy", activity), {
        preserveScroll: true,
      });
    },
    editActivity(activity) {
      this.$inertia.get(route("activity.edit", activity.access_token), {
        preserveScroll: true,
      });
    },
  },
};
</script>
