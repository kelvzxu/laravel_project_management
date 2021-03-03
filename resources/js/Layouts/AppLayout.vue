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
          <template v-for="team in $page.user.all_teams" >
            <!-- <div class="flex items-center">
                  <div>{{ team.name }}</div>
                </div> -->
            <div class="surface-workspace-list-item" id="workspace_item_-1">
              <div class="workspace-icon-wrapper selected">
                <form @submit.prevent="switchToTeam(team)" :key="team.id">
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
        <jet-profile-dialog>
          <div
            class="ds-menu-section menu-section-as-wrapper menu-section-body"
          >
            <div class="ds-menu-column">
              <div class="ds-menu-section">
                <div class="ds-menu-section-title">Account</div>
                <jet-responsive-nav-link
                  :href="route('profile.show')"
                  :active="route().current('profile.show')"
                >
                  <div class="ds-menu-item">
                    <div class="ds-icon"><i class="far fa-user"></i></div>
                    <span class="ds-title">My profile</span>
                  </div>
                </jet-responsive-nav-link>
                <jet-responsive-nav-link
                  :href="route('profile.show')"
                  :active="route().current('profile.show')"
                >
                  <div class="ds-menu-item">
                    <div class="ds-icon"><i class="fal fa-download"></i></div>
                    <span class="ds-title">Import data</span>
                  </div>
                </jet-responsive-nav-link>
                <jet-responsive-nav-link
                  :href="route('api-tokens.index')"
                  :active="route().current('api-tokens.index')"
                >
                  <div class="ds-menu-item">
                    <div class="ds-icon"><i class="fa fa-code"></i></div>
                    <span class="ds-title">Developers</span>
                  </div>
                </jet-responsive-nav-link>

                <a href="/recycle_bin" class="button_link">
                  <div class="ds-menu-item">
                    <div class="ds-icon"><i class="far fa-trash"></i></div>
                    <span class="ds-title">Recycle bin</span>
                  </div> </a
                ><a href="/archived_boards" class="button_link">
                  <div class="ds-menu-item">
                    <div class="ds-icon"><i class="fal fa-archive"></i></div>
                    <span class="ds-title">Archived boards</span>
                  </div>
                </a>
                <jet-responsive-nav-link
                  :href="route('team.myteam')"
                  :active="route().current('team.myteam')"
                >
                  <div class="ds-menu-item">
                    <div class="ds-icon"><i class="fa fa-code"></i></div>
                    <span class="ds-title">teams</span>
                  </div>
                </jet-responsive-nav-link>
                <div class="ds-menu-item">
                  <div class="ds-icon"><i class="fal fa-lock-alt"></i></div>
                  <span class="ds-title">Security</span>
                </div>
              </div>
            </div>
            <div class="ds-menu-column menu-section-short-divider">
              <div class="ds-menu-section">
                <div class="ds-menu-section-title">Explore</div>
                <div class="ds-menu-item">
                  <div class="ds-icon"><i class="icon icon-present"></i></div>
                  <span class="ds-title">
                    <div class="whats-new-title-wrapper">
                      <span class="whats-new-title">What's new</span>
                      <div class="whats-new-title-dot"></div>
                    </div>
                  </span>
                </div>
                <div class="ds-menu-item">
                  <div class="ds-icon">
                    <i class="icon icon-dapulse-keyboard-no-keys"></i>
                  </div>
                  <span class="ds-title">Shortcuts</span>
                </div>
                <div class="ds-menu-item">
                  <div class="ds-icon"><i class="far fa-user-plus"></i></div>
                  <span class="ds-title">Invite members</span>
                </div>
                <div class="ds-menu-item">
                  <div class="ds-icon"><i class="fal fa-headset"></i></div>
                  <span class="ds-title">Contact sales</span>
                </div>
              </div>
              <div class="new-upgrade-button-container" submenuindex="0">
                <button
                  type="button"
                  class="new-upgrade-button monday-style-button monday-style-button--size-md monday-style-button--kind-primary monday-style-button--color-positive"
                  name=""
                  id=""
                  aria-labelledby=""
                  aria-label=""
                  aria-busy="false"
                  style="--element-width: 159.797px; --element-height: 40px"
                >
                  <span
                    class="icon_component monday-style-button--left-icon icon_component--no-focus-style fa icon-upgrade-stars-new"
                    aria-label=""
                    tabindex="-1"
                    role=""
                  ></span
                  >Upgrade
                </button>
              </div>
            </div>
          </div>
        </jet-profile-dialog>
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
        console.log(this.showingProfileDialog);
      }
    };
  },
};
</script>
