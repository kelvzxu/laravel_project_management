<template>
  <jet-dashboard>
    <template #workspace_icon>{{ project.name[0] }}</template>
    <template #workspace_name>{{ project.name }}</template>
    <template #workspace_sub_header>
      <div class="home-workspace-items-content-sub-header-wrapper">
        <jet-workspace-button
          v-if="FormType == 'view'"
          @click.native="EditForms"
        >
          <i class="far fa-edit main-icon"></i>Edit Project
        </jet-workspace-button>
        <jet-workspace-button
          v-if="FormType == 'edit'"
          @click.native="UpdateForms"
        >
          <i class="far fa-save main-icon"></i>Save Change
        </jet-workspace-button>
        <jet-workspace-button @click.native="DestroyProject">
          <i class="far fa-trash-alt main-icon"></i>Delete Project
        </jet-workspace-button>
        <jet-workspace-button @click.native="BackMethods">
          <i class="fas fa-undo-alt main-icon"></i>Back
        </jet-workspace-button>
      </div>
    </template>
    <template #page Modal>
      <!-- <create-task :users="users" :project="project" /> -->
    </template>
    <template #board_name>{{ project.name }}</template>
    <template #board_description><b>Project Detail</b></template>
    <template #board_subs_images_label>Manager </template>
    <template #board_subs_images>
      <img :src="project.manager.profile_photo_url" class="inner-image" />
    </template>
    <template #board_subs> Member / {{ team.users.length + 1 }} </template>
    <template #board_component>
      <div class="o_not_full oe_button_box">
        <button
          type="button"
          class="btn oe_stat_button"
          name="attachment_tree_view"
        >
          <i class="fas fa-fw o_button_icon fa-tasks-alt"></i>
          <div
            name="doc_count"
            class="o_field_widget o_stat_info o_readonly_modifier"
            data-original-title=""
            title=""
          >
            <span class="o_stat_value">1</span>
            <span class="o_stat_text">{{ project.label_tasks }}</span>
          </div>
        </button>
        <button
          type="button"
          class="btn oe_stat_button"
          name="attachment_tree_view"
        >
          <i class="fa fa-fw o_button_icon fa-file-text-o"></i>
          <div
            name="doc_count"
            class="o_field_widget o_stat_info o_readonly_modifier"
            data-original-title=""
            title=""
          >
            <span class="o_stat_value">1</span>
            <span class="o_stat_text">Documents</span>
          </div>
        </button>
      </div>
      <div class="container mt-1">
        <div class="oe_title">
          <div class="col-12">
            <h1>
              <jet-input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="ProjectForm.name"
                :disabled="FormType == 'view'"
              />
            </h1>
            <div name="options_active">
              <div>
                <label
                  class="o_form_label oe_inline"
                  for="o_field_input_663"
                  data-original-title=""
                  title=""
                  >Name of the tasks:</label
                ><jet-input
                  id="label_tasks"
                  type="text"
                  v-model="ProjectForm.label_tasks"
                  :disabled="FormType == 'view'"
                />
              </div>
            </div>
          </div>
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
                  @click="DescriptionPage"
                  >Description</a
                >
              </li>
              <li class="nav-item">
                <a
                  data-toggle="tab"
                  disable_anchor="true"
                  class="nav-link"
                  :class="{ active: ViewSetting == true }"
                  role="tab"
                  @click="SettingPage"
                  >Setting</a
                >
              </li>
            </ul>
          </div>
          <div class="tab-content">
            <div
              class="tab-pane"
              :class="{ active: ViewDescription == true }"
              id="notebook_page_team"
            >
              <div class="col-12">
                <div v-if="FormType == 'view'" class="container">
                  <span v-html="ProjectForm.description"></span>
                </div>
                <vue-editor
                  v-if="FormType == 'edit'"
                  v-model="ProjectForm.description"
                ></vue-editor>
              </div>
            </div>
            <div
              class="tab-pane"
              :class="{ active: ViewSetting == true }"
              id="notebook_page_project"
            >
              <div class="col-12">
                <div class="row o_group">
                  <table class="o_group o_inner_group col-12 col-md-5">
                    <tbody>
                      <tr>
                        <td class="o_td_label"></td>
                        <td style="width: 100%"></td>
                      </tr>
                      <tr>
                        <td class="o_td_label">
                          <label
                            class="o_form_label"
                            for="o_field_input_667"
                            data-original-title=""
                            title=""
                            >Manager</label
                          >
                        </td>
                        <td style="width: 100%">
                          <select
                            v-model="ProjectForm.user_id"
                            class="mt-1 block w-full"
                            :disabled="FormType == 'view'"
                          >
                            <option
                              :select="ProjectForm.user_id"
                              :value="null"
                            ></option>
                            <option
                              v-for="row in team.users"
                              :select="row.id == ProjectForm.user_id"
                              :key="row.id"
                              :value="row.id"
                            >
                              {{ row.name }}
                            </option>
                            <option
                              :select="team.owner.id == ProjectForm.user_id"
                              :value="team.owner.id"
                            >
                              {{ team.owner.name }}
                            </option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td class="o_td_label">
                          <label
                            class="o_form_label"
                            for="o_field_input_668"
                            data-original-title=""
                            title=""
                            >Customer</label
                          >
                        </td>
                        <td style="width: 100%">
                          <jet-input
                            id="customer"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="ProjectForm.customer"
                            :disabled="FormType == 'view'"
                          />
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="o_group o_inner_group col-12 col-md-5">
                    <tbody>
                      <tr>
                        <td class="o_td_label"></td>
                        <td style="width: 100%"></td>
                      </tr>
                      <tr>
                        <td class="o_td_label">
                          <label class="o_form_label" for="o_field_input_668"
                            >Team</label
                          >
                        </td>
                        <td style="width: 100%">
                          <jet-input
                            id="team"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="team.name"
                            disabled
                          />
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="mt16 o_settings_container">
                  <div class="col-lg-5 o_setting_box" id="timesheet_settings">
                    <div class="o_setting_left_pane">
                      <div
                        class="custom-control custom-checkbox o_field_boolean o_field_widget"
                        name="allow_timesheets"
                      >
                        <input
                          id="o_field_input_737"
                          type="checkbox"
                          class="custom-control-input"
                          v-model="ProjectForm.allow_timesheets"
                          :disabled="FormType == 'view'"
                        /><label
                          for="o_field_input_737"
                          class="custom-control-label"
                        ></label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane">
                      <label class="o_form_label" for="o_field_input_737"
                        >Timesheets</label
                      >
                      <div class="text-muted">Log time on tasks</div>
                    </div>
                  </div>
                  <div class="col-lg-5 o_setting_box">
                    <div class="o_setting_left_pane">
                      <div
                        class="custom-control custom-checkbox o_field_boolean o_field_widget"
                      >
                        <input
                          id="o_field_input_738"
                          type="checkbox"
                          class="custom-control-input"
                          v-model="ProjectForm.allow_timesheet_timer"
                          :disabled="FormType == 'view'"
                        /><label
                          for="o_field_input_738"
                          class="custom-control-label"
                          >&#8203;</label
                        >
                      </div>
                    </div>
                    <div class="o_setting_right_pane">
                      <label
                        class="o_form_label"
                        for="o_field_input_738"
                        data-original-title=""
                        title=""
                        >Timesheet Timer</label
                      >
                      <div class="text-muted">
                        Track your time using a timer
                      </div>
                    </div>
                  </div>
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
import JetWorkspaceSubHeader from "@/Jetstream/WorkspaceSubHeader";
import JetWorkspaceButton from "@/Jetstream/WorkspaceButton";
// Kanban Component
import KanbanArea from "@/Jetstream/KanbanArea";
import KanbanBox from "@/Jetstream/KanbanBoxGroup";
import KanbanProgress from "@/Jetstream/KanbanProgress";
// Module
import draggable from "vuedraggable";
// Page Component
import CreateTask from "@/Pages/Task/CreateTask";
// Form Component
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetForm from "@/Jetstream/Form";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetRadio from "@/Jetstream/InputRadio";
import { VueEditor } from "vue2-editor";

