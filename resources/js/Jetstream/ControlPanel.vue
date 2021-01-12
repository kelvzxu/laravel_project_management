<template>
  <div class="control_panel">
    <div class="cp_top">
      <div class="cp_top_left">
        <ol role="navigation" class="breadcrumb mb-0" style="display: block">
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
              ><span class="pager_value">1-2</span><span> / </span
              ><span class="pager_limit">2</span></span
            ><span aria-atomic="true" class="btn-group"
              ><button
                type="button"
                aria-label="Previous"
                title="Previous"
                tabindex="-1"
                class="fa fa-chevron-left btn btn-secondary pager_previous"
              ></button
              ><button
                type="button"
                aria-label="Next"
                title="Next"
                tabindex="-1"
                class="fa fa-chevron-right btn btn-secondary pager_next"
              ></button
            ></span>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>