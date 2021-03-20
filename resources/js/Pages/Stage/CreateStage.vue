<template>
  <div id="create_stage">
    <jet-wrapper-button @click.native="AddStage">
      Add Stage
    </jet-wrapper-button>
    <jet-dialog-modal :show="AddNewStage" @close="AddNewStage = false">
      <template #title> New Stage </template>

      <template #content>
        <div class="mt-4">
          <div class="col-span-6 sm:col-span-4">
            <jet-label for="name" value="Stage Name" />
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
            <jet-label for="sequence" value="Stage sequence" />
            <jet-input
              id="sequence"
              type="text"
              ref="sequence"
              required
              class="mt-1 block w-full"
              v-model="form.sequence"
            />
            <jet-input-error :message="form.error('name')" class="mt-2" />
          </div>
          <div class="col-span-6 sm:col-span-4 mt-1">
            <label class="form-check-label" for="is_closed"
              >Closing State
            </label>
            <input
              class="form-check-input ml-3"
              type="checkbox"
              v-model="form.is_closed"
              name="is_closed"
              id="is_closed"
            />
            <jet-input-error :message="form.error('is_closed')" class="mt-2" />
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
      form: this.$inertia.form(
        {
          name: "",
          active: true,
          project_id: this.project.id,
          is_closed: false,
          create_uid: this.users.id,
          write_uid: this.users.id,
          sequence: "",
        },
        {
          bag: "CreateStage",
        }
      ),
    };
  },
  methods: {
    AddStage() {
      this.form.name = "";

      this.AddNewStage = true;

      setTimeout(() => {
        this.$refs.name.focus();
      }, 250);
    },
    CreateNewStages() {
      this.form
        .post(route("stage.store"), {
          preserveScroll: true,
        })
        .then((response) => {
          this.form.access_token = Math.random().toString(36).substring(7);
          if (!this.form.hasErrors()) {
            this.AddNewStage = false;
          }
        });
    },
  },
};
</script>
