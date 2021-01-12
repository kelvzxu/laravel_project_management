<template>
  <div class="table-responsive">
    <table
      class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped"
    >
      <thead>
        <slot name="header"></slot>
      </thead>
      <tbody class="ui-sortable">
        <slot name="content"></slot>
      </tbody>
    </table>
  </div>
</template>
