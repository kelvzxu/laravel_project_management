<template>
  <div class="application">
    <div class="application-layers with-secondary-surface-control">
      <jet-sidebar>
        <jet-sidebar-primary>
          <div class="sidebar-navigation-items">
            <div class="sidebar-icon-wrapper">
              <div class="sidebar-navigation-action-component">
                <span class="fa fa-th-large text-white"> </span>
              </div>
            </div>
            <div class="sidebar-icon-wrapper">
              <div class="sidebar-navigation-action-component">
                <span class="fas fa-bell text-white"> </span>
              </div>
            </div>
            <div class="sidebar-icon-wrapper">
              <div class="sidebar-navigation-action-component">
                <span class="fas fa-download text-white"> </span>
              </div>
            </div>
          </div>
          <div class="primary-navigation-items-area">
            <div class="sidebar-icon-wrapper" id="action-search">
              <div class="sidebar-navigation-action-component">
                <span class="fas fa-search text-white"> </span>
              </div>
            </div>
            <div class="sidebar-icon-wrapper" id="action-help">
              <div class="sidebar-navigation-action-component">
                <span class="fas fa-question text-white"> </span>
              </div>
            </div>
            <div class="sidebar-profile-menu-wrapper">
              <button
                v-if="$page.jetstream.managesProfilePhotos"
                class="sidebar-profile-component"
              >
                <img
                  class="profile-border-component rounded-circle profile-rounded-component"
                  :src="$page.user.profile_photo_url"
                  :alt="$page.user.name"
                />
              </button>
              <button v-else class="sidebar-profile-component">
                <div>{{ $page.user.name }}</div>

                <div class="ml-1">
                  <svg
                    class="fill-current h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"
                    />
                  </svg>
                </div>
              </button>
            </div>
          </div>
        </jet-sidebar-primary>
        <jet-sidebar-secondary>
          <template v-for="team in $page.user.all_teams">
            <form @submit.prevent="switchToTeam(team)" :key="team.id">
              <jet-dropdown-link as="button">
                <!-- <div class="flex items-center">
                  <div>{{ team.name }}</div>
                </div> -->
                <div class="surface-workspace-list-item" id="workspace_item_-1">
                  <div class="workspace-icon-wrapper selected">
                    <div
                      class="workspace-icon-container workspace-size-sm hover-effect"
                    >
                      <div
                        class="workspace-icon-shape-container"
                        style="background-color: rgb(242, 121, 242)"
                      >
                        <div class="workspace-icon icon">
                          <span class="letter">{{ team.name[0] }}</span>
                        </div>
                      </div>
                      <div
                        v-if="team.id == $page.user.current_team_id"
                        class="workspace-permission-icon-wrapper main-workspace-icon-wrapper"
                      >
                        <div
                          class="workspace-permission-icon-inner main-workspace-icon-inner"
                        >
                          <i
                            class="fas fa-crown workspace-permission-icon main-workspace-icon"
                          ></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    v-if="team.id == $page.user.current_team_id"
                    class="selected-workspace-indication selected"
                  ></div>
                  <div v-else class="selected-workspace-indication"></div>
                </div>
              </jet-dropdown-link>
            </form>
          </template>
        </jet-sidebar-secondary>
      </jet-sidebar>
      <div class="application-content">
        <div id="application-control">
          <div class="application-control-component is-expanded">
            <div class="application-control-button-component-wrap">
              <div
                disabled=""
                class="application-control-button-component is-pinned"
              >
                <span class="collapse-icon fa fa-angle-right"></span>
              </div>
            </div>
            <div class="first-level-control-content">
              <div class="home-control-component">
                <div class="home-workspace-items-component">
                  <div class="content-wrapper">
                    <div class="home-workspace-items-title-component">
                      <div class="home-workspace-items-header">
                        <div class="workspace-content">
                          <div
                            class="workspace-icon-container workspace-size-md"
                          >
                            <div
                              class="workspace-icon-shape-container"
                              style="background-color: rgb(242, 121, 242)"
                            >
                              <div class="workspace-icon icon">
                                <span class="letter">M</span>
                              </div>
                            </div>
                          </div>
                          <div class="workspace-item-name-wrapper">
                            <div
                              class="ds-editable-component workspace-item-name"
                              style="width: auto; height: auto"
                            >
                              <div class="ds-text-component" dir="auto">
                                <!-- <span>Main workspace</span> -->
                                <template v-for="team in $page.user.all_teams">
                                  <form
                                    @submit.prevent="switchToTeam(team)"
                                    :key="team.id"
                                  >
                                    <span
                                      v-if="
                                        team.id == $page.user.current_team_id
                                      "
                                    >
                                      <jet-responsive-nav-link
                                        :href="
                                          route(
                                            'teams.show',
                                            $page.user.current_team
                                          )
                                        "
                                        :active="route().current('teams.show')"
                                      >
                                        {{ team.name }}
                                      </jet-responsive-nav-link>
                                    </span>
                                  </form>
                                </template>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="application-content-wrapper first-level-control-pinned">
          <div
            class="first-level-content"
            id="first-level-content"
            style="margin-right: 0px"
          >
            <slot></slot>
          </div>
          <div class="livechat-button">
            <span class="far fa-comments fa-2x text-center"> </span>
          </div>
        </div>
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
  },

  data() {
    return {
      showingNavigationDropdown: false,
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

    logout() {
      axios.post(route("logout").url()).then((response) => {
        window.location = "/";
      });
    },
  },
};
</script>
