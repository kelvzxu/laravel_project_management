<template>
  <li :class="classes">
    <inertia-link :href="href">
      <slot></slot>
    </inertia-link>
  </li>
</template>

<script>
export default {
  props: ["active", "href"],

  computed: {
    classes() {
      return this.active ? "is-selected" : "";
    },
  },
};
</script>
