<template>
  <div class="kanban_area">
    <div
      v-if="type == 'group'"
      class="kanban_view o_kanban_small_column o_kanban_grouped ui-sortable"
    >
      <slot></slot>
    </div>
    <div v-else class="kanban_view renderer_with_searchpanel kanban_ungrouped">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: ["type"],
  created() {
    console.log(this);
  },
};
</script>
