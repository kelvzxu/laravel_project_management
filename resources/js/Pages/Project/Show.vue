<template>
  <app-layout>
    <jet-application-control
      :users="users"
      :team="team"
    >
      <template #workspace_icon>{{ project.name[0] }}</template>
      <template #workspace_name>{{ project.name }}</template>
      <template #workspace_sub_header>
        <div class="home-workspace-items-content-sub-header-wrapper">
          <div
            class="new-boards-list-button-component"
            @click="InviteNewUser"
          >
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
              :href="route('teams.show', team.id)"
              :active="route().current('teams.show')"
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
        <jet-content-wrapper :users="users" :team="team" :projects="projects">
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
          <template #board_component>
            <kanban-area>
              <kanban-box
              >
                <template #jobs
                  ><span>{{ project.name }}</span></template
                >
                <template #tags
                  ><span class="field_tag tag_color_6"
                    ><span></span>{{project.manager.name}}</span
                  ></template
                >
              </kanban-box>
              <kanban-ghost v-for="n in 75" :key="n"></kanban-ghost>
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
import JetContentWrapper from "@/Jetstream/ContentWrapper";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSuccessButton from "@/Jetstream/SuccessButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
// Kanban Component
import KanbanArea from "@/Jetstream/KanbanArea";
import KanbanBox from "@/Jetstream/KanbanBox";
import KanbanGhost from "@/Jetstream/KanbanGhost";

export default {
  props: ["team", "users","project"],

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
    KanbanGhost,
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
      CreateProject: this.$inertia.form(
        {
          name: "",
          allow_timesheets: true,
          access_token: Math.random().toString(36).substring(7),
          sequence: Math.floor(Math.random() * 1000) + 1,
          user_id: this.users.id,
          team_id: this.team.id,
          create_uid: this.users.id,
          write_uid: this.users.id,
        },
        {
          bag: "InviteUserModal",
        }
      ),
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
      console.log("____________");
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
  },
};
</script>
