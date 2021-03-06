<template>
  <app-layout>
    <jet-application-control
      :users="users"
      :team="team"
      :availableRoles="availableRoles"
      :user-permissions="permissions"
    >
      <template #workspace_icon>{{ team.name[0] }}</template>
      <template #workspace_name>{{ team.name }}</template>
      <template #workspace_sub_header>
        <div class="home-workspace-items-content-sub-header-wrapper">
          <div
            v-if="permissions.canAddTeamMembers"
            class="new-boards-list-button-component"
            @click="InviteNewUser"
          >
            <div class="ds-menu-button-container">
              <div>
                <div class="top-new-button-component default-icon">
                  <div
                    class="new-boards-list-button add_new_board_btn leftpane-workspace-header-redesign"
                  >
                    <i class="fa fa-user-plus main-icon"></i>Invite
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
                  <i class="fa fa-cog main-icon"></i
                  ><span class="filters-text">Team Details</span>
                </div>
              </div>
            </jet-responsive-nav-link>
            <div class="unified-boards-search-input-wrapper empty">
              <i class="fa fa-search search-icon"></i
              ><input
                id="boards-list-search-input"
                class="unified-boards-search-input"
                placeholder="Search"
                autocomplete="off"
                value=""
              />
            </div>
          </div>
        </div>
      </template>
      <template #main_content>
        <jet-dialog-modal :show="InviteModal" @close="InviteModal = false">
          <template #title> Add Team Member </template>

          <template #content>
            <div class="col-span-6">
              <div class="max-w-xl text-sm text-gray-600">
                Please provide the email address of the person you would like to
                add to this team. The email address must be associated with an
                existing account.
              </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
              <jet-label for="email" value="Email" />
              <jet-input
                id="email"
                type="text"
                class="mt-1 block w-full"
                ref="email"
                v-model="addTeamMemberForm.email"
              />
              <jet-input-error
                :message="addTeamMemberForm.error('email')"
                class="mt-2"
              />
            </div>

            <div
              class="col-span-6 lg:col-span-4 mt-4"
              v-if="availableRoles.length > 0"
            >
              <jet-label for="roles" value="Role" />
              <jet-input-error
                :message="addTeamMemberForm.error('role')"
                class="mt-2"
              />

              <div
                class="mt-1 border border-gray-200 rounded-lg cursor-pointer"
              >
                <div
                  class="px-4 py-3"
                  :class="{ 'border-t border-gray-200': i > 0 }"
                  @click="addTeamMemberForm.role = role.key"
                  v-for="(role, i) in availableRoles"
                  :key="role.key"
                >
                  <div
                    :class="{
                      'opacity-50':
                        addTeamMemberForm.role &&
                        addTeamMemberForm.role != role.key,
                    }"
                  >
                    <div class="flex items-center">
                      <div
                        class="text-sm text-gray-600"
                        :class="{
                          'font-semibold': addTeamMemberForm.role == role.key,
                        }"
                      >
                        {{ role.name }}
                      </div>

                      <svg
                        v-if="addTeamMemberForm.role == role.key"
                        class="ml-2 h-5 w-5 text-green-400"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                        ></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </template>

          <template #footer>
            <jet-action-message
              :on="addTeamMemberForm.recentlySuccessful"
              class="mr-3"
            >
              Added.
            </jet-action-message>

            <jet-button
              :class="{ 'opacity-25': addTeamMemberForm.processing }"
              :disabled="addTeamMemberForm.processing"
              @click.native="addTeamMember"
            >
              Add
            </jet-button>
          </template>
        </jet-dialog-modal>
        <jet-dialog-modal
          :show="AddProjectModal"
          @close="AddProjectModal = false"
        >
          <template #title> CreateProject </template>

          <template #content>
            <div class="mt-4">
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Project Name" />
                <jet-input
                  id="name"
                  type="text"
                  ref="name"
                  class="mt-1 block w-full"
                  v-model="CreateProject.name"
                />
                <jet-input-error
                  :message="CreateProject.error('email')"
                  class="mt-2"
                />
              </div>
              <div class="col-span-6 sm:col-span-4">
                <label class="form-check-label" for="allow_timesheets"
                  >Allow Timesheets
                </label>
                <input
                  class="form-check-input ml-3"
                  type="checkbox"
                  v-model="CreateProject.allow_timesheets"
                  name="private_profile"
                  id="user_private_profile"
                />
                <jet-input-error
                  :message="CreateProject.error('email')"
                  class="mt-2"
                />
              </div>
            </div>
          </template>

          <template #footer>
            <jet-success-button
              class="ml-2"
              @click.native="CreateNewProjects"
              :class="{ 'opacity-25': CreateProject.processing }"
              :disabled="CreateProject.processing"
            >
              Create
            </jet-success-button>
          </template>
        </jet-dialog-modal>
        <jet-content-wrapper :users="users" :team="team" :projects="projects">
          <template #board_name>{{ team.name }}</template>
          <template #board_description>{{ team.description }}</template>
          <template #board_subs_images_label>Owner </template>
          <template #board_subs_images>
            <img :src="team.owner.profile_photo_url" class="inner-image" />
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
          <template #board_header_action>
            <div class="board-header-view-actions">
              <div class="board-filter-item-component active">
                <div class="board-filter-item-content-wrapper">
                  <div
                    class="board-filter-item-content without-additional-data"
                  >
                    <i class="item-icon fa fa-lg fa-th-large"></i>
                  </div>
                </div>
              </div>
              <div class="board-filter-item-component">
                <div class="board-filter-item-content-wrapper">
                  <div
                    class="board-filter-item-content without-additional-data"
                  >
                    <i class="item-icon fa fa-lg fa-list-ul"></i>
                  </div>
                </div>
              </div>
            </div>
          </template>
          <template #dialog_node>
            <jet-board-dropdown v-if="FilterDropdown">
              <template #board_filter_item>
                <div class="columns-list-item-wrapper">
                  <div class="floating-columns-list-item-component floating">
                    <div class="column-list-item-content">
                      <i
                        class="icon column-type-icon icon icon-dapulse-text-column"
                      ></i
                      ><span class="column-list-item-title"
                        >Active Project</span
                      >
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
          <template #board_component>
            <kanban-area>
              <kanban-box
                v-for="project in projects"
                :key="project.access_token"
                @click.native="viewProject(project)"
              >
                <template #jobs
                  ><span>{{ project.name }}</span></template
                >
                <template #tags
                  ><span class="field_tag tag_color_6"
                    ><span></span>{{ project.manager.name }}</span
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
// Form & Modal Component
import JetDialogModal from "@/Jetstream/DialogModal";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
// Button Component
import JetSuccessButton from "@/Jetstream/SuccessButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetButton from "@/Jetstream/Button";
// Workspace Component
import JetContentWrapper from "@/Jetstream/ContentWrapper";
import JetBoardSorting from "@/Jetstream/BoardSorting";
import JetBoardSearch from "@/Jetstream/BoardSearch";
import JetBoardDropdown from "@/Jetstream/BoardDropdown";
import JetBoardFilterDropdown from "@/Jetstream/BoardFilterDropdown";
// Kanban Component
import KanbanArea from "@/Jetstream/KanbanArea";
import KanbanBox from "@/Jetstream/KanbanBox";
import KanbanGhost from "@/Jetstream/KanbanGhost";

