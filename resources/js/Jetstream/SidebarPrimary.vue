<template>
  <div class="sidebar-control-primary">
    <div class="sidebar-application-logo-component-wrapper">
      <div class="sidebar-application-logo-component">
        <span class="sidebar-company-logo-image-wrapper">
          <inertia-link :href="route('dashboard')">
            <jet-application-mark class="sidebar-company-logo-image" />
          </inertia-link>
        </span>
      </div>
    </div>
    <slot></slot>
  </div>
</template>

<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark";

export default {
  components: {
    JetApplicationMark,
  },

  data() {
    return {
      showingNavigationDropdown: false,
    };
  },
};
</script>