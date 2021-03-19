<template>
  <div id="create_tags">
    <jet-wrapper-button @click.native="AddUser"> Add Participants </jet-wrapper-button>
    <jet-dialog-modal :show="AddNewUser" @close="AddNewUser = false">
      <template #title> Add Participants </template>

      <template #content>
        <div class="mt-4">
          <div class="col-span-6 sm:col-span-4">
            <jet-label for="name" value="Tags Name" />
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
            <jet-input-error :message="$page.errors.name" class="mt-2" />
          </div>
        </div>
      </template>

      <template #footer>
        <jet-success-button
          class="ml-2"
          @click.native="StoreParticipants"
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
      AddNewUser: false,
      form: this.$inertia.form(
        {
          user_id : "",
          team_id: this.team.id,
        },
        {
          bag: "CreateStage",
        }
      ),
    };
  },
  methods: {
    AddUser() {
      this.form.name = "";

      this.AddNewUser = true;

      setTimeout(() => {
        this.$refs.name.focus();
      }, 250);
    },
    StoreParticipants() {
      this.form
        .post(route("project.newuser",this.project.id), {
          preserveScroll: true,
        })
        .then((response) => {
          if (Object.keys(this.$page.errors).length === 0) {
            this.AddNewUser = false;
          }
        });
    },
  },
};
</script>
