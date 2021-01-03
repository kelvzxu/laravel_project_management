<template>
  <div>
    <button :class="classes" class="w-full text-left" v-if="as == 'button'">
      <slot></slot>
    </button>

    <inertia-link :href="href" :class="classes" v-else>
      <slot></slot>
    </inertia-link>
  </div>
</template>

<script>
export default {
  props: ["active", "href", "as"],

  computed: {
    classes() {
      return this.active
        ? "block text-black border-transparent text-base font-medium focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 ease-in-out button_link"
        : "block border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none ease-in-out button_link";
    },
  },
};
</script>
