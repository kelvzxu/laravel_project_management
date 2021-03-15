<template>
  <div class="control_panel">
    <div class="cp_top">
      <div class="cp_top_left">
        <ol
          role="navigation"
          class="breadcrumb mb-0 ml-1"
          style="display: block"
        >
          <slot name="title"></slot>
        </ol>
      </div>
      <div class="cp_top_right">
        <slot name="search"></slot>
      </div>
    </div>
    <div class="cp_bottom">
      <div class="cp_bottom_left">
        <div role="toolbar" class="cp_buttons">
          <div class="list_buttons ml-3" role="toolbar">
            <slot name="button"></slot>
          </div>
        </div>
      </div>
      <div class="cp_bottom_right">
        <div role="search" class="cp_pager">
          <nav aria-label="Pager" class="o_pager">
            <span class="pager_counter"
              ><span class="pager_value"><slot name="pager_value"/></span><span> / </span
              ><span class="pager_limit"><slot name="pager_limit"/></span></span
            ><span aria-atomic="true" class="btn-group"
              ><slot name="pager_button"/></span>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>