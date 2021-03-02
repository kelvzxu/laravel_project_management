<template>
  <div class="application-content">
    <div id="application-control">
      <div class="application-control-component is-expanded">
        <div class="application-control-button-component-wrap">
          <div
            disabled=""
            class="application-control-button-component is-pinned"
            @click="HideControl"
          >
            <span class="collapse-icon fa fa-angle-right"></span>
          </div>
        </div>
        <div class="first-level-control-content">
          <div class="home-control-component">
            <div class="home-workspace-items-component">
              <div class="content-wrapper">
                <div class="home-workspace-items-title-component">
                  <div
                    class="home-control-top-header-component home-workspace-items-header without-dropdown-navigation"
                  >
                    <div class="workspace-title">
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
                      <div class="workspace-name-wrapper">
                        <div
                          class="ds-editable-component workspace-name"
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
                  <div class="home-workspace-items-content-sub-header-wrapper">
                    <div class="new-boards-list-button-component">
                      <div class="top-new-button-component default-icon">
                        <div
                          class="new-boards-list-button add_new_board_btn leftpane-workspace-header-redesign"
                        >
                          <i class="fa fa-plus-circle" aria-hidden="true"></i
                          ><span class="ml-1"> Add</span>
                        </div>
                      </div>
                    </div>
                    <div
                      class="boards-list-header-component selected leftpane-workspace-header-redesign"
                    >
                      <div class="boards-filter-row-wrapper">
                        <div class="boards-list-filter-button-component">
                          <i class="fa fa-filter" aria-hidden="true"></i
                          ><span class="ml-1"> Filters</span>
                        </div>
                      </div>
                      <div
                        class="unified-boards-search-input-wrapper empty mt-2"
                      >
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
                  <div class="spacer"></div>
                </div>
              </div>
              <div class="home-workspace-items-content-wrapper">
                <div
                  class="home-control-unified-boards-list-component selected"
                >
                  <div
                    tabindex="-1"
                    class="with-keyboard-navigation-enhancer home-control-unified-boards-virtualized-list-wrapper"
                  >
                    <div
                      class="draggable-virtual-list home-control-unified-boards-virtualized-list"
                    >
                      <div class="scrolling-component">
                        <div class="virtual-list-component">
                          <div
                            id="virtual-list-scrollable-container"
                            class="virtual-list-scrollable-container"
                          >
                            <div
                              aria-label="grid"
                              aria-readonly="true"
                              role="grid"
                              tabindex="0"
                              style="
                                box-sizing: border-box;
                                direction: ltr;
                                height: auto;
                                position: relative;
                                width: 255px;
                                will-change: transform;
                                overflow: hidden;
                              "
                            >
                              <div
                                role="rowgroup"
                                style="
                                  width: auto;
                                  height: 304px;
                                  max-width: 255px;
                                  max-height: 304px;
                                  overflow: hidden;
                                  position: relative;
                                "
                              >
                                <div
                                  id="id-6ccefcf2-3857-1064-eeb9-eb74d3f6200a_940000411"
                                  style="
                                    height: 34px;
                                    left: 0px;
                                    position: absolute;
                                    top: 0px;
                                    width: 100%;
                                  "
                                >
                                  <div
                                    class="home-control-unified-board-item-wrapper border border-public unified-virtualized-boards-list-item"
                                  >
                                    <div
                                      class="home-control-unified-board-item-component-wrapper"
                                    >
                                      <div
                                        class="right-click-menu-component"
                                        @click="ChangeTeam"
                                      >
                                        <div
                                          class="home-control-board-item-component public selected"
                                        >
                                          <div
                                            id="board_item_940000411"
                                            class="board-name-wrapper"
                                          >
                                            <div class="fas fa-exchange-alt">
                                              <span
                                                class="board-kind-icon-component home-list-icon public icon icon-board-new"
                                              ></span>
                                            </div>
                                            <div
                                              class="ds-editable-component board-name"
                                              style="width: auto; height: auto"
                                            >
                                              <div class="home-item-content">
                                                <div
                                                  class="ds-text-component board-item-name"
                                                  dir="auto"
                                                >
                                                  <div
                                                    dir="auto"
                                                    class="text-with-highlights ml-1"
                                                  >
                                                    <em></em
                                                    ><span> Change Team</span>
                                                  </div>
                                                </div>
                                                <div
                                                  class="home-item-menu-wrapper"
                                                >
                                                  <div
                                                    class="ds-menu-button-container"
                                                  >
                                                    <div
                                                      class="ds-menu-button ds-menu-button-md null"
                                                      style="
                                                        background-color: transparent;
                                                      "
                                                    >
                                                      <i
                                                        class="icon ellipsis icon-v2-ellipsis"
                                                      ></i>
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
                                <div
                                  id="id-6ccefcf2-3857-1064-eeb9-eb74d3f6200a_leftpane_footer"
                                  style="
                                    height: 270px;
                                    left: 0px;
                                    position: absolute;
                                    top: 34px;
                                    width: 100%;
                                  "
                                >
                                  <div
                                    class="home-control-unified-boards-list-footer-wrapper unified-virtualized-boards-list-item"
                                  >
                                    <div
                                      class="home-control-leftpane-footer-component"
                                    ></div>
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
  data() {
    return {
      SidebarSecondary: false,
      ExpanceControl: true,
    };
  },
  methods: {
    ChangeTeam() {
      if (this.SidebarSecondary == false) {
        this.AddSidebar();
        this.SidebarSecondary = true;
      } else {
        this.RemoveSidebar();
        this.SidebarSecondary = false;
      }
    },
    HideControl() {
      if (this.ExpanceControl == true) {
        this.control = document.querySelector(
          "div.application-control-component"
        );
        this.control.classList.remove("is-expanded");
        this.ExpanceControl = false;
      } else {
        this.control = document.querySelector(
          "div.application-control-component"
        );
        this.control.classList.add("is-expanded");
        this.ExpanceControl = true;
      }
    },
    AddSidebar() {
      this.workspace = document.querySelector("div.application-layers");
      this.workspace.classList.add("with-secondary-surface-control");
      this.sidebar_secondary = document.querySelector(
        "div.sidebar-control-secondary"
      );
      this.sidebar_secondary.style.display = "block";
    },
    RemoveSidebar() {
      this.sidebar_secondary = document.querySelector(
        "div.sidebar-control-secondary"
      );
      this.sidebar_secondary.style.display = "none";
      this.workspace = document.querySelector("div.application-layers");
      this.workspace.classList.remove("with-secondary-surface-control");
    },
  },
};
</script>
