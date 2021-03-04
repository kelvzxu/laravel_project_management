<template>
  <div class="surface-control-primary">
    <div class="surface-company-logo-component-wrapper">
      <div class="surface-company-logo-component">
        <span class="surface-company-logo-image-wrapper">
          <jet-application-mark
            class="sidebar-company-logo-image"
            width="auto"
            height="auto"
          />
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