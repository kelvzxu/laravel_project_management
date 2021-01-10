<template>
  <app-layout>
    <app-content>
      <jumbotron>
        <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sessions
          </h2>
        </template>

        <div>
          <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0" />
          </div>
        </div>
      </jumbotron>
    </app-content>
  </app-layout>
</template>

<script>
import AppContent from "@/Jetstream/ApplicationContent";
import AppLayout from "@/Layouts/AppLayout";
import DeleteUserForm from "./DeleteUserForm";
import JetSectionBorder from "@/Jetstream/SectionBorder";
import Jumbotron from "@/Jetstream/ProfileJumbotron";
import BrowserSessionsForm from "./BrowserSessionsForm";
import TwoFactorAuthenticationForm from "./TwoFactorAuthenticationForm";
import UpdatePasswordForm from "./UpdatePasswordForm";
import UpdatePhotoProfile from "./UpdatePhotoProfile";
import UpdateProfileInformationForm from "./UpdateProfileInformationForm";

export default {
  props: ["sessions"],

  components: {
    AppContent,
    AppLayout,
    BrowserSessionsForm,
    DeleteUserForm,
    JetSectionBorder,
    Jumbotron,
    TwoFactorAuthenticationForm,
    UpdatePasswordForm,
    UpdatePhotoProfile,
    UpdateProfileInformationForm,
  },
};
</script>
