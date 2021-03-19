<template>
  <div id="create_projects">
    <jet-wrapper-button @click.native="AddProjects">
      New Projects
    </jet-wrapper-button>
    <jet-dialog-modal :show="AddProjectModal" @close="AddProjectModal = false">
      <template #title> CreateProject </template>

      <template #content>
        <div class="mt-4">
          <div class="col-span-6 sm:col-span-4">
            <jet-label for="name" value="Project Name" />
            <jet-input
              id="name"
              type="text"
              ref="name"
              class="mt-1 block w-full"
              v-model="CreateProject.name"
            />
            <jet-input-error
              :message="CreateProject.error('email')"
              class="mt-2"
            />
          </div>
          <div class="col-span-6 sm:col-span-4">
            <label class="form-check-label" for="allow_timesheets"
              >Allow Timesheets
            </label>
            <input
              class="form-check-input ml-3"
              type="checkbox"
              v-model="CreateProject.allow_timesheets"
              name="private_profile"
              id="user_private_profile"
            />
            <jet-input-error
              :message="CreateProject.error('email')"
              class="mt-2"
            />
          </div>
        </div>
      </template>

      <template #footer>
        <jet-success-button
          class="ml-2"
          @click.native="CreateNewProjects"
          :class="{ 'opacity-25': CreateProject.processing }"
          :disabled="CreateProject.processing"
        >
          Create
        </jet-success-button>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import JetWrapperButton from "@/Jetstream/WrapperButton";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSuccessButton from "@/Jetstream/SuccessButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

export default {
  props: ["team", "users", "project"],

  components: {
    JetWrapperButton,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetLabel,
    JetSuccessButton,
    JetSecondaryButton,
  },
  data() {
    return {
      AddNewProjects: false,
      AddProjectModal: false,
      CreateProject: this.$inertia.form(
        {
          name: "",
          allow_timesheets: true,
          sequence: Math.floor(Math.random() * 1000) + 1,
          user_id: this.users.id,
          team_id: this.team.id,
          create_uid: this.users.id,
          write_uid: this.users.id,
          label_tasks: "Tasks",
          visibility: "team",
        },
        {
          bag: "InviteUserModal",
          resetOnSuccess: true,
        }
      ),
    };
  },
  methods: {
    AddProjects() {
      this.CreateProject.name = "";

      this.AddProjectModal = true;

      setTimeout(() => {
        this.$refs.name.focus();
      }, 250);
    },
    CreateNewProjects() {
      this.CreateProject.post(route("project.store"), {
        preserveScroll: true,
      }).then((response) => {
        this.sequence = Math.floor(Math.random() * 1000) + 1;
        if (!this.CreateProject.hasErrors()) {
          this.AddProjectModal = false;
        }
      });
    },
  },
};
</script>
