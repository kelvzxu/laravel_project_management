<template>
  <app-layout>
    <app-content>
      <jumbotron>
        <template #followers>
          <i class="fa fa-users" aria-hidden="true"></i>
          <inertia-link class="text-link" href="/users/kelvzxu/followers"
            >{{ users.original.result.followers.length }} followers
          </inertia-link></template
        >
        <template #following>
          <i class="fa fa-users" aria-hidden="true"></i>
          <inertia-link class="text-link" href="/users/kelvzxu/followers"
            >{{ users.original.result.following.length }} following
          </inertia-link></template
        >
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
