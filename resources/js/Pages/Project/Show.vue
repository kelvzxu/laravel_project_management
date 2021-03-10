<template>
  <app-layout>
    <jet-application-control :users="users" :team="team">
      <template #workspace_icon>{{ project.name[0] }}</template>
      <template #workspace_name>{{ project.name }}</template>
      <template #workspace_sub_header>
        <div class="home-workspace-items-content-sub-header-wrapper">
          <div class="new-boards-list-button-component" @click="InviteNewUser">
            <div class="ds-menu-button-container">
              <div>
                <div class="top-new-button-component default-icon">
                  <div
                    class="new-boards-list-button add_new_board_btn leftpane-workspace-header-redesign"
                  >
                    <i class="fa fa-th-large main-icon"></i>Kanban Board
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            class="boards-list-header-component selected leftpane-workspace-header-redesign"
          >
            <jet-responsive-nav-link
              :href="route('teams.show', team.id)"
              :active="route().current('teams.show')"
            >
              <div class="boards-filter-row-wrapper">
                <div class="boards-list-filter-button-component">
                  <i class="far fa-stopwatch main-icon"></i
                  ><span class="filters-text">Timesheet</span>
                </div>
              </div>
            </jet-responsive-nav-link>
          </div>
          <div
            class="boards-list-header-component selected leftpane-workspace-header-redesign"
          >
            <jet-responsive-nav-link
              :href="route('teams.show', team.id)"
              :active="route().current('teams.show')"
            >
              <div class="boards-filter-row-wrapper">
                <div class="boards-list-filter-button-component">
                  <i class="fas fa-file-chart-line main-icon"></i
                  ><span class="filters-text">Project Report</span>
                </div>
              </div>
            </jet-responsive-nav-link>
          </div>
          <div
            class="boards-list-header-component selected leftpane-workspace-header-redesign"
          >
            <jet-responsive-nav-link
              :href="route('stage.show', project.access_token)"
              :active="route().current('stage.view')"
            >
              <div class="boards-filter-row-wrapper">
                <div class="boards-list-filter-button-component">
                  <i class="far fa-layer-group main-icon"></i
                  ><span class="filters-text">Project Stage</span>
                </div>
              </div>
            </jet-responsive-nav-link>
          </div>
          <div
            class="boards-list-header-component selected leftpane-workspace-header-redesign"
          >
            <jet-responsive-nav-link
              :href="route('project.detail', project.id)"
              :active="route().current('project.detail')"
            >
              <div class="boards-filter-row-wrapper">
                <div class="boards-list-filter-button-component">
                  <i class="fa fa-cog main-icon"></i
                  ><span class="filters-text">Project Details</span>
                </div>
              </div>
            </jet-responsive-nav-link>
          </div>
        </div>
      </template>
      <template #main_content>
        <jet-content-wrapper
          :users="users"
          :team="team"
          :projects="project"
          class="project_view"
        >
          <template #board_name>{{ project.name }}</template>
          <template #board_description>{{ project.description }}</template>
          <template #board_subs_images_label>Manager </template>
          <template #board_subs_images>
            <img :src="project.manager.profile_photo_url" class="inner-image" />
          </template>
          <template #board_button>
            <div class="monday-add-to-board-wrapper" @click="AddNewProject">
              <div
                class="monday-add-to-board-menu"
                id="monday-add-to-board-menu-container"
              >
                <div class="ds-menu-button-container">
                  <div class="monday-add-to-board-menu-button">
                    <div class="monday-board-control">
                      <div class="monday-board-control__icon">
                        <i class="fa fa-plus-square"></i>
                      </div>
                      <div class="monday-board-control__text">Add Projects</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </template>
          <template #board_button_group>
            <jet-board-search
              ><input placeholder="Search" value=""
            /></jet-board-search>
            <jet-board-filter-dropdown @click.native="FilterData" />
            <jet-board-sorting />
          </template>
          <template #board_component>
            <kanban-area :type="'group'">
              <kanban-progress
                v-for="stage in project.task_type"
                :key="stage.name"
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
                      :key="task.name"
                      :data-id="task.id"
                      :stage="stage.name"
                    >
                      <template #header>{{ task.name }}</template>
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
        </jet-content-wrapper>
      </template>
    </jet-application-control>
  </app-layout>
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import JetApplicationControl from "@/Jetstream/ApplicationControl";
import AppLayout from "@/Layouts/AppLayout";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSuccessButton from "@/Jetstream/SuccessButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
// Workspace Component
import JetContentWrapper from "@/Jetstream/ContentWrapper";
import JetBoardSorting from "@/Jetstream/BoardSorting";
import JetBoardSearch from "@/Jetstream/BoardSearch";
import JetBoardDropdown from "@/Jetstream/BoardDropdown";
import JetBoardFilterDropdown from "@/Jetstream/BoardFilterDropdown";
// Kanban Component
import KanbanArea from "@/Jetstream/KanbanArea";
import KanbanBox from "@/Jetstream/KanbanBoxGroup";
import KanbanProgress from "@/Jetstream/KanbanProgress";
// Module
import draggable from "vuedraggable";

export default {
  props: ["team", "users", "project"],

  components: {
    AppLayout,
    JetContentWrapper,
    JetApplicationControl,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetLabel,
    JetResponsiveNavLink,
    JetSuccessButton,
    JetSecondaryButton,
    KanbanArea,
    KanbanBox,
    KanbanProgress,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    draggable,
  },
  data() {
    return {
      InviteModal: false,
      SidebarSecondary: false,
      ExpanceControl: true,
      AddProjectModal: false,
      form: this.$inertia.form(
        {
          email: "",
          role: null,
        },
        {
          bag: "InviteUserModal",
        }
      ),
      TaskUpdate: this.$inertia.form({
        id: "",
        stage_id: "",
      }),
    };
  },
  methods: {
    InviteNewUser() {
      this.form.email = "";

      this.InviteModal = true;

      setTimeout(() => {
        this.$refs.email.focus();
      }, 250);
    },
    InviteUserModal() {
      this.form
        .post(route("team-members.store", this.team), {
          preserveScroll: true,
        })
        .then((response) => {
          if (!this.form.hasErrors()) {
            this.InviteModal = false;
          }
        });
    },
    AddNewProject() {
      this.CreateProject.name = "";

      this.AddProjectModal = true;

      setTimeout(() => {
        this.$refs.name.focus();
      }, 250);
    },
    CreateNewProjects() {
      this.CreateProject.post(route("project.store"), {
        preserveScroll: true,
      }).then((response) => {
        this.CreateProject.access_token = Math.random()
          .toString(36)
          .substring(7);
        if (!this.CreateProject.hasErrors()) {
          this.AddProjectModal = false;
        }
        console.log(this.CreateProject);
      });
    },
    viewProject(row) {
      this.$inertia.visit(route("project.show", row.id));
    },
    onAdd(event, stage) {
      this.TaskUpdate.id = event.item.getAttribute("data-id");
      this.TaskUpdate.stage_id = stage;
      this.TaskUpdate.post(route("task_stage.update"), {
        preserveScroll: true,
      });
    },
  },
};
</script>
