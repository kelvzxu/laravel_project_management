<template>
  <div class="application-content">
    <div class="application-content-wrapper">
      <div
        class="first-level-content"
        id="first-level-content"
        style="margin-right: 0px"
      >
        <slot></slot>
      </div>
      <div class="livechat-button">
        <span class="far fa-comments fa-2x text-center"> </span>
      </div>
    </div>
  </div>
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";

export default {
  components: {
    JetResponsiveNavLink,
  },
};
</script>
