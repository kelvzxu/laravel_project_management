<template>
  <app-layout>
    <jet-application-control
      :users="users"
      :team="team"
      :availableRoles="availableRoles"
      :user-permissions="permissions"
    >
      <template #workspace_icon>{{team.name[0]}}</template>
          <template #workspace_name>{{team.name}}</template>
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
        <template #title> Invite User </template>

        <template #content>
          Please provide the email address of the person you would like to add
          to this team. The email address must be associated with an existing
          account.

          <div class="mt-4">
            <!-- Member Email -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="email" value="Email" />
              <jet-input
                id="email"
                type="text"
                class="mt-1 block w-full"
                v-model="form.email"
              />
              <jet-input-error :message="form.error('email')" class="mt-2" />
            </div>
            <!-- Role -->
            <div
              class="col-span-6 lg:col-span-4"
              v-if="availableRoles.length > 0"
            >
              <jet-label for="roles" value="Role" />
              <jet-input-error :message="form.error('role')" class="mt-2" />

              <div
                class="mt-1 border border-gray-200 rounded-lg cursor-pointer"
              >
                <div
                  class="px-4 py-3"
                  :class="{ 'border-t border-gray-200': i > 0 }"
                  @click="form.role = role.key"
                  v-for="(role, i) in availableRoles"
                  :key="role.key"
                >
                  <div
                    :class="{
                      'opacity-50': form.role && form.role != role.key,
                    }"
                  >
                    <!-- Role Name -->
                    <div class="flex items-center">
                      <div
                        class="text-sm text-gray-600"
                        :class="{
                          'font-semibold': form.role == role.key,
                        }"
                      >
                        {{ role.name }}
                      </div>

                      <svg
                        v-if="form.role == role.key"
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
          </div>
        </template>

        <template #footer>
          <jet-success-button
            class="ml-2"
            @click.native="InviteUserModal"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Invite
          </jet-success-button>
        </template>
      </jet-dialog-modal>
      <welcome :users="users" :team="team" :projects="projects"/>
          </template>
    </jet-application-control>
  </app-layout>
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import JetApplicationControl from "@/Jetstream/ApplicationControl";
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSuccessButton from "@/Jetstream/SuccessButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

export default {
  props: ["team", "users", "availableRoles", "permissions","projects"],

  components: {
    JetApplicationControl,
    AppLayout,
    Welcome,
    JetDialogModal,
    JetSuccessButton,
    JetSecondaryButton,
    JetInput,
    JetInputError,
    JetLabel,
    JetResponsiveNavLink,
  },
  data() {
    return {
      InviteModal: false,
      SidebarSecondary: false,
      ExpanceControl: true,
      form: this.$inertia.form(
        {
          email: "",
          role: null,
        },
        {
          bag: "InviteUserModal",
        }
      ),
    };
  },
  methods: {
    InviteNewUser() {
      console.log('__________')
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
  },
};
</script>
