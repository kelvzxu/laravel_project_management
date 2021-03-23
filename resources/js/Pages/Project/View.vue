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
    <template #board_button>
      <add-participants :users="users" :project="project" :team="team" />
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
                  :class="{ active: ViewParticipants == true }"
                  role="tab"
                  @click="ParticipantsPage"
                  >Participants</a
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
              :class="{ active: ViewParticipants == true }"
              id="notebook_page_team"
            >
              <table-responsive>
                <template #header>
                  <tr>
                    <th class="text-center" style="width: 20px">No.</th>
                    <th style="width: 191px">Participants Name</th>
                    <th style="width: 20px"></th>
                  </tr>
                </template>
                <template #content>
                  <tr
                    class="data_row"
                    v-for="(participant, i) in project.participants"
                    :key="i"
                  >
                    <td class="text-center">
                      <span>{{ i + 1 }}</span>
                    </td>
                    <td>
                      {{ participant.user.name }}
                    </td>
                    <td class="text-center">
                      <div
                        v-if="FormType == 'edit'"
                        @click="Destroyparticipant(participant)"
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
                      <tr v-if="project.manager.id == $page.user.id">
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
                              v-for="row in project.participants"
                              :select="row.user_id == ProjectForm.user_id"
                              :key="row.user_id"
                              :value="row.user_id"
                            >
                              {{ row.user.name }}
                            </option>
                          </select>
                        </td>
                      </tr>
                      <tr v-else>
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
                          <jet-input
                            id="customer"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="project.manager.name"
                            disabled
                          />
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
                      <tr>
                        <td class="o_td_label">
                          <label class="o_form_label" for="o_field_input_668"
                            >Cost Hours</label
                          >
                        </td>
                        <td style="width: 100%">
                          <jet-input
                            id="team"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="ProjectForm.cost_hours"
                          />
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="mt16 o_settings_container">
                  <div class="col-lg-5 o_setting_box" id="participant_settings">
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
import AddParticipants from "./AddParticipants";
import TableResponsive from "@/Jetstream/TableResponsive";
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
    AddParticipants,
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
    TableResponsive,
  },
  data() {
    return {
      ViewDescription: true,
      ViewSetting: false,
      ViewParticipants: false,
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
          cost_hours: this.project.cost_hours,
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
      this.ViewParticipants = false;
    },
    SettingPage() {
      this.ViewDescription = false;
      this.ViewSetting = true;
      this.ViewParticipants = false;
    },
    ParticipantsPage() {
      this.ViewDescription = false;
      this.ViewSetting = false;
      this.ViewParticipants = true;
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
    Destroyparticipant(data) {
      this.$inertia.delete(route("project_user.destroy", data), {
        preserveScroll: true,
      });
    },
    DestroyProject() {
      this.$inertia.delete(route("project.archive", this.project), {
        preserveScroll: true,
      });
    },
  },
};
</script>
