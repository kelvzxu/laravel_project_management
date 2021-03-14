<template>
  <div id="create_stage">
    <jet-wrapper-button @click.native="AddTimesheet">
      Add Timesheet
    </jet-wrapper-button>
    <jet-dialog-modal :show="AddNewStage" @close="AddNewStage = false">
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
          <div class="col-span-6 sm:col-span-4 mt-1">
            <label class="form-check-label" for="task_id">Task </label>
            <select v-model="CreateTimesheet.task_id" class="mt-1 block w-full">
              <option
                v-for="row in project.task"
                :select="row.id == CreateTimesheet.task_id"
                :key="row.id"
                :value="row.id"
              >
                {{ row.name }}
              </option>
            </select>
            <jet-input-error :message="$page.errors.task_id" class="mt-2" />
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
      AddNewStage: false,
      CreateTimesheet: this.$inertia.form(
        {
          date: "",
          name: "",
          project_id: this.project.id,
          task_id: "",
          user_id: this.users.id,
          team_id: this.team.id,
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

      this.AddNewStage = true;

      setTimeout(() => {
        this.$refs.name.focus();
      }, 250);
    },
    CreateNewStages() {
      this.CreateTimesheet.post(route("timesheet.store"), {
        preserveScroll: true,
      }).then((response) => {
        if (Object.keys(this.$page.errors).length === 0) {
          this.AddNewStage = false;
        }
      });
    },
  },
};
</script>
