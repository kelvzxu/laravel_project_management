<template>
  <jet-dashboard>
    <template #workspace_icon><i class="fas fa-filter" /></template>
    <template #workspace_name>Filter</template>
    <template #workspace_sub_header>
      <div class="home-workspace-items-content-sub-header-wrapper">
        <slot name="filter" />
      </div>
    </template>
    <template #board_name>Search Page</template>
    <template #board_description
      ><b><slot name="page_name" /></b
    ></template>
    <template #board_subs><slot name="page" /></template>
    <template #board_button_group><slot name="board_button_group" /></template>
    <template #board_header_action>
      <slot name="board_header_action" />
    </template>
    <template #board_component><slot name="record" /></template>
  </jet-dashboard>
</template>

<script>
import JetDashboard from "@/Jetstream/Dashboard";
// Workspace Component
import JetBoardSorting from "@/Jetstream/BoardSorting";
import JetBoardSearch from "@/Jetstream/BoardSearch";
import JetBoardDropdown from "@/Jetstream/BoardDropdown";
import JetBoardFilterDropdown from "@/Jetstream/BoardFilterDropdown";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import JetWorkspaceButton from "@/Jetstream/WorkspaceButton";

export default {
  components: {
    JetDashboard,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    JetWorkspaceButton,
    JetResponsiveNavLink,
  },

  mounted() {
    this.board = document.querySelector("div.monday-board-control__icon");
    this.permission_icon = document.querySelector(
      "div.workspace-permission-icon-wrapper"
    );
    this.scrolling = document.querySelector("div.scrolling-component");
    this.board.classList.add("d-none");
    this.permission_icon.classList.add("d-none");
    this.scrolling.classList.add("d-none");
  },
};
</script>
