<template>
  <div>
    <div id="body-row">
      <div class="sidebar-control" id="sidebar-control">
        <div class="sidebar-control-component">
          <div class="sidebar-control-primary">
            <div class="sidebar-application-logo-component-wrapper">
              <div class="sidebar-application-logo-component">
                <span class="sidebar-company-logo-image-wrapper">
                  <inertia-link :href="route('dashboard')">
                    <jet-application-mark class="sidebar-company-logo-image" />
                  </inertia-link>
                </span>
              </div>
            </div>
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
                <div class="sidebar-profile-component">
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
    </div>
    <div class="aplication-content">
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
                        <div class="workspace-icon-container workspace-size-md">
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
                                    v-if="team.id == $page.user.current_team_id"
                                  >
                                    {{ team.name }}
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
</template>

<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import JetNavLink from "@/Jetstream/NavLink";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";

export default {
  components: {
    JetApplicationMark,
    JetDropdown,
    JetDropdownLink,
    JetNavLink,
    JetResponsiveNavLink,
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
