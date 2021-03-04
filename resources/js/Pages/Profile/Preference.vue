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
          <inertia-link
            :href="route('profile.following', $page.user.email)"
            :active="route().current('profile.following')"
            >Following</inertia-link
          ></template
        >
        <template #main>
          <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
              <div v-if="$page.jetstream.canManageTwoFactorAuthentication">
                <two-factor-authentication-form class="mt-10 sm:mt-0" />
              </div>

              <jet-section-border />

              <delete-user-form class="mt-10 sm:mt-0" />
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
import DeleteUserForm from "./DeleteUserForm";
import JetSectionBorder from "@/Jetstream/SectionBorder";
import Jumbotron from "@/Jetstream/ProfileJumbotron";
import TwoFactorAuthenticationForm from "./TwoFactorAuthenticationForm";
import UpdatePasswordForm from "./UpdatePasswordForm";
import UpdateProfileInformationForm from "./UpdateProfileInformationForm";

export default {
  props: ["sessions", "users"],

  components: {
    AppContent,
    AppLayout,
    DeleteUserForm,
    JetSectionBorder,
    Jumbotron,
    TwoFactorAuthenticationForm,
    UpdatePasswordForm,
    UpdateProfileInformationForm,
  },
};
</script>
