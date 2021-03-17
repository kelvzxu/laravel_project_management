<template>
  <jet-dashboard>
    <template #workspace_icon>{{ project.name[0] }}</template>
    <template #workspace_name>{{ project.name }}</template>
    <template #workspace_sub_header>
      <jet-workspace-sub-header :project="project" />
    </template>
    <template #board_name>{{ project.name }}</template>
    <template #board_description
      >Date Start : {{ project.date_start }}<br />Deadline:{{
        project.date_end
      }}</template
    >
    <template #board_subs_images_label>Manager </template>
    <template #board_subs_images>
      <img :src="project.manager.profile_photo_url" class="inner-image" />
    </template>
    <template #board_subs> Member / {{ team.users.length + 1 }} </template>
    <template #board_button>
      <create-task :users="users" :project="project" :team="team" />
    </template>
    <template #board_button_group>
      <jet-board-search
        ><input placeholder="Search... " v-model="search" style="width: 100%"
      /></jet-board-search>
      <jet-board-filter-dropdown @click.native="FilterData" />
    </template>
    <template #board_component>
      <kanban-area :type="'group'" v-if="isMobile == false">
        <kanban-progress
          v-for="stage in project.task_type"
          :key="stage.id"
          :data-id="stage.name"
        >
          <template #title>{{ stage.name }}</template>
          <template #counter>{{ stage.tasks.length }}</template>
          <template #record>
            <draggable
              :list="stage.tasks"
              group="tasks"
              style="min-height: 500px"
              @add="onAdd($event, stage.id)"
            >
              <kanban-box
                v-for="task in stage.tasks"
                :key="task.id"
                :data-id="task.id"
                :stage="stage.name"
                @click.native="ViewTask(task)"
              >
                <template #header>{{ task.name }}</template>
                <template #body v-if="task.tags"
                  ><span
                    class="badge badge-pill"
                    v-bind:style="{ 'background-color': task.tags.color }"
                    >{{ task.tags.name }}</span
                  ></template
                >
                <template #button>
                  <div class="o_priority kanban_field_widget mr-2">
                    <i class="o_priority_star far fa-star"></i>
                  </div>
                  <div
                    class="o_kanban_inline_block dropdown o_mail_activity kanban_field_widget mr-2"
                  >
                    <i
                      class="far fa-fw o_activity_color_default fa-clock mt-1"
                    ></i>
                  </div>
                </template>
                <template #dateline v-if="task.date_end">{{
                  task.date_end | formatDate
                }}</template>
                <template #picture>
                  <img
                    :src="$page.user.profile_photo_url"
                    class="o_m2o_avatar rounded-circle"
                  />
                </template>
              </kanban-box>
            </draggable>
          </template>
        </kanban-progress>
      </kanban-area>
    </template>
    <template #dialog_node>
      <jet-board-dropdown v-if="FilterDropdown">
        <template #board_filter_item>
          <div class="columns-list-item-wrapper">
            <div class="floating-columns-list-item-component">
              <div class="column-list-item-content">
                <i
                  class="icon column-type-icon icon icon-dapulse-text-column"
                ></i
                ><span class="column-list-item-title">Active Project</span>
              </div>
            </div>
          </div>
          <div class="columns-list-item-wrapper">
            <div class="floating-columns-list-item-component">
              <div class="column-list-item-content">
                <i
                  class="icon column-type-icon icon icon-dapulse-person-column"
                ></i
                ><span class="column-list-item-title">Followed</span>
              </div>
            </div>
          </div>
          <div class="columns-list-item-wrapper">
            <div class="floating-columns-list-item-component">
              <div class="column-list-item-content">
                <i
                  class="icon column-type-icon icon icon-dapulse-person-column"
                ></i
                ><span class="column-list-item-title">My Projects</span>
              </div>
            </div>
          </div>
          <div class="columns-list-item-wrapper">
            <div class="floating-columns-list-item-component">
              <div class="column-list-item-content">
                <i
                  class="icon column-type-icon icon icon-dapulse-person-column"
                ></i
                ><span class="column-list-item-title">Archived</span>
              </div>
            </div>
          </div>
        </template>
      </jet-board-dropdown>
    </template>
  </jet-dashboard>
</template>

