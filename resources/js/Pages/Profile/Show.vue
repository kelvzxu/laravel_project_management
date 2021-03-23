<template>
  <app-layout>
    <app-content>
      <jumbotron :users="users">
        <template #main>
          <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
              <update-profile-information-form :user="$page.user" />
            </div>
          </div>
        </template>
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
  props: ["sessions", "users"],

  components: {
    AppContent,
    AppLayout,
    Jumbotron,
    UpdateProfileInformationForm,
  },
};
</script>
