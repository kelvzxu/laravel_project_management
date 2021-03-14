<template>
  <div class="monday-add-to-board-wrapper">
    <div
      class="monday-add-to-board-menu"
      id="monday-add-to-board-menu-container"
    >
      <div class="ds-menu-button-container">
        <div class="monday-add-to-board-menu-button">
          <div class="monday-board-control">
            <div class="monday-board-control__icon">
              <i class="fa fa-plus-square"></i>
            </div>
            <div class="monday-board-control__text"><slot /></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>