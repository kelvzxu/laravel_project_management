<template>
  <div class="content" id="content-body">
    <div
      class="flash-container flash-container-page sticky"
      data-qa-selector="flash_container"
    ></div>
    <div class="row kl-mt-3">
      <div class="col-lg-4 profile-settings-sidebar">
        <h4 class="kl-mt-0">Two-Factor Authentication</h4>
        <p>
          Increase your account's security by enabling Two-Factor Authentication
          (2FA)
        </p>
      </div>
      <div class="col-lg-8">
        <div v-if="!twoFactorEnabled">
          <p>Status: Disabled</p>
          <jet-confirms-password @confirmed="enableTwoFactorAuthentication">
            <jet-button
              type="button"
              :class="{ 'opacity-25': enabling }"
              :disabled="enabling"
            >
              Enable two-factor authentication
            </jet-button>
          </jet-confirms-password>
        </div>
        <div v-else>
          <p v-if="twoFactorEnabled">Status: Enabled</p>
          <div v-if="qrCode">
            <div class="mt-4 max-w-xl text-sm text-gray-600">
              <p class="font-semibold">
                Two factor authentication is now enabled. Scan the following QR
                code using your phone's authenticator application.
              </p>
            </div>

            <div class="mt-4" v-html="qrCode"></div>
          </div>

          <div v-if="recoveryCodes.length > 0">
            <div class="mt-4 max-w-xl text-sm text-gray-600">
              <p class="font-semibold">
                Store these recovery codes in a secure password manager. They
                can be used to recover access to your account if your two factor
                authentication device is lost.
              </p>
            </div>

            <div
              class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg"
            >
              <div v-for="code in recoveryCodes" :key="code">
                {{ code }}
              </div>
            </div>
          </div>
          <div class="mt-5">
            <jet-confirms-password @confirmed="regenerateRecoveryCodes">
              <jet-secondary-button
                class="mr-3"
                v-if="recoveryCodes.length > 0"
              >
                Regenerate Recovery Codes
              </jet-secondary-button>
            </jet-confirms-password>

            <jet-confirms-password @confirmed="showRecoveryCodes">
              <jet-secondary-button
                class="mr-3"
                v-if="recoveryCodes.length == 0"
              >
                Show Recovery Codes
              </jet-secondary-button>
            </jet-confirms-password>

            <jet-confirms-password @confirmed="disableTwoFactorAuthentication">
              <jet-danger-button
                :class="{ 'opacity-25': disabling }"
                :disabled="disabling"
              >
                Disable
              </jet-danger-button>
            </jet-confirms-password>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection";
import JetButton from "@/Jetstream/SuccessButton";
import JetConfirmsPassword from "@/Jetstream/ConfirmsPassword";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
  components: {
    JetActionSection,
    JetButton,
    JetConfirmsPassword,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      enabling: false,
      disabling: false,

      qrCode: null,
      recoveryCodes: [],
    };
  },

  methods: {
    enableTwoFactorAuthentication() {
      this.enabling = true;

      this.$inertia
        .post(
          "/user/two-factor-authentication",
          {},
          {
            preserveScroll: true,
          }
        )
        .then(() => {
          return Promise.all([this.showQrCode(), this.showRecoveryCodes()]);
        })
        .then(() => {
          this.enabling = false;
        });
    },

    showQrCode() {
      return axios.get("/user/two-factor-qr-code").then((response) => {
        this.qrCode = response.data.svg;
      });
    },

    showRecoveryCodes() {
      return axios.get("/user/two-factor-recovery-codes").then((response) => {
        this.recoveryCodes = response.data;
      });
    },

    regenerateRecoveryCodes() {
      axios.post("/user/two-factor-recovery-codes").then((response) => {
        this.showRecoveryCodes();
      });
    },

    disableTwoFactorAuthentication() {
      this.disabling = true;

      this.$inertia
        .delete("/user/two-factor-authentication", {
          preserveScroll: true,
        })
        .then(() => {
          this.disabling = false;
        });
    },
  },

  computed: {
    twoFactorEnabled() {
      return !this.enabling && this.$page.user.two_factor_enabled;
    },
  },
};
</script>
