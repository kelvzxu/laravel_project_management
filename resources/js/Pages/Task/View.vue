<template>
  <app-layout>
    <jet-application-control :users="users">
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
            @click.native="EditForms"
          >
            <i class="far fa-save main-icon"></i>Save Change
          </jet-workspace-button>
          <jet-workspace-button>
            <i class="far fa-trash-alt main-icon"></i>Delete Task
          </jet-workspace-button>
          <jet-workspace-button @click.native="BackMethods">
            <i class="fas fa-undo-alt main-icon"></i>Back
          </jet-workspace-button>
        </div>
      </template>
      <template #main_content>
        <jet-content-wrapper
          :users="users"
          :team="task.team"
          class="project_view"
        >
          <template #board_name>{{ task.name }}</template>
          <template #board_description>Date Assign :{{ task.assign }}</template>
          <template #board_subs_images_label>Responsible </template>
          <template #board_subs_images>
            <img
              :src="task.responsible.profile_photo_url"
              class="inner-image"
            />
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
            <div class="container">
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
                    v-model="task.name"
                  />
                </h1>
                vue2-editor
              </div>
            </div>
            </div>
          </template>
        </jet-content-wrapper>
      </template>
    </jet-application-control>
  </app-layout>
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import JetApplicationControl from "@/Jetstream/ApplicationControl";
import AppLayout from "@/Layouts/AppLayout";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSuccessButton from "@/Jetstream/SuccessButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
// Workspace Component
import JetContentWrapper from "@/Jetstream/ContentWrapper";
import JetBoardButton from "@/Jetstream/BoardButton";
import JetBoardFilterDropdown from "@/Jetstream/BoardFilterDropdown";
import JetWorkspaceButton from "@/Jetstream/WorkspaceButton";

export default {
  props: ["task", "users"],

  components: {
    AppLayout,
    JetContentWrapper,
    JetApplicationControl,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetLabel,
    JetResponsiveNavLink,
    JetSuccessButton,
    JetSecondaryButton,
    JetBoardButton,
    JetBoardFilterDropdown,
    JetWorkspaceButton,
  },
  data() {
    return {
      FormType: "view",
      TaskUpdate: this.$inertia.form({
        id: "",
        stage_id: "",
      }),
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
  },
};
</script>
