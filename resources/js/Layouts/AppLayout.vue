<template>
  <div id="application" class="application with-top-reminder">
    <div class="application-layers" id="application-layers">
      <!-- with-secondary-surface-control -->
      <jet-sidebar>
        <jet-sidebar-primary>
          <div class="customization-navigation-items-area">
            <inertia-link
              :href="route('dashboard')"
              :active="route().current('dashboard')"
              class="button_link"
            >
              <div class="surface-view-icon-wrapper navigate-to-workspaces">
                <div
                  class="surface-navigation-action-item-component"
                  tabindex="0"
                  aria-label="Workspaces"
                  role="button"
                >
                  <span
                    class="navigation-action-item-icon fa fa-th-large text-whit"
                  ></span>
                </div>
                <div class="selected-view-indication"></div>
              </div>
            </inertia-link>
            <a href="/public_profile.html">
              <div class="surface-action-icon-wrapper">
                <div class="surface-notifications-component">
                  <span>
                    <div
                      class="surface-navigation-dialog-item-component"
                      tabindex="0"
                      aria-label="Notifications"
                      role="button"
                    >
                      <span
                        class="navigation-dialog-item-icon fas fa-bell text-white"
                      ></span>
                    </div>
                  </span>
                </div>
              </div>
            </a>
          </div>
          <div class="permanent-navigation-items-area">
            <inertia-link
              :href="route('user.search', $page.user.id)"
              :active="route().current('user.search', $page.user.id)"
              class="button_link"
            >
              <div class="surface-action-icon-wrapper">
                <div
                  class="surface-navigation-action-item-component"
                  tabindex="0"
                  aria-label="Search Everything"
                  role="button"
                >
                  <span
                    class="navigation-action-item-icon fas fa-search text-white"
                  ></span>
                </div>
              </div>
            </inertia-link>
            <div class="surface-action-icon-wrapper surface-help-wrapper">
              <div
                class="surface-navigation-action-item-component"
                tabindex="0"
                aria-label="Help"
                role="button"
              >
                <span
                  class="navigation-action-item-icon fas fa-question text-white"
                ></span>
              </div>
            </div>
            <div
              @click="showingProfileDialog = !showingProfileDialog"
              class="surface-avatar-menu-connector-wrapper"
            >
              <div
                id="surface-avatar-menu-component"
                class="surface-avatar-menu-component"
              >
                <div class="ds-menu-button-container">
                  <div class="avatar-photo-button-wrapper">
                    <div class="person-bullet-component wrapper">
                      <img
                        class="profile-border-component rounded-circle profile-rounded-component"
                        :src="$page.user.profile_photo_url"
                        :alt="$page.user.name"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </jet-sidebar-primary>
        <jet-sidebar-secondary style="display: none">
          <template v-for="team in $page.user.all_teams">
            <div
              class="surface-workspace-list-item"
              id="workspace_item_-1"
              :key="team.id"
            >
              <div class="workspace-icon-wrapper selected">
                <form @submit.prevent="switchToTeam(team)">
                  <jet-dropdown-link as="button">
                    <div
                      class="workspace-icon-container workspace-size-sm hover-effect"
                    >
                      <div
                        class="workspace-icon-shape-container"
                        style="background-color: rgb(0, 202, 114)"
                      >
                        <div class="workspace-icon icon">
                          <span class="letter">{{ team.name[0] }}</span>
                        </div>
                      </div>
                    </div>
                  </jet-dropdown-link>
                </form>
              </div>
              <div
                v-if="team.id == $page.user.current_team_id"
                class="selected-workspace-indication selected"
              ></div>
            </div>
          </template>
        </jet-sidebar-secondary>
      </jet-sidebar>
      <div id="workspace">
        <slot></slot>
        <!-- Modal Portal -->
        <portal-target name="modal" multiple> </portal-target>
      </div>
      <!-- Profile Dialog -->
      <div
        id="profile-dialog"
        v-show="showingProfileDialog"
        style="display: none"
        @click="showingProfileDialog = false"
      >
        <jet-profile-dialog> </jet-profile-dialog>
      </div>
    </div>
  </div>
</template>

<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import JetNavLink from "@/Jetstream/NavLink";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import JetSidebar from "@/Jetstream/Sidebar";
import JetSidebarPrimary from "@/Jetstream/SidebarPrimary";
import JetSidebarSecondary from "@/Jetstream/SidebarSecondary";
import JetProfileDialog from "@/Jetstream/ProfileDialog";

export default {
  components: {
    JetApplicationMark,
    JetDropdown,
    JetDropdownLink,
    JetNavLink,
    JetResponsiveNavLink,
    JetSidebar,
    JetSidebarPrimary,
    JetSidebarSecondary,
    JetProfileDialog,
  },

  data() {
    return {
      showingNavigationDropdown: false,
      showingProfileDialog: false,
    };
  },

  methods: {
    switchToTeam(team) {
      this.$inertia.put(
        route("current-team.update"),
        {
          team_id: team.id,
        },
        {
          preserveState: false,
        }
      );
    },
  },

  created() {
    const closeOnEscape = (e) => {
      if (this.showingProfileDialog && e.keyCode === 27) {
        this.showingProfileDialog = false;
      }
    };
  },
};
</script>
