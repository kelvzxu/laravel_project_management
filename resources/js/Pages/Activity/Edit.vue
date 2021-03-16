<template>
  <jet-dashboard>
    <template #workspace_icon>{{ activity.name[0] }}</template>
    <template #workspace_name>{{ activity.name }}</template>
    <template #workspace_sub_header>
      <jet-workspace-sub-header :project="project" />
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
                    />
                    <jet-input-error :message="$page.errors.name" class="mt-2" />
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
                     <select v-model="form.activity_type" class="mt-1 block w-full">
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
                    />
                    <jet-input-error :message="$page.errors.due_date" class="mt-2" />
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
                  <select v-model="form.user_id" class="mt-1 block w-full">
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
            <div
              class="tab-pane active"
              id="notebook_page_team"
            >
              <div class="col-12">
                <vue-editor
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
      activity_types: activity_type,
      FilterDropdown: false,
      form: this.$inertia.form(
        {
          id: this.activity.id,
          name: this.activity.name,
          activity_type: this.activity.activity_type,
          due_date: this.activity.due_date,
          user_id: this.activity.responsible.id,
          note:this.activity.note,
        },
        {
          bag: "UpdateActivity",
        }
      ),
    };
  },
  methods: {
    StoreActivity(){
      this.form
        .post(route("activity.store"), {
          preserveScroll: true,
        })
        .then((response) => {
          if (Object.keys(this.$page.errors).length === 0) {
            this.$inertia
              .get(route("activity.show",this.project.access_token), {
                preserveScroll: true,
              });
          }
        });
    },
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
    DestroyActivity(stage) {
      this.form.delete(route("Activity.destroy", stage), {
        preserveScroll: true,
      });
    },
    editActivity(stage) {
      this.UpdateForm = stage;
    },
    UpdateActivity() {
      this.$inertia
        .post(route("Activity.update"), {
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
