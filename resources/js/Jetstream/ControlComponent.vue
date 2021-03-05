<template>
  <div class="first-level-control-content">
        <div class="home-control-component">
        <div class="home-workspace-items-component">
            <div class="title-wrapper">
            <div class="home-workspace-items-title-component">
                <div
                class="home-control-top-header-component home-workspace-items-header without-dropdown-navigation"
                >
                <div class="workspace-title">
                    <div class="workspace-icon-container workspace-size-md">
                    <div
                        class="workspace-icon-shape-container"
                        style="background-color: rgb(0, 202, 114)"
                    >
                        <div class="workspace-icon icon">
                        <span class="letter">
                          <slot name="workspace_icon"></slot>
                        </span>
                        </div>
                    </div>
                    <div
                        class="workspace-permission-icon-wrapper main-workspace-icon-wrapper"
                    >
                        <div
                        class="workspace-permission-icon-inner main-workspace-icon-inner"
                        >
                        <i class="fa fa-home workspace-permission-icon"></i>
                        </div>
                    </div>
                    </div>
                    <div class="workspace-name-wrapper">
                    <div
                        class="ds-editable-component workspace-name"
                        style="width: auto; height: auto"
                    >
                        <div class="ds-text-component" dir="auto">
                        <slot name="workspace_name"></slot>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <slot name="workspace_sub_header"></slot>
                <div class="spacer"></div>
            </div>
            </div>
            <div class="home-workspace-items-content-wrapper">
              <div
                  class="home-control-unified-boards-list-component selected"
              >
                  <div
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
                                                  class="text-with-highlights"
                                                  >
                                                  <em></em
                                                  ><span>Change Team</span>
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
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSuccessButton from "@/Jetstream/SuccessButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

export default {

  components: {
    JetResponsiveNavLink,
    JetDialogModal,
    JetSuccessButton,
    JetSecondaryButton,
    JetInput,
    JetInputError,
    JetLabel,
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
          "div.first-level-control-component"
        );
        this.control.classList.remove("is-expanded");
        this.ChangeWrapper();
        this.ExpanceControl = false;
      } else {
        this.control = document.querySelector(
          "div.first-level-control-component"
        );
        this.control.classList.add("is-expanded");
        this.RestoreWrapper();
        this.ExpanceControl = true;
      }
    },
    ChangeWrapper() {
      this.wrapper = document.querySelector("div#first-level-content-wrapper");
      this.wrapper.classList.add("first-level-control-unpinned");
      this.wrapper.classList.remove("first-level-control-pinned");
    },
    RestoreWrapper() {
      this.wrapper = document.querySelector("div#first-level-content-wrapper");
      this.wrapper.classList.add("first-level-control-pinned");
      this.wrapper.classList.remove("first-level-control-unpinned");
    },
    AddSidebar() {
      this.workspace = document.querySelector("div.application-layers");
      this.workspace.classList.add("with-secondary-surface-control");
      this.sidebar_secondary = document.querySelector(
        "div.surface-control-secondary"
      );
      this.sidebar_secondary.style.display = "block";
    },
    RemoveSidebar() {
      this.sidebar_secondary = document.querySelector(
        "div.surface-control-secondary"
      );
      this.sidebar_secondary.style.display = "none";
      this.workspace = document.querySelector("div.application-layers");
      this.workspace.classList.remove("with-secondary-surface-control");
    },
  },
};
</script>
