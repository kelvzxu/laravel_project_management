<template>
  <jet-dashboard>
    <template #workspace_icon>{{ task.name[0] }}</template>
    <template #workspace_name>{{ task.name }}</template>
    <template #workspace_sub_header>
      <div class="home-workspace-items-content-sub-header-wrapper">
        <jet-workspace-button
          v-if="FormType == 'view'"
          @click.native="EditForms"
        >
          <i class="far fa-edit main-icon"></i>Edit Task
        </jet-workspace-button>
        <jet-workspace-button
          v-if="FormType == 'edit'"
          @click.native="UpdateTask"
        >
          <i class="far fa-save main-icon"></i>Save Change
        </jet-workspace-button>
        <jet-workspace-button @click.native="DestroyTask">
          <i class="far fa-trash-alt main-icon"></i>Delete Task
        </jet-workspace-button>
        <jet-workspace-button @click.native="BackMethods">
          <i class="fas fa-undo-alt main-icon"></i>Back
        </jet-workspace-button>
      </div>
    </template>
    <template #board_name>{{ task.name }}</template>
    <template #board_description>Date Assign :{{ task.date_assign }}</template>
    <template #board_subs_images_label>Responsible </template>
    <template #board_subs_images>
      <img :src="task.responsible.profile_photo_url" class="inner-image" />
    </template>
    <template #board_subs> Member / {{ task.team.users.length + 1 }} </template>
    <template #board_button>
      <create-timesheet :task="task" :users="users" />
    </template>
    <template #board_button_group>
      <jet-board-button
        v-for="stage in task.project.task_type"
        :key="stage.id"
        :data-id="stage.name"
        @click.native="UpdateStage(stage.id)"
        :class="{
          'bg-primary rounded text-white': stage.id == task.stage_id,
        }"
      >
        <span class="item-title ml-2">{{ stage.name }}</span>
      </jet-board-button>
    </template>
    <template #board_component>
      <div class="container mt-3">
        <div class="oe_title">
          <div class="col-12">
            <label
              class="o_form_label oe_edit_only"
              for="o_field_input_663"
              data-original-title=""
              title=""
              >Task Name</label
            >
            <h1>
              <jet-input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="TaskForm.name"
                :disabled="FormType == 'view'"
              />
            </h1>
          </div>
        </div>
        <div class="o_group">
          <table class="o_group o_inner_group col-12 col-md-5">
            <tbody>
              <tr>
                <td class="o_td_label">
                  <label
                    class="o_form_label"
                    for="o_field_input_667"
                    data-original-title=""
                    title=""
                    >Project</label
                  >
                </td>
                <td style="width: 100%">
                  <select
                    v-model="TaskForm.team_id"
                    class="mt-1 block w-full"
                    :disabled="FormType == 'view'"
                  >
                    <option
                      v-for="project in task.team.project"
                      :select="project.id == TaskForm.team_id"
                      :key="project.id"
                      :value="project.id"
                    >
                      {{ project.name }}
                    </option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="o_td_label">
                  <label
                    class="o_form_label"
                    for="o_field_input_667"
                    data-original-title=""
                    title=""
                    >Responsible</label
                  >
                </td>
                <td style="width: 100%">
                  <select
                    v-model="TaskForm.user_id"
                    class="mt-1 block w-full"
                    :disabled="FormType == 'view'"
                  >
                    <option
                      v-for="row in task.team.users"
                      :select="row.id == TaskForm.user_id"
                      :key="row.id"
                      :value="row.id"
                    >
                      {{ row.name }}
                    </option>
                    <option
                      :select="task.team.owner.id == TaskForm.user_id"
                      :value="task.team.owner.id"
                    >
                      {{ task.team.owner.name }}
                    </option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="o_td_label">
                  <label class="o_form_label" for="o_field_input_668"
                    >Deadline</label
                  >
                </td>
                <td style="width: 100%">
                  <jet-input
                    id="date_end"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="TaskForm.date_end"
                    :disabled="FormType == 'view'"
                  />
                </td>
              </tr>
              <tr>
                <td class="o_td_label">
                  <label
                    class="o_form_label"
                    for="o_field_input_667"
                    data-original-title=""
                    title=""
                    >Tags</label
                  >
                </td>
                <td style="width: 100%">
                  <select
                    v-model="TaskForm.tag_id"
                    class="mt-1 block w-full"
                    :disabled="FormType == 'view'"
                  >
                    <option
                      v-for="project in task.project.tags"
                      :select="project.id == TaskForm.tag_id"
                      :key="project.id"
                      :value="project.id"
                    >
                      {{ project.name }}
                    </option>
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
          <table class="o_group o_inner_group col-12 col-md-5">
            <tbody>
              <tr>
                <td class="o_td_label">
                  <label class="o_form_label" for="o_field_input_668"
                    >Customer</label
                  >
                </td>
                <td style="width: 100%">
                  <jet-input
                    id="customer"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="task.project.customer"
                    disabled
                  />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="o_notebook" data-name="_default_">
          <div class="o_notebook_headers">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a
                  data-toggle="tab"
                  disable_anchor="true"
                  class="nav-link"
                  :class="{ active: ViewDescription == true }"
                  role="tab"
                  @click="TabDesc"
                  >Description</a
                >
              </li>
              <li class="nav-item" v-if="task.project.allow_timesheets">
                <a
                  data-toggle="tab"
                  disable_anchor="true"
                  class="nav-link"
                  :class="{ active: ViewTimesheet == true }"
                  role="tab"
                  @click="TabTimesheet"
                  >Timesheet</a
                >
              </li>
              <li class="nav-item">
                <a
                  data-toggle="tab"
                  disable_anchor="true"
                  class="nav-link"
                  :class="{ active: ViewExtraInfo == true }"
                  role="tab"
                  @click="TabInfo"
                  >Extra Info</a
                >
              </li>
            </ul>
          </div>
          <div class="tab-content">
            <div
              class="tab-pane"
              :class="{ active: ViewDescription == true }"
              id="notebook_page_desc"
            >
              <div v-if="FormType == 'view'" class="container">
                <div v-html="TaskForm.description"></div>
              </div>
              <vue-editor
                v-if="FormType == 'edit'"
                v-model="TaskForm.description"
              ></vue-editor>
            </div>
            <div
              class="tab-pane"
              :class="{ active: ViewTimesheet == true }"
              id="notebook_page_desc"
            >
              <table-responsive>
                <template #header>
                  <tr>
                    <th class="text-center" style="width: 100px">Date</th>
                    <th style="width: 191px">Description</th>
                    <th style="width: 100px">Duration (Hours)</th>
                    <th style="width: 20px"></th>
                  </tr>
                </template>
                <template #content>
                  <tr
                    class="data_row"
                    v-for="(timesheet, i) in task.timesheets"
                    :key="i"
                  >
                    <td>
                      <span>{{ timesheet.date }}</span>
                    </td>
                    <td>
                      {{ timesheet.name }}
                    </td>
                    <td class="text-center">
                      {{ FormatHours(timesheet.unit_amount) }}
                    </td>
                    <td class="text-center">
                      <div
                        v-if="FormType == 'edit'"
                        @click="DestroyTimesheet(timesheet)"
                      >
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </div>
                    </td>
                  </tr>
                </template>
              </table-responsive>
            </div>
            <div
              class="tab-pane"
              :class="{ active: ViewExtraInfo == true }"
              id="notebook_page_info"
            >
              <div class="container">
                <div class="o_group">
                  <table class="o_group o_inner_group col-12 col-md-5">
                    <tbody>
                      <tr>
                        <td class="o_td_label">
                          <label class="o_form_label" for="o_field_input_668"
                            >Sequence</label
                          >
                        </td>
                        <td style="width: 100%">
                          <jet-input
                            id="sequence"
                            type="number"
                            class="mt-1 block w-full"
                            v-model="TaskForm.sequence"
                            :disabled="FormType == 'view'"
                          />
                        </td>
                      </tr>
                      <tr>
                        <td class="o_td_label">
                          <label class="o_form_label" for="o_field_input_668"
                            >Email CC</label
                          >
                        </td>
                        <td style="width: 100%">
                          <jet-input
                            id="sequence"
                            type="number"
                            class="mt-1 block w-full"
                            v-model="TaskForm.email_cc"
                            :disabled="FormType == 'view'"
                          />
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="o_group o_inner_group col-12 col-md-5">
                    <tbody>
                      <tr>
                        <td class="o_td_label">
                          <label class="o_form_label" for="o_field_input_668"
                            >Assigning Date</label
                          >
                        </td>
                        <td style="width: 100%">
                          <jet-input
                            id="date_assign"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="task.date_assign"
                            disabled
                          />
                        </td>
                      </tr>
                      <tr>
                        <td class="o_td_label">
                          <label class="o_form_label" for="o_field_input_668"
                            >Last Stage Update</label
                          >
                        </td>
                        <td style="width: 100%">
                          <jet-input
                            id="date_last_stage_update"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="task.date_last_stage_update"
                            disabled
                          />
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
import JetBoardButton from "@/Jetstream/BoardButton";
// form Component
import JetInput from "@/Jetstream/Input";
// Page
import CreateTimesheet from "./CreateTimesheet";
// List Component
import TableResponsive from "@/Jetstream/TableResponsive";
// external Library
import { VueEditor } from "vue2-editor";
// Page Component
import CreateTask from "@/Pages/Task/CreateTask";

