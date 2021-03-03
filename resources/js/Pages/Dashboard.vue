<template>
  <app-layout>
    <jet-application-control>
      <welcome />
    </jet-application-control>
  </app-layout>
</template>

<script>
import JetApplicationControl from "@/Jetstream/ApplicationControl";
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";

export default {
  components: {
    JetApplicationControl,
    AppLayout,
    Welcome,
  },
};
</script>
