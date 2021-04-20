<template>
  <div id="create_tags">
    <jet-wrapper-button @click.native="AddTags"> Add Tags </jet-wrapper-button>
    <jet-dialog-modal :show="AddNewTags" @close="AddNewTags = false">
      <template #title> New Tags </template>

      <template #content>
        <div class="mt-4">
          <div class="col-span-6 sm:col-span-4">
            <jet-label for="name" value="Tags Name" />
            <jet-input
              id="name"
              type="text"
              ref="name"
              class="mt-1 block w-full"
              required
              v-model="form.name"
            />
            <jet-input-error :message="$page.errors.name" class="mt-2" />
          </div>
          <div class="col-span-6 sm:col-span-4 mt-1">
            <label class="form-check-label" for="color">Color </label>
            <input type="color" v-model="form.color" name="color" id="color" />
            <jet-input-error :message="$page.errors.color" class="mt-2" />
          </div>
        </div>
      </template>

      <template #footer>
        <jet-success-button
          class="ml-2"
          @click.native="CreateNewTags"
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
      AddNewTags: false,
      form: this.$inertia.form(
        {
          name: "",
          color: "#ffffff",
          project_id: this.project.id,
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
    AddTags() {
      this.form.name = "";

      this.AddNewTags = true;

      setTimeout(() => {
        this.$refs.name.focus();
      }, 250);
    },
    CreateNewTags() {
      this.form
        .post(route("tags.store"), {
          preserveScroll: true,
        })
        .then((response) => {
          if (Object.keys(this.$page.errors).length === 0) {
            this.AddNewTags = false;
          }
        });
    },
  },
};
</script>
