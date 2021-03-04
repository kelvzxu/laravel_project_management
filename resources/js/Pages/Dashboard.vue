<template>
  <app-layout>
    <jet-application-control :users="users" :team="team">
      <welcome :users="users" :team="team"/>
    </jet-application-control>
  </app-layout>
</template>

<script>
import JetApplicationControl from "@/Jetstream/ApplicationControl";
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";

export default {
  props: ["team", "users"],

  components: {
    JetApplicationControl,
    AppLayout,
    Welcome,
  },
  created() {
    console.log(this)
  },
};
</script>
