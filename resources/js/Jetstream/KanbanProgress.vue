<template>
  <div
    class="o_kanban_group ui-sortable o_kanban_has_progressbar"
    data-id="2"
    role="feed"
    aria-labelledby="kanban_header_2"
  >
    <div class="o_kanban_header">
      <div class="o_kanban_header_title">
        <span id="#kanban_header_2" class="o_column_title"
          ><slot name="title"
        /></span>
        <span class="o_column_unfold"
          ><i
            class="fa fa-arrows-h"
            role="img"
            aria-label="Unfold"
            title="Unfold"
          ></i
        ></span>
        <span class="o_kanban_quick_add"
          ><i
            class="fa fa-plus"
            role="img"
            aria-label="Quick add"
            title="Quick add"
          ></i
        ></span>
      </div>
      <div class="o_kanban_counter">
        <div class="o_kanban_counter_progress progress">
          <div
            class="progress-bar bg-success-full"
            data-filter="done"
            data-original-title="0 Ready"
            aria-valuemin="0"
            aria-valuemax="100"
            aria-valuenow="0"
            role="progressbar"
            style=""
          ></div>
        </div>
        <div class="o_kanban_counter_side">
          <b><slot name="counter" /></b>
        </div>
      </div>
    </div>
    <slot name="record" />
  </div>
</template>