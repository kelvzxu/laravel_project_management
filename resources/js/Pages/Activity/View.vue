<template>
  <jet-dashboard>
    <template #workspace_icon>{{ activity.name[0] }}</template>
    <template #workspace_name>{{ activity.name }}</template>
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
        <jet-workspace-button @click.native="DestroyActivity">
          <i class="far fa-trash-alt main-icon"></i>Delete Activity
        </jet-workspace-button>
        <jet-workspace-button @click.native="BackMethods">
          <i class="fas fa-undo-alt main-icon"></i>Back
        </jet-workspace-button>
      </div>
    </template>
    <template #board_name>{{ activity.name }}</template>
    <template #board_description><b>Project Activity</b></template>
    <template #board_subs_images_label>Responsible </template>
    <template #board_subs_images>
      <img :src="activity.responsibleprofile_photo_url" class="inner-image" />
    </template>
    <template #board_subs> Member / {{ team.users.length + 1 }} </template>
    <template #board_component>
      <div class="container">
        <div class="o_group">
          <table class="o_group o_inner_group col-12 col-md-5">
            <tbody>
              <tr>
                <td class="o_td_label">
                  <label
                    class="o_form_label"
                    for="o_field_input_665"
                    data-original-title=""
                    title=""
                    >Summary</label
                  >
                </td>
                <td style="width: 100%">
                  <div class="o_input_dropdown">
                    <jet-input
                      id="name2"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.name"
                      :disabled="FormType == 'view'"
                    />
                    <jet-input-error
                      :message="$page.errors.name"
                      class="mt-2"
                    />
                  </div>
                </td>
              </tr>
              <tr>
                <td class="o_td_label">
                  <label
                    class="o_form_label"
                    for="o_field_input_665"
                    data-original-title=""
                    title=""
                    >Activity Type</label
                  >
                </td>
                <td style="width: 100%">
                  <div class="o_input_dropdown">
                    <select
                      v-model="form.activity_type"
                      class="mt-1 block w-full"
                      :disabled="FormType == 'view'"
                    >
                      <option
                        v-for="row in activity_types"
                        :select="row.id == form.activity_type"
                        :key="row.id"
                        :value="row.id"
                      >
                        {{ row.name }}
                      </option>
                    </select>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <table class="o_group o_inner_group col-12 col-md-5">
            <tbody>
              <tr>
                <td class="o_td_label">
                  <label
                    class="o_form_label"
                    for="o_field_input_665"
                    data-original-title=""
                    title=""
                    >Due Date</label
                  >
                </td>
                <td style="width: 100%">
                  <div class="o_input_dropdown">
                    <jet-input
                      id="date"
                      type="date"
                      class="mt-1 block w-full"
                      v-model="form.due_date"
                      :disabled="FormType == 'view'"
                    />
                    <jet-input-error
                      :message="$page.errors.due_date"
                      class="mt-2"
                    />
                  </div>
                </td>
              </tr>
              <tr>
                <td class="o_td_label">
                  <label
                    class="o_form_label"
                    for="o_field_input_666"
                    data-original-title=""
                    title=""
                    >Responsible</label
                  >
                </td>
                <td style="width: 100%">
                  <select
                    v-model="form.user_id"
                    class="mt-1 block w-full"
                    :disabled="FormType == 'view'"
                  >
                    <option
                      :select="team.owner.id == form.user_id"
                      :value="team.owner.id"
                    >
                      {{ team.owner.name }}
                    </option>
                    <option
                      v-for="row in team.users"
                      :select="row.id == form.user_id"
                      :key="row.id"
                      :value="row.id"
                    >
                      {{ row.name }}
                    </option>
                  </select>
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
                  class="nav-link active"
                  role="tab"
                  >Description</a
                >
              </li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane active" id="notebook_page_team">
              <div class="col-12">
                <div v-if="FormType == 'view'" class="container mt-1">
                  <span v-html="form.note"></span>
                </div>
                <vue-editor
                  v-if="FormType == 'edit'"
                  v-model="form.note"
                ></vue-editor>
              </div>
            </div>
          </div>
        </div>
      </div>
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
import JetWorkspaceButton from "@/Jetstream/WorkspaceButton";
// List Component
import TableResponsive from "@/Jetstream/TableResponsive";
// form
import JetSuccessButton from "@/Jetstream/SuccessButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
// Module
import { VueEditor } from "vue2-editor";

export default {
  props: ["team", "users", "activity"],

  components: {
    JetDashboard,
    JetWrapperButton,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    TableResponsive,
    JetWorkspaceSubHeader,
    JetInput,
    JetInputError,
    JetLabel,
    JetSuccessButton,
    JetSecondaryButton,
    VueEditor,
    JetWorkspaceButton,
  },
  created() {
    console.log(this);
  },
  data() {
    let activity_type = [
      { id: "Email", name: "Email" },
      { id: "Call", name: "Call" },
      { id: "Todo", name: "Todo" },
      { id: "Meeting", name: "Meeting" },
      { id: "Upload Document", name: "Upload Document" },
      { id: "Reminder", name: "Reminder" },
      { id: "Exeption", name: "Exeption" },
    ];

    return {
      FormType: "view",
      activity_types: activity_type,
      ProjectToken: this.activity.project.access_token,
      form: this.$inertia.form(
        {
          id: this.activity.id,
          name: this.activity.name,
          activity_type: this.activity.activity_type,
          due_date: this.activity.due_date,
          user_id: this.activity.responsible.id,
          note: this.activity.note,
        },
        {
          bag: "UpdateActivity",
        }
      ),
    };
  },
  methods: {
    EditForms() {
      this.FormType = "edit";
    },
    UpdateForms() {
      this.form
        .post(route("activity.update"), {
          preserveScroll: true,
        })
        .then((response) => {
          if (Object.keys(this.$page.errors).length === 0) {
            this.Discard();
          }
        });
    },
    DestroyActivity() {
      this.form.delete(route("activity.destroy", this.activity), {
        preserveScroll: true,
      });
    },
    Discard() {
      this.$inertia.visit(route("activity.show", this.ProjectToken));
    },
  },
};
</script>
