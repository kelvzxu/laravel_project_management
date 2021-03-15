<template>
  <jet-dashboard>
    <template #workspace_icon>{{ project.name[0] }}</template>
    <template #workspace_name>{{ project.name }}</template>
    <template #workspace_sub_header>
      <jet-workspace-sub-header :project="project" />
    </template>
    <template #page Modal>
      <!-- <create-task :users="users" :project="project" /> -->
    </template>
    <template #board_name>{{ project.name }}</template>
    <template #board_description><b>Project Tags</b></template>
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
            <th style="width: 171px">Tags Name</th>
            <th style="width: 190px">Projects</th>
            <th style="width: 190px">Color</th>
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
          <tr class="data_row" v-for="(tag, i) in tags" :key="i">
            <td>
              <span
                class="row_handle fa fa-arrows ui-sortable-handle o_field_widget"
                name="sequence"
              ></span>
            </td>
            <td>
              <span v-if="UpdateForm.id !== tag.id">{{ tag.name }}</span
              ><input v-else type="text" class="w-full" v-model="tag.name" />
            </td>
            <td>{{ project.name }}</td>
            <td>
              <span
                class="badge"
                v-bind:style="{ 'background-color': tag.color }"
                >{{ tag.color }}</span
              >
            </td>
            <td class="text-center" v-if="$page.user.id == project.manager.id">
              <div @click="editTags(tag)" v-if="UpdateForm.id !== tag.id">
                <i class="far fa-edit" aria-hidden="true"></i>
              </div>
              <div @click="UpdateTags" v-else>
                <i class="far fa-save" aria-hidden="true"></i>
              </div>
            </td>
            <td class="text-center" v-if="$page.user.id == project.manager.id">
              <div @click="DestroyTags(tag)" v-if="UpdateForm.id !== tag.id">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </div>
              <div @click="Discard" v-else>
                <i class="fas fa-undo-alt" aria-hidden="true"></i>
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
// List Component
import TableResponsive from "@/Jetstream/TableResponsive";
// Module
import draggable from "vuedraggable";
// Page Component
import CreateStage from "./CreateStage";

export default {
  props: ["team", "users", "project", "tags"],

  components: {
    JetDashboard,
    CreateStage,
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
      form: this.$inertia.form(
        {
          id: "",
          name: "",
        },
        {
          bag: "deleteTask",
        }
      ),
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
    DestroyTags(stage) {
      this.form.delete(route("tags.destroy", stage), {
        preserveScroll: true,
      });
    },
    editTags(stage) {
      this.UpdateForm = stage;
    },
    UpdateTags() {
      this.$inertia
        .post(route("tags.update"), {
          id: this.UpdateForm.id,
          name: this.UpdateForm.name,
          preserveScroll: true,
        })
        .then((response) => {
          this.Discard();
        });
    },
    Discard() {
      this.UpdateForm = this.$inertia.form(
        {
          //
        },
        {
          bag: "deleteTask",
        }
      );
    },
  },
};
</script>
