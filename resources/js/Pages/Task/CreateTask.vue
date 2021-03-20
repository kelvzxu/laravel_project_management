<template>
  <div id="add_task">
    <jet-wrapper-button @click.native="AddTask"> Add Task </jet-wrapper-button>
    <jet-dialog-modal :show="AddNewTask" @close="AddNewTask = false">
      <template #title> New Task </template>

      <template #content>
        <div class="mt-4">
          <div class="col-span-6 sm:col-span-4">
            <jet-label for="name" value="Task Name" />
            <jet-input
              id="name"
              type="text"
              ref="name"
              class="mt-1 block w-full"
              required
              v-model="form.name"
            />
            <jet-input-error :message="form.error('name')" class="mt-2" />
          </div>
          <div class="col-span-6 sm:col-span-4 mt-2">
            <jet-label for="stage_id" value="Stage" />
            <select v-model="form.stage_id" class="mt-1 block w-full">
              <option
                v-for="row in project.task_type"
                :select="row.id == form.stage_id"
                :key="row.id"
                :value="row.id"
              >
                {{ row.name }}
              </option>
            </select>
            <jet-input-error :message="form.error('stage_id')" class="mt-2" />
          </div>
          <div class="col-span-6 sm:col-span-4 mt-2">
            <jet-label for="user_id" value="Responsibility" />
            <select v-model="form.user_id" class="mt-1 block w-full">
              <option
                v-for="row in project.participants"
                :select="row.user_id == form.user_id"
                :key="row.user_id"
                :value="row.user_id"
              >
                {{ row.user.name }}
              </option>
            </select>
            <jet-input-error :message="form.error('user_id')" class="mt-2" />
          </div>
        </div>
      </template>

      <template #footer>
        <jet-success-button
          class="ml-2"
          @click.native="CreateNewStages"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
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
  props: ["users", "project", "team"],

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
      AddNewTask: false,
      form: this.$inertia.form(
        {
          name: "",
          active: true,
          project_id: this.project.id,
          team_id: this.project.team_id,
          create_uid: this.users.id,
          write_uid: this.users.id,
          stage_id: this.project.task_type[0].id,
          user_id: this.users.id,
        },
        {
          bag: "CreateTask",
        }
      ),
    };
  },
  methods: {
    AddTask() {
      this.form.name = "";

      this.AddNewTask = true;

      setTimeout(() => {
        this.$refs.name.focus();
      }, 250);
    },
    CreateNewStages() {
      this.form
        .post(route("project_task.store"), {
          preserveScroll: true,
        })
        .then((response) => {
          this.form.access_token = Math.random().toString(36).substring(7);
          if (!this.form.hasErrors()) {
            this.AddNewTask = false;
          }
        });
    },
  },
};
</script>