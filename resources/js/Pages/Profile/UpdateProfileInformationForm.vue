<template>
  <jet-form @submitted="updateProfileInformation">
    <template #form>
      <div class="container">
        <div class="row">
          <div class="col-lg-4 profile-settings-sidebar">
            <h4 class="kl-mt-0">Public Avatar</h4>
            <p class="photo-profile-description">
              You can change your avatar here or remove the current avatar to
              revert to <a href="https://gravatar.com">gravatar.com</a>
            </p>
          </div>
          <div class="col-lg-6">
            <!-- Current Profile Photo -->
            <div
              class="mt-2 clearfix avatar-image kl-mb-3"
              v-show="!photoPreview"
            >
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
            <div
              class="mt-2 clearfix avatar-image kl-mb-3"
              v-show="photoPreview"
            >
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
            <h5 class="kl-mt-0">Upload new avatar</h5>
            <div class="kl-mt-2 kl-mb-3">
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
        <div class="row mt-3">
          <div class="col-lg-4 profile-settings-sidebar">
            <h4 class="kl-mt-0">Main settings</h4>
            <p>This information will appear on your profile</p>
          </div>
          <div class="col-lg-8">
            <div class="row">
              <div class="form-group col-md-9">
                <jet-label for="name" value="Full Name" />
                <jet-input
                  id="name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.name"
                  autocomplete="name"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Using emojis in names seems fun, but please try to set a status message instead"
                />
                <jet-input-error :message="form.error('name')" class="mt-2" />
                <small class="form-text text-muted"
                  >Enter your name, so people you know can recognize you</small
                >
              </div>

              <div class="form-group col-md-3">
                <jet-label for="user_id" value="User ID" />
                <jet-input
                  readonly="readonly"
                  id="user_id"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.id"
                />
                <jet-input-error :message="form.error('id')" class="mt-2" />
              </div>
            </div>
            <div class="form-group">
              <jet-label for="email" value="Email" />
              <jet-input
                readonly="readonly"
                id="email"
                type="text"
                class="mt-1 block w-full"
                v-model="form.email"
              />
              <jet-input-error :message="form.error('email')" class="mt-2" />
              <small class="form-text text-muted"
                >We also use email for avatar detection if no avatar is
                uploaded</small
              >
            </div>
            <div class="form-group">
              <label class="required" for="user_public_email"
                >Public email</label
              >
              <select class="custom-select">
                <option selected>Do not show on profile</option>
                <option value="ceokelvin12@gmail.com">
                  ceokelvin12@gmail.com
                </option></select
              ><small class="form-text text-muted"
                >This email will be displayed on your public profile</small
              >
            </div>

            <div class="form-group">
              <jet-label for="skype" value="Skype" />
              <jet-input
                id="skype"
                placeholder="Skype"
                type="text"
                class="mt-1 block w-full"
                v-model="form.skype"
              />
            </div>
            <div class="form-group">
              <jet-label for="linkedin" value="Linkedin" />
              <jet-input
                id="linkedin"
                placeholder="Linkedin"
                type="text"
                class="mt-1 block w-full"
                v-model="form.linkedin"
              />
              <small class="form-text text-muted"
                >Your LinkedIn profile name from
                linkedin.com/in/profilename</small
              >
            </div>
            <div class="form-group">
              <jet-label for="twitter" value="Twitter" />
              <jet-input
                id="twitter"
                placeholder="Twitter"
                type="text"
                class="mt-1 block w-full"
                v-model="form.twitter"
              />
            </div>
            <div class="form-group">
              <jet-label for="website_url" value="website_url" />
              <jet-input
                id="website_url"
                placeholder="website.com"
                type="text"
                class="mt-1 block w-full"
                v-model="form.website_url"
              />
            </div>
            <div class="form-group">
              <jet-label for="location" value="Location" />
              <jet-input
                id="location"
                placeholder="City, country"
                type="text"
                class="mt-1 block w-full"
                v-model="form.location"
              />
            </div>
            <div class="form-group">
              <jet-label for="job_title" value="job_title" />
              <jet-input
                id="job_title"
                type="text"
                class="mt-1 block w-full"
                v-model="form.job_title"
              />
            </div>
            <div class="form-group">
              <jet-label for="organization" value="organization" />
              <jet-input
                id="organization"
                type="text"
                class="mt-1 block w-full"
                v-model="form.organization"
              />
              <small class="form-text text-muted"
                >Who you represent or work for</small
              >
            </div>
            <div class="form-group">
              <jet-label for="bio" value="bio" />
              <textarea
                rows="4"
                maxlength="250"
                class="form-control"
                v-model="form.bio"
                name="bio"
                id="bio"
              ></textarea
              ><small class="form-text text-muted"
                >Tell us about yourself in fewer than 250 characters</small
              >
            </div>
            <hr />
            <h5 class="font-weight-bold">Private profile</h5>
            <div class="checkbox-icon-inline-wrapper">
              <div class="form-check form-check-inline mr-0">
                <input name="private_profile" type="hidden" value="0" /><input
                  class="form-check-input"
                  type="checkbox"
                  v-model="form.private_profile"
                  name="private_profile"
                  id="user_private_profile"
                /><label class="form-check-label" for="user_private_profile"
                  >Don't display activity-related personal information on your
                  profiles
                </label>
              </div>
              <a href="/help/user/profile/index.md#private-profile"
                ><i class="far fa-question-circle"></i
              ></a>
            </div>
            <h5 class="font-weight-bold">Private contributions</h5>
            <div class="form-check form-check-inline mb-2">
              <input
                class="form-check-input"
                type="checkbox"
                v-model="form.include_private_contributions"
                name="include_private_contributions"
                id="include_private_contributions"
              /><label
                class="form-check-label"
                for="include_private_contributions"
                >Include private contributions on my profile</label
              >
            </div>
            <small class="form-text text-muted">
              Choose to show contributions of private projects on your public
              profile without any project, repository or organization
              information
            </small>
          </div>
        </div>
      </div>
    </template>

    <template #actions>
      <jet-action-message :on="form.recentlySuccessful" class="mr-3">
        Saved.
      </jet-action-message>
      <jet-success-button
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        style="float: right"
      >
        Update profile settings
      </jet-success-button>
    </template>
  </jet-form>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetForm from "@/Jetstream/Form";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetSuccessButton from "@/Jetstream/SuccessButton";
import JetDangerButton from "@/Jetstream/DangerButton";

export default {
  components: {
    JetActionMessage,
    JetButton,
    JetForm,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    JetSuccessButton,
    JetDangerButton,
  },

  props: ["user"],

  data() {
    return {
      form: this.$inertia.form(
        {
          _method: "PUT",
          id: this.user.id,
          name: this.user.name,
          email: this.user.email,
          show_public_email: this.user.show_public_email,
          skype: this.user.skype,
          linkedin: this.user.linkedin,
          twitter: this.user.twitter,
          website_url: this.user.website_url,
          location: this.user.location,
          job_title: this.user.job_title,
          organization: this.user.organization,
          bio: this.user.bio,
          private_profile: this.user.private_profile,
          include_private_contributions: this.user
            .include_private_contributions,
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