export default {
  props: ["team", "users", "project"],

  components: {
    JetDashboard,
    CreateTask,
    JetResponsiveNavLink,
    KanbanArea,
    KanbanBox,
    KanbanProgress,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    draggable,
    JetWorkspaceSubHeader,
    JetActionMessage,
    JetButton,
    JetForm,
    JetInput,
    JetInputError,
    JetLabel,
    JetRadio,
    VueEditor,
    JetWorkspaceButton,
  },
  data() {
    return {
      ViewDescription: true,
      ViewSetting: false,
      FormType: "view",
      ProjectForm: this.$inertia.form(
        {
          id: this.project.id,
          name: this.project.name,
          label_tasks: this.project.label_tasks,
          user_id: this.project.user_id,
          customer: this.project.customer,
          visibility: this.project.visibility,
          allow_timesheets: this.project.allow_timesheets,
          allow_timesheet_timer: this.project.allow_timesheet_timer,
          description: this.project.description,
        },
        {
          bag: "createTeam",
          resetOnSuccess: false,
        }
      ),
    };
  },
  methods: {
    DescriptionPage() {
      this.ViewDescription = true;
      this.ViewSetting = false;
    },
    SettingPage() {
      this.ViewDescription = false;
      this.ViewSetting = true;
    },
    VisibilityFollow() {
      this.ProjectForm.visibility = "follow";
    },
    VisibilityTeam() {
      this.ProjectForm.visibility = "team";
    },
    UpdateForms() {
      this.ProjectForm.post(route("project.update"), {
        preserveScroll: true,
      }).then((response) => {
        if (!this.ProjectForm.hasErrors()) {
          this.FormType = "view";
        }
      });
    },
    EditForms() {
      this.FormType = "edit";
    },
    BackMethods() {
      this.$inertia.visit(route("project.show", this.project.access_token));
    },
    DestroyProject() {},
  },
};
</script>
