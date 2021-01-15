<template>
  <app-layout>
    <app-content>
      <jumbotron>
        <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profile
          </h2>
        </template>

        <div>
          <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- <update-photo-profile :user="$page.user" /> -->
            <update-profile-information-form :user="$page.user" />
          </div>
        </div>
      </jumbotron>
    </app-content>
  </app-layout>
</template>

<script>
import AppContent from "@/Jetstream/ApplicationContent";
import AppLayout from "@/Layouts/AppLayout";
import Jumbotron from "@/Jetstream/ProfileJumbotron";
import UpdateProfileInformationForm from "./UpdateProfileInformationForm";

export default {
  props: ["sessions"],

  components: {
    AppContent,
    AppLayout,
    Jumbotron,
    UpdateProfileInformationForm,
  },
};
</script>
