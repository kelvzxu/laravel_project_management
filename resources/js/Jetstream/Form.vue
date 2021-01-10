<template>
  <form @submit.prevent="$emit('submitted')">
    <slot name="form"></slot>

    <div
      class="flex items-center justify-end px-4 py-3 text-right sm:px-6"
      v-if="hasActions"
    >
      <slot name="actions"></slot>
    </div>
  </form>
</template>

<script>
import JetSectionTitle from "./SectionTitle";

export default {
  components: {
    JetSectionTitle,
  },

  computed: {
    hasActions() {
      return !!this.$slots.actions;
    },
  },
};
</script>