export default {
  props: ["team", "users", "availableRoles", "permissions", "projects"],

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
    JetButton,
    KanbanArea,
    KanbanBox,
    KanbanGhost,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    JetActionMessage,
  },
  data() {
    return {
      InviteModal: false,
      SidebarSecondary: false,
      ExpanceControl: true,
      AddProjectModal: false,
      FilterDropdown: false,
      addTeamMemberForm: this.$inertia.form(
        {
          email: "",
          role: null,
        },
        {
          bag: "addTeamMember",
          resetOnSuccess: true,
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
      this.addTeamMemberForm.email = "";

      this.InviteModal = true;

      setTimeout(() => {
        this.$refs.email.focus();
      }, 250);
    },
    addTeamMember() {
      this.addTeamMemberForm
        .post(route("team-members.store", this.team), {
          preserveScroll: true,
        })
        .then((response) => {
          if (!this.addTeamMemberForm.hasErrors()) {
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
        this.sequence = Math.floor(Math.random() * 1000) + 1;
        if (!this.CreateProject.hasErrors()) {
          this.AddProjectModal = false;
        }
        console.log(this.CreateProject);
      });
    },
    FilterData() {
      if (this.FilterDropdown == false) {
        this.FilterDropdown = true;
      } else {
        this.FilterDropdown = false;
      }
    },
    viewProject(row) {
      this.$inertia.visit(route("project.show", row.id));
    },
  },
};
</script>
