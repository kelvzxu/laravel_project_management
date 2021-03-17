<template>
  <app-layout>
    <jet-application-control>
      <template #workspace_icon><slot name="workspace_icon" /></template>
      <template #workspace_name><slot name="workspace_name" /></template>
      <template #workspace_sub_header
        ><slot name="workspace_sub_header" />
      </template>
      <template #main_content>
        <slot name="page_modal" />
        <jet-content-wrapper class="project_view">
          <template #board_name><slot name="board_name" /></template>
          <template #board_description
            ><slot name="board_description"
          /></template>
          <template #board_subs_images_label
            ><slot name="board_subs_images_label"
          /></template>
          <template #board_subs_images>
            <slot name="board_subs_images" />
          </template>
          <template #board_subs>
            <slot name="board_subs" />
          </template>
          <template #board_button>
            <slot name="board_button" />
          </template>
          <template #board_button_group>
            <slot name="board_button_group" />
          </template>
          <template #board_header_action>
            <slot name="board_header_action" />
          </template>
          <template #board_component>
            <slot name="board_component" />
          </template>
          <template #dialog_node> <slot name="dialog_node" /> </template>
        </jet-content-wrapper>
      </template>
    </jet-application-control>
  </app-layout>
</template>

<script>
// Base Component
import JetApplicationControl from "@/Jetstream/ApplicationControl";
import AppLayout from "@/Layouts/AppLayout";
// Workspace Component
import JetContentWrapper from "@/Jetstream/ContentWrapper";
import JetBoardSorting from "@/Jetstream/BoardSorting";
import JetBoardSearch from "@/Jetstream/BoardSearch";
import JetBoardDropdown from "@/Jetstream/BoardDropdown";
import JetBoardFilterDropdown from "@/Jetstream/BoardFilterDropdown";
import JetWorkspaceButton from "@/Jetstream/WorkspaceButton";

export default {
  components: {
    //   Base Component
    JetApplicationControl,
    AppLayout,
    // Workspace Component
    JetContentWrapper,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    JetWorkspaceButton,
  },
};
</script>
