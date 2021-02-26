<template>
  <app-layout>
    <app-content> </app-content>
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