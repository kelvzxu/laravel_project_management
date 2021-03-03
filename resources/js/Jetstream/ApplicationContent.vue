<template>
  <div class="first-level" id="first-level">
    <slot></slot>
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
