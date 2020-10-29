<template>
  <app-layout>
    <template #header>
      <h1>
        <v-breadcrumbs :items="items" large></v-breadcrumbs>
      </h1>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <welcome />
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";

export default {
  data: () => ({
    items: [
      {
        text: "Project",
        disabled: false,
        href: "/project",
      },
    ],
  }),
  components: {
    AppLayout,
    Welcome,
  },
};
</script>
