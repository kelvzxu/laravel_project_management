<template>
  <app-layout>
    <app-content>
      <jumbotron :users="users">
        <template #main>
          <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
              <update-password-form class="mt-10 sm:mt-0" />
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
import JetSectionBorder from "@/Jetstream/SectionBorder";
import Jumbotron from "@/Jetstream/ProfileJumbotron";
import UpdatePasswordForm from "./UpdatePasswordForm";

export default {
  props: ["sessions", "users"],

  components: {
    AppContent,
    AppLayout,
    JetSectionBorder,
    Jumbotron,
    UpdatePasswordForm,
  },
};
</script>
