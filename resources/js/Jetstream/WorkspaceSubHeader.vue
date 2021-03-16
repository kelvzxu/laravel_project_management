<template>
  <div class="home-workspace-items-content-sub-header-wrapper">
    <jet-responsive-nav-link
      :href="route('project.show', project.access_token)"
    >
      <jet-workspace-button
        :class="{
          'workspace floating': route().current('project.show') == true,
        }"
      >
        <i class="fa fa-th-large main-icon"></i>Kanban Board
      </jet-workspace-button>
    </jet-responsive-nav-link>
    <jet-responsive-nav-link
      :href="route('timesheet.show', project.access_token)"
    >
      <jet-workspace-button
        :class="{
          'workspace floating': route().current('timesheet.show') == true,
        }"
      >
        <i class="far fa-stopwatch main-icon"></i>Timesheets
      </jet-workspace-button>
    </jet-responsive-nav-link>
    <jet-responsive-nav-link
      :href="route('project.show', project.access_token)"
      :active="route().current('project.show')"
    >
      <jet-workspace-button>
        <i class="fas fa-file-chart-line main-icon"></i>Project Report
      </jet-workspace-button>
    </jet-responsive-nav-link>
    <jet-responsive-nav-link :href="route('stage.show', project.access_token)">
      <jet-workspace-button
        :class="{
          'workspace floating': route().current('stage.show') == true,
        }"
      >
        <i class="far fa-layer-group main-icon main-icon"></i>Project Stage
      </jet-workspace-button>
    </jet-responsive-nav-link>
    <jet-responsive-nav-link :href="route('tags.show', project.access_token)">
      <jet-workspace-button
        :class="{
          'workspace floating': route().current('tags.show') == true,
        }"
      >
        <i class="fas fa-tags main-icon"></i>Project Tags
      </jet-workspace-button>
    </jet-responsive-nav-link>
    <jet-responsive-nav-link :href="route('activity.show', project.access_token)">
      <jet-workspace-button
        :class="{
          'workspace floating': route().current('activity.show') == true,
        }"
      >
        <i class="fas fa-calendar-alt main-icon"></i>Schedule Activity
      </jet-workspace-button>
    </jet-responsive-nav-link>
    <jet-responsive-nav-link
      :href="route('project.detail', project.access_token)"
      :active="route().current('project.detail')"
    >
      <jet-workspace-button>
        <i class="fa fa-cog main-icon"></i>Project Details
      </jet-workspace-button>
    </jet-responsive-nav-link>
  </div>
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import JetWorkspaceButton from "@/Jetstream/WorkspaceButton";
export default {
  props: ["project"],
  components: {
    JetWorkspaceButton,
    JetResponsiveNavLink,
  },
};
</script>

<style>
</style>