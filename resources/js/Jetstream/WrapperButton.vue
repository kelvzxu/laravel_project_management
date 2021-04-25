<template>
  <div class="laravel-add-to-board-wrapper">
    <div
      class="laravel-add-to-board-menu"
      id="laravel-add-to-board-menu-container"
    >
      <div class="ds-menu-button-container">
        <div class="laravel-add-to-board-menu-button">
          <div class="laravel-board-control">
            <div class="laravel-board-control__icon">
              <i class="fa fa-plus-square"></i>
            </div>
            <div class="laravel-board-control__text"><slot /></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>