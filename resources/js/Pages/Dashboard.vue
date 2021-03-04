<template>
  <app-layout>
    <jet-application-control
      :users="users"
      :team="team"
      :availableRoles="availableRoles"
      :user-permissions="permissions"
    >
      <welcome :users="users" :team="team" />
    </jet-application-control>
  </app-layout>
</template>

<script>
import JetApplicationControl from "@/Jetstream/ApplicationControl";
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";

export default {
  props: ["team", "users", "availableRoles", "permissions"],

  components: {
    JetApplicationControl,
    AppLayout,
    Welcome,
  },
  created() {
    console.log(this);
  },
};
</script>
