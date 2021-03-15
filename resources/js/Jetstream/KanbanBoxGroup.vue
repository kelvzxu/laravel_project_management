<template>
  <div
    class="oe_kanban_color_0 oe_kanban_card oe_kanban_global_click kanban_record oe_kanban_card_muted"
    modifiers="{}"
    tabindex="0"
    role="article"
  >
    <div class="oe_kanban_content" modifiers="{}">
      <div class="kanban_record_top" modifiers="{}">
        <div class="kanban_record_headings" modifiers="{}">
          <strong class="kanban_record_title" modifiers="{}"
            ><span><slot name="header" /></span
          ></strong>
        </div>
      </div>
      <div class="kanban_record_body" modifiers="{}">
        <slot name="body" />
      </div>
      <div class="kanban_record_bottom" modifiers="{}">
        <div class="oe_kanban_bottom_left" modifiers="{}">
          <slot name="button" />
          <div name="date_deadline">
            <span class="o_field_date o_field_widget text-bf text-danger"
              ><slot name="dateline"
            /></span>
          </div>
        </div>
        <div class="oe_kanban_bottom_right" modifiers="{}">
          <div
            class="o_field_many2one_avatar o_clickable_m2o_avatar o_field_widget"
            name="user_id"
          >
            <slot name="picture" />
          </div>
        </div>
      </div>
    </div>
    <div class="oe_clear" modifiers="{}"></div>
  </div>
</template>