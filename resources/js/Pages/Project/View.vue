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
              {{ project.name }}
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
            <jet-primary-button
              v-if="FormType == 'view'"
              :type="'button'"
              @click.native="EditProjectForms"
            >
              Edit
            </jet-primary-button>
            <jet-primary-button
              v-if="FormType == 'edit'"
              :type="'button'"
              @click.native="UpdateProjectForms"
            >
              Save
            </jet-primary-button>
          </template>
        </control-panel>
        <div class="o_not_full oe_button_box mt-1">
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
        <div class="mt-5 mt-md-4">
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
                    <div v-html="ProjectForm.description"></div>
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
                            <jet-label>Visibility</jet-label>
                          </td>
                          <td style="width: 100%">
                            <div
                              class="o_field_radio o_vertical o_field_widget o_required_modifier"
                              name="privacy_visibility"
                              role="radiogroup"
                              aria-label="Visibility"
                              id="o_field_input_674"
                            >
                              <div
                                class="custom-control custom-radio o_radio_item"
                                @click="VisibilityFollow"
                              >
                                <jet-radio
                                  name="radio712"
                                  id="invite_user"
                                  :checked="ProjectForm.visibility == 'follow'"
                                />
                                <jet-label
                                  class="custom-control-label"
                                  for="invite_user"
                                  >Invited Team User</jet-label
                                >
                              </div>

                              <div
                                class="custom-control custom-radio o_radio_item"
                                @click="VisibilityTeam"
                              >
                                <jet-radio
                                  name="radio712"
                                  id="all_team_user"
                                  :checked="ProjectForm.visibility == 'team'"
                                />
                                <jet-label
                                  class="custom-control-label"
                                  for="all_team_user"
                                  >All Team Users</jet-label
                                >
                              </div>
                            </div>
                          </td>
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
      </div>
    </app-content>
  </app-layout>
</template>


<script>
import AppContent from "@/Jetstream/ApplicationContent";
import AppLayout from "@/Layouts/AppLayout";
import ControlPanel from "@/Jetstream/ControlPanel";
import TableResponsive from "@/Jetstream/TableResponsive";
import JetPrimaryButton from "@/Jetstream/PrimaryButton";

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
    AppContent,
    AppLayout,
    ControlPanel,
    TableResponsive,
    JetPrimaryButton,
    JetActionMessage,
    JetButton,
    JetForm,
    JetInput,
    JetInputError,
    JetLabel,
    JetRadio,
    VueEditor,
  },
  data() {
    return {
      isMobile: true,
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
    UpdateProjectForms() {
      this.ProjectForm.post(route("project.update"), {
        preserveScroll: true,
      }).then((response) => {
        if (!this.ProjectForm.hasErrors()) {
          this.FormType = "view";
        }
      });
    },
    EditProjectForms() {
      this.FormType = "edit";
    },
  },
};
</script>
