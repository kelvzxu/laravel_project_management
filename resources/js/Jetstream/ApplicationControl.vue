<template>
  <div class="first-level" id="first-level">
    <div
      classname="first-level-expand-button-container"
      id="first-level-expand-button-container"
    ></div>

    <div class="first-level-control" id="first-level-control">
      <div class="first-level-control-component is-expanded is-pinned">
        <div class="collapse-first-level-button-component-wrapper">
          <div
            disabled=""
            class="collapse-first-leve-button-component is-pinned"
            @click="HideControl"
          >
            <span class="collapse-icon fa fa-angle-right"></span>
          </div>
        </div>
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
                            <span class="letter">{{ team.name[0] }}</span>
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
                            {{ team.name }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="home-workspace-items-content-sub-header-wrapper">
                    <div
                      v-if="userPermissions.canAddTeamMembers"
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
      </div>
      <slot></slot>
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
                @keyup.enter.native="addTeamMember"
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
  props: ["team", "users", "availableRoles", "userPermissions"],

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
          bag: "addTeamMember",
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
