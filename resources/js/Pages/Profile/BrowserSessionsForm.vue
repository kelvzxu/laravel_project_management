<template>
  <section class="user_profile_bottom_container">
    <div class="user_inner_container text_left sessions_tab">
      <div>
        <div class="row">
          <div class="col-12 col-md-6">
            <span>{{ sessions.length }} session</span>
          </div>
          <div class="col-12 col-md-6">
            <span class="last-activity-text">Recent session </span
            ><span class="last-activity-value"
              >{{ sessions[0].last_active }}
            </span>
          </div>
        </div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th colspan="2">Device</th>
              <th>Location</th>
              <th>Last Usage</th>
            </tr>
          </thead>
          <tbody v-if="sessions.length > 0">
            <tr v-for="(session, i) in sessions" :key="i">
              <td>
                <div>
                  <svg
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    class="w-8 h-8 text-gray-500"
                    v-if="session.agent.is_desktop"
                  >
                    <path
                      d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                    ></path>
                  </svg>

                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="w-8 h-8 text-gray-500"
                    v-else
                  >
                    <path d="M0 0h24v24H0z" stroke="none"></path>
                    <rect x="7" y="4" width="10" height="16" rx="1"></rect>
                    <path d="M11 5h2M12 17v.01"></path>
                  </svg>
                </div>
              </td>
              <td>
                <div class="text-sm">
                  {{ session.agent.platform }} - {{ session.agent.browser }}
                </div>
              </td>
              <td>
                {{ session.ip_address }}
                <span
                  class="text-green-500 font-semibold"
                  v-if="session.is_current_device"
                  >This device</span
                >
              </td>
              <td>{{ session.last_active }}</td>
            </tr>
          </tbody>
        </table>
        <div class="flex items-center mt-5">
          <jet-button @click.native="confirmLogout">
            Logout Other Browser Sessions
          </jet-button>

          <jet-action-message :on="form.recentlySuccessful" class="ml-3">
            Done.
          </jet-action-message>
        </div>
        <!-- Logout Other Devices Confirmation Modal -->
        <jet-dialog-modal
          :show="confirmingLogout"
          @close="confirmingLogout = false"
        >
          <template #title> Logout Other Browser Sessions </template>

          <template #content>
            Please enter your password to confirm you would like to logout of
            your other browser sessions across all of your devices.

            <div class="mt-4">
              <jet-input
                type="password"
                class="mt-1 block w-3/4"
                placeholder="Password"
                ref="password"
                v-model="form.password"
                @keyup.enter.native="logoutOtherBrowserSessions"
              />

              <jet-input-error :message="form.error('password')" class="mt-2" />
            </div>
          </template>

          <template #footer>
            <jet-secondary-button @click.native="confirmingLogout = false">
              Nevermind
            </jet-secondary-button>

            <jet-button
              class="ml-2"
              @click.native="logoutOtherBrowserSessions"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Logout Other Browser Sessions
            </jet-button>
          </template>
        </jet-dialog-modal>
      </div>
    </div>
  </section>
</template>

<script>
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetActionSection from "@/Jetstream/ActionSection";
import JetButton from "@/Jetstream/SuccessButton";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
  props: ["sessions"],

  components: {
    JetActionMessage,
    JetActionSection,
    JetButton,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingLogout: false,
      form: this.$inertia.form(
        {
          _method: "DELETE",
          password: "",
        },
        {
          bag: "logoutOtherBrowserSessions",
        }
      ),
    };
  },

  methods: {
    confirmLogout() {
      this.form.password = "";

      this.confirmingLogout = true;

      setTimeout(() => {
        this.$refs.password.focus();
      }, 250);
    },

    logoutOtherBrowserSessions() {
      this.form
        .post(route("other-browser-sessions.destroy"), {
          preserveScroll: true,
        })
        .then((response) => {
          if (!this.form.hasErrors()) {
            this.confirmingLogout = false;
          }
        });
    },
  },
};
</script>