<script>
import JetDashboard from "@/Jetstream/Dashboard";
// Workspace Component
import JetBoardSorting from "@/Jetstream/BoardSorting";
import JetBoardSearch from "@/Jetstream/BoardSearch";
import JetBoardDropdown from "@/Jetstream/BoardDropdown";
import JetBoardFilterDropdown from "@/Jetstream/BoardFilterDropdown";
import JetWorkspaceSubHeader from "@/Jetstream/WorkspaceSubHeader";
// Kanban Component
import KanbanArea from "@/Jetstream/KanbanArea";
import KanbanBox from "@/Jetstream/KanbanBoxGroup";
import KanbanProgress from "@/Jetstream/KanbanProgress";
// Module
import draggable from "vuedraggable";
// Page Component
import CreateTask from "@/Pages/Task/CreateTask";

export default {
  props: ["team", "users", "project"],

  components: {
    JetDashboard,
    CreateTask,
    KanbanArea,
    KanbanBox,
    KanbanProgress,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    draggable,
    JetWorkspaceSubHeader,
  },
  data() {
    let sortOrders = {};
    return {
      isMobile: true,
      FilterDropdown: false,
      TaskUpdate: this.$inertia.form({
        id: "",
        stage_id: "",
      }),
      // search and Paginate
      sortKey: "",
      sortOrders: sortOrders,
      search: "",
      length: 30,
      pagination: {
        currentPage: 1,
        total: "",
        nextPage: "",
        prevPage: "",
        from: "",
        to: "",
      },
    };
  },
  created() {
    this.detectMob();
  },
  methods: {
    detectMob() {
      if (window.innerWidth <= 767) {
        this.isMobile = true;
      } else {
        this.isMobile = false;
      }
    },
    onAdd(event, stage) {
      this.TaskUpdate.id = event.item.getAttribute("data-id");
      this.TaskUpdate.stage_id = stage;
      this.TaskUpdate.post(route("task_stage.update"), {
        preserveScroll: true,
      });
    },
    ViewTask(row) {
      this.$inertia.visit(route("project_task.view", row.access_token));
    },
    FilterData() {
      if (this.FilterDropdown == false) {
        this.FilterDropdown = true;
      } else {
        this.FilterDropdown = false;
      }
    },
    paginate(array, length, pageNumber) {
      this.pagination.from = array.length ? (pageNumber - 1) * length + 1 : " ";
      this.pagination.to =
        pageNumber * length > array.length ? array.length : pageNumber * length;
      this.pagination.prevPage = pageNumber > 1 ? pageNumber : "";
      this.pagination.nextPage =
        array.length > this.pagination.to ? pageNumber + 1 : "";
      return array.slice((pageNumber - 1) * length, pageNumber * length);
    },
    resetPagination() {
      this.pagination.currentPage = 1;
      this.pagination.prevPage = "";
      this.pagination.nextPage = "";
    },
    sortBy(key) {
      this.resetPagination();
      this.sortKey = key;
      this.sortOrders[key] = this.sortOrders[key] * -1;
    },
  },
  computed: {
    filterdata() {
      this.resetPagination();
      let value = this.activities;
      if (this.search) {
        value = value.filter((row) => {
          return Object.keys(row).some((key) => {
            return (
              String(row[key])
                .toLowerCase()
                .indexOf(this.search.toLowerCase()) > -1
            );
          });
        });
      }
      let sortKey = this.sortKey;
      let order = this.sortOrders[sortKey] || 1;
      if (sortKey) {
        value = value.slice().sort((a, b) => {
          let index = this.getIndex(this.columns, "name", sortKey);
          a = String(a[sortKey]).toLowerCase();
          b = String(b[sortKey]).toLowerCase();
          if (this.columns[index].type && this.columns[index].type === "date") {
            return (
              (a === b
                ? 0
                : new Date(a).getTime() > new Date(b).getTime()
                ? 1
                : -1) * order
            );
          } else if (
            this.columns[index].type &&
            this.columns[index].type === "number"
          ) {
            return (+a === +b ? 0 : +a > +b ? 1 : -1) * order;
          } else {
            return (a === b ? 0 : a > b ? 1 : -1) * order;
          }
        });
      }
      return value;
    },
    DataRow() {
      return this.paginate(
        this.filterdata,
        this.length,
        this.pagination.currentPage
      );
    },
  },
};
</script>
