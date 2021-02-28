<template>
  <jet-form @submitted="updatePassword">
    <template #form>
      <div class="content" id="content-body">
        <div
          class="flash-container flash-container-page sticky"
          data-qa-selector="flash_container"
        ></div>

        <div class="row kl-mt-3">
          <div class="col-lg-4 profile-settings-sidebar">
            <h4 class="kl-mt-0">Password</h4>
            <p>
              After a successful password update, you will be redirected to the
              login page where you can log in with your new password.
            </p>
          </div>
          <div class="col-lg-8">
            <h5 class="kl-mt-0 font-weight-bold">
              Change your password or recover your current one
            </h5>
            <div class="form-group">
              <jet-label
                class="font-weight-bold"
                for="current_password"
                value="Current Password"
              />
              <jet-input
                id="current_password"
                type="password"
                class="form-control"
                v-model="form.current_password"
                ref="current_password"
                autocomplete="current-password"
              />
              <jet-input-error
                :message="form.error('current_password')"
                class="mt-2"
              />
              <p class="form-text text-muted">
                You must provide your current password in order to change it.
              </p>
            </div>
            <div class="form-group">
              <jet-label
                class="font-weight-bold"
                for="password"
                value="New Password"
              />
              <jet-input
                id="password"
                type="password"
                class="form-control"
                v-model="form.password"
                autocomplete="new-password"
              />
              <jet-input-error :message="form.error('password')" class="mt-2" />
            </div>
            <div class="form-group">
              <jet-label
                class="font-weight-bold"
                for="password_confirmation"
                value="Confirm Password"
              />
              <jet-input
                id="password_confirmation"
                type="password"
                class="form-control"
                v-model="form.password_confirmation"
                autocomplete="new-password"
              />
              <jet-input-error
                :message="form.error('password_confirmation')"
                class="mt-2"
              />
            </div>
          </div>
        </div>
      </div>
    </template>

    <template #actions>
      <jet-action-message :on="form.recentlySuccessful" class="mr-3">
        Saved Successful.
      </jet-action-message>

      <jet-button
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Save password
      </jet-button>
    </template>
  </jet-form>
</template>

<script>
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/SuccessButton";
import JetForm from "@/Jetstream/Form";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

export default {
  components: {
    JetActionMessage,
    JetButton,
    JetForm,
    JetInput,
    JetInputError,
    JetLabel,
  },

  data() {
    return {
      form: this.$inertia.form(
        {
          current_password: "",
          password: "",
          password_confirmation: "",
        },
        {
          bag: "updatePassword",
        }
      ),
    };
  },

  methods: {
    updatePassword() {
      this.form
        .put(route("user-password.update"), {
          preserveScroll: true,
        })
        .then(() => {
          this.$refs.current_password.focus();
        });
    },
  },
};
</script>
