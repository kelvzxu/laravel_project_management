<template>
  <div
    tabindex="-1"
    class="ds-dialog-content-wrapper"
    style="position: relative; left: 119px; top: 140px"
  >
    <div
      class="ds-dialog-content-component bottom edge-bottom opacity-and-slide-enter-done"
    >
      <div class="floating-columns-dialog-component">
        <div class="floating-columns-title-wrapper">
          <div class="floating-columns-title">Filter Data</div>
        </div>
        <div class="floating-columns-list-component">
          <div class="columns-list-items-wrapper">
            <slot name="board_filter_item" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>