<template>
  <div>
    <button type="submit" v-if="as == 'button'">
      <slot></slot>
    </button>

    <inertia-link :href="href" v-else>
      <slot></slot>
    </inertia-link>
  </div>
</template>

<script>
export default {
  props: ["href", "as"],
};
</script>
