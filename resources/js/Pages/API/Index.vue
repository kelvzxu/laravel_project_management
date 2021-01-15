<template>
  <app-layout>
    <app-content>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          API Tokens
        </h2>
      </template>

      <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
          <api-token-manager
            :tokens="tokens"
            :available-permissions="availablePermissions"
            :default-permissions="defaultPermissions"
          />
        </div>
      </div>
    </app-content>
  </app-layout>
</template>

<script>
import AppContent from "@/Jetstream/ApplicationContent";
import ApiTokenManager from "./ApiTokenManager";
import AppLayout from "@/Layouts/AppLayout";
import JetSectionBorder from "@/Jetstream/SectionBorder";

export default {
  props: ["tokens", "availablePermissions", "defaultPermissions"],

  components: {
    AppContent,
    ApiTokenManager,
    AppLayout,
    JetSectionBorder,
  },
};
</script>
