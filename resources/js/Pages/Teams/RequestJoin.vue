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
            v-if="permissions.canAddTeamMembers"
            class="new-boards-list-button-component"
          >
            <jet-responsive-nav-link
              :href="route('request_join.show', team.id)"
              :active="route().current('request_join.show')"
            >
              <div class="ds-menu-button-container">
                <div>
                  <div class="top-new-button-component default-icon">
                    <div
                      class="new-boards-list-button add_new_board_btn leftpane-workspace-header-redesign"
                    >
                      <i class="fas fa-comment-exclamation main-icon"></i
                      >Request Join
                    </div>
                  </div>
                </div>
              </div>
            </jet-responsive-nav-link>
          </div>
          <div
            class="boards-list-header-component selected leftpane-workspace-header-redesign"
          >
            <jet-responsive-nav-link
              :href="route('teams.show', team.access_token)"
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
        <jet-content-wrapper :users="users" :team="team">
          <template #board_name>{{ team.name }}</template>
          <template #board_description>{{ team.description }}</template>
          <template #board_subs_images_label>Owner </template>
          <template #board_subs_images>
            <img :src="team.owner.profile_photo_url" class="inner-image" />
          </template>
          <template #board_button_group>
            <jet-board-search
              ><input placeholder="Search" value=""
            /></jet-board-search>
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
          <template #board_component>
            <table-responsive>
              <template #header>
                <tr>
                  <th
                    class="o_handle_cell o_column_sortable o_list_number_th"
                    style="min-width: 33px; width: 33px"
                  ></th>
                  <th style="width: 171px">Name</th>
                  <th style="width: 190px">role</th>
                  <th style="width: 190px">Request Date</th>
                  <th style="width: 90px">Action</th>
                </tr>
              </template>
              <template #content :list="'requests'">
                <tr class="data_row" v-for="(request, i) in requests" :key="i">
                  <td>
                    <span
                      class="row_handle fa fa-arrows ui-sortable-handle o_field_widget"
                      name="sequence"
                    ></span>
                  </td>
                  <td>{{ request.user.name }}</td>
                  <td>{{ request.role }}</td>
                  <td>{{ request.created_at | formatDate }}</td>
                  <td>
                    <form
                      method="POST"
                      @submit.prevent="
                        AcceptRequest(request.user_id, request.team_id)
                      "
                    >
                      <jet-Primary-button class="float-right">
                        Accept
                      </jet-Primary-button>
                    </form>
                  </td>
                </tr>
              </template>
            </table-responsive>
          </template>
        </jet-content-wrapper>
        <!-- <div
          class="first-level-content-wrapper first-level-control-pinned"
          id="first-level-content-wrapper"
        >
          <div
            class="first-level-content react-board"
            id="first-level-content"
            style="margin-right: 0px"
          >
            <div
              class="current-board-component"
              id="current-board-component-id"
            ></div>
            <table-responsive>
              <template #header>
                <tr>
                  <th
                    class="o_handle_cell o_column_sortable o_list_number_th"
                    style="min-width: 33px; width: 33px"
                  ></th>
                  <th style="width: 171px">Name</th>
                  <th style="width: 190px">role</th>
                  <th style="width: 190px">Request Date</th>
                  <th style="width: 90px">Action</th>
                </tr>
              </template>
              <template #content>
                <tr class="data_row" v-for="(request, i) in requests" :key="i">
                  <td class="text-center">{{ i + 1 }}</td>
                  <td>{{ request.user.name }}</td>
                  <td>{{ request.role }}</td>
                  <td>{{ request.created_at | formatDate }}</td>
                  <td>
                    <form
                      method="POST"
                      @submit.prevent="
                        AcceptRequest($request.user_id, request.team_id)
                      "
                    >
                      <jet-Primary-button class="float-right">
                        Accept
                      </jet-Primary-button>
                    </form>
                  </td>
                </tr>
              </template>
            </table-responsive>
          </div>
        </div> -->
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
import JetPrimaryButton from "@/Jetstream/PrimaryButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetButton from "@/Jetstream/Button";
// Workspace Component
import JetContentWrapper from "@/Jetstream/ContentWrapper";
import JetBoardSorting from "@/Jetstream/BoardSorting";
import JetBoardSearch from "@/Jetstream/BoardSearch";
import JetBoardDropdown from "@/Jetstream/BoardDropdown";
import JetBoardFilterDropdown from "@/Jetstream/BoardFilterDropdown";
// Table Reaponsive
import TableResponsive from "@/Jetstream/TableResponsive";

export default {
  props: ["team", "users", "availableRoles", "permissions", "requests"],

  components: {
    AppLayout,
    JetContentWrapper,
    JetApplicationControl,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetLabel,
    JetResponsiveNavLink,
    JetPrimaryButton,
    JetSecondaryButton,
    JetButton,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    JetActionMessage,
    TableResponsive,
  },
  data() {
    return {
      InviteModal: false,
      SidebarSecondary: false,
      ExpanceControl: true,
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
    FilterData() {
      if (this.FilterDropdown == false) {
        this.FilterDropdown = true;
      } else {
        this.FilterDropdown = false;
      }
    },
    viewProject(row) {
      this.$inertia.visit(route("project.show", row.access_token));
    },
    AcceptRequest(user, team) {
      this.$inertia.post(route("request_join.approve", [team, user]));
    },
  },
};
</script>