export default {
  props: ["task", "users"],

  components: {
    JetDashboard,
    JetResponsiveNavLink,
    CreateTask,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    VueEditor,
    JetWorkspaceButton,
    CreateTimesheet,
    TableResponsive,
    JetInput,
    JetBoardButton,
  },

  data() {
    return {
      FormType: "view",
      ViewDescription: true,
      ViewTimesheet: false,
      ViewExtraInfo: false,
      TaskForm: this.$inertia.form(
        {
          id: this.task.id,
          name: this.task.name,
          team_id: this.task.team_id,
          user_id: this.task.user_id,
          date_end: this.task.date_end,
          tag_id: this.task.tag_id,
          description: this.task.description,
          sequence: this.task.sequence,
          email_cc: this.task.email_cc,
        },
        {
          bag: "UpdateTask",
          resetOnSuccess: false,
        }
      ),
      TaskUpdate: this.$inertia.form({
        id: "",
        stage_id: "",
      }),
      form: this.$inertia.form(
        {
          //
        },
        {
          bag: "deleteTask",
        }
      ),
    };
  },
  created() {
    console.log(this);
  },
  methods: {
    EditForms() {
      this.FormType = "edit";
    },
    BackMethods() {
      this.$inertia.visit(
        route("project.show", this.task.project.access_token)
      );
    },
    UpdateStage(stage) {
      this.TaskUpdate.id = this.task.id;
      this.TaskUpdate.stage_id = stage;
      this.TaskUpdate.post(route("task_stage.update"), {
        preserveScroll: true,
      });
    },
    UpdateTask() {
      this.TaskForm.post(route("task_stage.update"), {
        preserveScroll: true,
      }).then((response) => {
        if (!this.TaskForm.hasErrors()) {
          this.FormType = "view";
        }
      });
    },
    DestroyTask() {
      this.form.delete(route("project_task.destroy", this.task), {
        preserveScroll: true,
      });
    },
    TabDesc() {
      this.ViewDescription = true;
      this.ViewTimesheet = false;
      this.ViewExtraInfo = false;
    },
    TabTimesheet() {
      this.ViewDescription = false;
      this.ViewTimesheet = true;
      this.ViewExtraInfo = false;
    },
    TabInfo() {
      this.ViewDescription = false;
      this.ViewTimesheet = false;
      this.ViewExtraInfo = true;
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
    DestroyTimesheet(timesheet) {
      this.form.delete(route("timesheet.destroy", timesheet), {
        preserveScroll: true,
      });
    },
  },
};
</script>
