<template>
  <div class="table-responsive">
    <table
      class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped"
    >
      <thead>
        <slot name="header"></slot>
      </thead>

      <draggable
        :list="list"
        :element="'tbody'"
        :options="{ animation: 250, handle: '.row_handle' }"
        class="ui-sortable"
      >
        <slot name="content"></slot>
      </draggable>
    </table>
  </div>
</template>

<script>
// Module
import draggable from "vuedraggable";

export default {
  props: ["list"],

  components: {
    draggable,
  },
};
</script>
