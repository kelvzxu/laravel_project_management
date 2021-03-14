<template>
  <div id="create_stage">
    <jet-wrapper-button @click.native="AddTimesheet">
      Add Timesheet
    </jet-wrapper-button>
    <jet-dialog-modal :show="AddNewTimesheet" @close="AddNewTimesheet = false">
      <template #title> Timesheet </template>

      <template #content>
        <div class="mt-4">
          <div class="col-span-6 sm:col-span-4">
            <jet-label for="date" value="Date" />
            <jet-input
              id="date"
              type="date"
              ref="date"
              class="mt-1 block w-full"
              v-model="CreateTimesheet.date"
            />
            <jet-input-error :message="$page.errors.date" class="mt-2" />
          </div>
          <div class="col-span-6 sm:col-span-4 mt-2">
            <jet-label for="name" value="Description" />
            <jet-input
              id="name"
              type="text"
              ref="name"
              required
              class="mt-1 block w-full"
              v-model="CreateTimesheet.name"
            />
            <jet-input-error :message="$page.errors.name" class="mt-2" />
          </div>
        </div>
        <div class="col-span-6 sm:col-span-4 mt-2">
          <jet-label for="duration" value="Duration" />
          <label class="form-check-label">Hours </label>
          <jet-input
            id="duration"
            type="number"
            ref="duration"
            required
            class="mt-1"
            max="23"
            min="0"
            v-model="CreateTimesheet.hours"
          />
          <label class="form-check-label">Minutes </label>
          <jet-input
            id="duration"
            type="number"
            ref="duration"
            required
            class="mt-1"
            min="0"
            max="59"
            v-model="CreateTimesheet.minutes"
          />
          <jet-input-error :message="$page.errors.hours" class="mt-2" />
          <jet-input-error :message="$page.errors.minutes" class="mt-2" />
        </div>
      </template>

      <template #footer>
        <jet-success-button
          class="ml-2"
          @click.native="CreateNewStages"
          :class="{ 'opacity-25': CreateTimesheet.processing }"
          :disabled="CreateTimesheet.processing"
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
  props: ["task", "users"],

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
      AddNewTimesheet: false,
      CreateTimesheet: this.$inertia.form(
        {
          date: "",
          name: "",
          project_id: this.task.project.id,
          task_id: this.task.id,
          user_id: this.users.id,
          team_id: this.task.team.id,
          create_uid: this.users.id,
          write_uid: this.users.id,
          hours: 0,
          minutes: 0,
        },
        {
          bag: "CreateTimesheet",
          resetOnSuccess: true,
        }
      ),
    };
  },
  methods: {
    AddTimesheet() {
      this.CreateTimesheet.name = "";

      this.AddNewTimesheet = true;

      setTimeout(() => {
        this.$refs.name.focus();
      }, 250);
    },
    CreateNewStages() {
      this.CreateTimesheet.post(route("timesheet.store"), {
        preserveScroll: true,
      }).then((response) => {
        if (Object.keys(this.$page.errors).length === 0) {
          this.AddNewTimesheet = false;
        }
      });
    },
  },
};
</script>
