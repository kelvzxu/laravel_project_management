<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 profile-settings-sidebar">
        <h4 class="gl-mt-0">Public Avatar</h4>
        <p class="photo-profile-description">
          You can change your avatar here or remove the current avatar to revert
          to <a href="https://gravatar.com">gravatar.com</a>
        </p>
      </div>
      <div class="col-lg-6">
        <!-- Current Profile Photo -->
        <div class="mt-2 clearfix avatar-image gl-mb-3" v-show="!photoPreview">
          <a
            target="_blank"
            rel="noopener noreferrer"
            :href="user.profile_photo_url"
            ><img
              :src="user.profile_photo_url"
              alt="Current Profile Photo"
              class="avatar s130 js-lazy-loaded qa-js-lazy-loaded"
              loading="lazy"
            />
          </a>
        </div>

        <!-- New Profile Photo Preview -->
        <div class="mt-2 clearfix avatar-image gl-mb-3" v-show="photoPreview">
          <span
            class="avatar s130 js-lazy-loaded qa-js-lazy-loaded"
            :style="
              'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
              photoPreview +
              '\');'
            "
          >
          </span>
        </div>
        <h5 class="gl-mt-0">Upload new avatar</h5>
        <div class="gl-mt-2 gl-mb-3">
          <input
            type="file"
            class="hidden"
            ref="photo"
            @change="updatePhotoPreview"
          />
          <jet-secondary-button
            class="mt-2 mr-2"
            type="button"
            @click.native.prevent="selectNewPhoto"
          >
            Select A New Photo
          </jet-secondary-button>
        </div>
        <div class="form-text text-muted">
          The maximum file size allowed is 200KB.
        </div>
        <hr class="margin-180" />
        <jet-danger-button
          type="button"
          class="mt-2"
          @click.native.prevent="deletePhoto"
          v-if="user.profile_photo_path"
        >
          Remove avatar
        </jet-danger-button>
      </div>
    </div>
    <hr />
  </div>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetDangerButton from "@/Jetstream/DangerButton";

export default {
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    JetDangerButton,
  },

  props: ["user"],

  data() {
    return {
      form: this.$inertia.form(
        {
          _method: "PUT",
          name: this.user.name,
          email: this.user.email,
          photo: null,
        },
        {
          bag: "updateProfileInformation",
          resetOnSuccess: false,
        }
      ),

      photoPreview: null,
    };
  },

  methods: {
    updateProfileInformation() {
      if (this.$refs.photo) {
        this.form.photo = this.$refs.photo.files[0];
      }

      this.form.post(route("user-profile-information.update"), {
        preserveScroll: true,
      });
    },

    selectNewPhoto() {
      console.log("+++++");
      this.$refs.photo.click();
    },

    updatePhotoPreview() {
      const reader = new FileReader();

      reader.onload = (e) => {
        this.photoPreview = e.target.result;
      };

      reader.readAsDataURL(this.$refs.photo.files[0]);
    },

    deletePhoto() {
      this.$inertia
        .delete(route("current-user-photo.destroy"), {
          preserveScroll: true,
        })
        .then(() => {
          this.photoPreview = null;
        });
    },
  },
};
</script>

