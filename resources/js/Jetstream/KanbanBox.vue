<template>
  <div class="kanban_global_click kanban_record_has_image kanban_record">
    <slot name="image"></slot>

    <div class="kanban_details">
      <div class="kanban_record_top">
        <div class="kanban_record_headings">
          <strong class="kanban_record_title">
            <div class="float-right">
              <span class="fa fa-circle text-warning"></span>
            </div>
            <slot name="name"></slot>
          </strong>
          <span class="kanban_record_subtitle">
            <slot name="jobs"></slot>
          </span>
        </div>
      </div>
      <div class="field_many2manytags kanban_tags">
        <span class="field_tag tag_color_6"><span></span>Employee</span>
      </div>
      <ul>
        <li>
          <slot name="email"></slot>
        </li>
        <li>
          <slot name="phone"></slot>
        </li>
      </ul>
      <div>
        <slot name="button"></slot>
      </div>
    </div>
  </div>
</template>