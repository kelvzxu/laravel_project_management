<template>
  <dashboard :users="users" :view_type="view_type">
    <template #content>
       <kanban-area>
        <kanban-box
          v-for="data in users.original.result.projects"
          :key="data.id*500"
        >
          <template #jobs
            ><span>{{ data.project.name }}</span></template
          >
          <template #tags
            ><span class="field_tag tag_color_6"
              ><span></span>{{ data.project.manager.name }}</span
            ></template
          >
        </kanban-box>
        <kanban-ghost v-for="n in 80 - users.original.result.projects.length" :key="n"></kanban-ghost>
      </kanban-area>
    </template>
  </dashboard>
</template>

<script>
// Page
import dashboard from "./dashboard";
// Kanban Component
import KanbanArea from "@/Jetstream/KanbanArea";
import KanbanBox from "@/Jetstream/KanbanBox";
import KanbanGhost from "@/Jetstream/KanbanGhost";

export default {
  props: ["users", "view_type"],

  components: {
    dashboard,
    KanbanArea,
    KanbanBox,
    KanbanGhost,
  },
  created() {
    console.log(this.users)
  }
};
</script>