<template>
  <jet-dashboard>
    <template #workspace_icon>{{ project.name[0] }}</template>
    <template #workspace_name>{{ project.name }}</template>
    <template #workspace_sub_header>
      <div class="home-workspace-items-content-sub-header-wrapper">
        <jet-responsive-nav-link
          :href="route('report.overview', project.access_token)"
        >
          <jet-workspace-button
            :class="{
              'workspace floating': route().current('report.overview') == true,
            }"
          >
            <i class="fa fa-puzzle-piece main-icon"></i>Overview
          </jet-workspace-button>
        </jet-responsive-nav-link>
        <jet-responsive-nav-link
          :href="route('report.task_analysis', project.access_token)"
        >
          <jet-workspace-button
            :class="{
              'workspace floating':
                route().current('report.task_analysis') == true,
            }"
          >
            <i class="fad fa-analytics main-icon"></i>Task Analysis
          </jet-workspace-button>
        </jet-responsive-nav-link>
        <jet-responsive-nav-link
          :href="route('report.planning_analysis', project.access_token)"
        >
          <jet-workspace-button
            :class="{
              'workspace floating':
                route().current('report.planning_analysis') == true,
            }"
          >
            <i class="fas fa-chart-line main-icon"></i>Timesheet and Planning
          </jet-workspace-button>
        </jet-responsive-nav-link>
        <jet-responsive-nav-link
          :href="route('report.overview', project.access_token)"
        >
          <jet-workspace-button
            :class="{
              'workspace floating': route().current('report.overview') == true,
            }"
          >
            <i class="fas fa-dollar-sign main-icon"></i>Cost and Revenues
          </jet-workspace-button>
        </jet-responsive-nav-link>
      </div>
    </template>
    <template #board_name><slot name="report_name" /></template>
    <template #board_description
      ><b><slot name="project_name" /></b
    ></template>
    <template #board_subs_images_label>Manager </template>
    <template #board_subs_images>
      <img :src="project.manager.profile_photo_url" class="inner-image" />
    </template>
    <template #board_subs> Member / {{ team.users.length + 1 }} </template>
    <template #board_button> </template>
    <template #board_component><slot name="report" /></template>
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
  props: ["project", "team"],

  components: {
    JetDashboard,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    JetWorkspaceButton,
    JetResponsiveNavLink,
  },
};
</script>
