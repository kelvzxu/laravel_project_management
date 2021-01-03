<template>
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
                            <template v-for="team in $page.user.all_teams">
                              <form
                                @submit.prevent="switchToTeam(team)"
                                :key="team.id"
                              >
                                <span
                                  v-if="team.id == $page.user.current_team_id"
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
    <div class="application-content-wrapper application-control-pinned">
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
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";

export default {
  components: {
    JetResponsiveNavLink,
  },
};
</script>
