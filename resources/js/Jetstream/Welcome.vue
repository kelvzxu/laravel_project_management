<template>
  <div
    class="first-level-content-wrapper first-level-control-pinned"
    id="first-level-content-wrapper"
  >
    <div
      class="first-level-content-header"
      id="first-level-content-header"
    ></div>
    <div id="board-view-ui-container"></div>
    <div
      class="first-level-content react-board"
      id="first-level-content"
      style="margin-right: 0px"
    >
      <div class="current-board-component" id="current-board-component-id">
        <div tabindex="-1" class="board-with-keyboard-navigation-component">
          <div class="board-with-keyboard-overlay"></div>
          <div id="board-wrapper-first-level-content" class="board-wrapper">
            <div>
              <div class="board-subscribers-dialog-component"></div>
              <div class="templates-creation-onboarding-dialog-component"></div>
            </div>
            <div id="board-header" class="board-header collapse-mode-enabled">
              <div class="board-header-top"></div>
              <div
                class="board-header-content-wrapper monday-board-header-content-wrapper-v2"
              >
                <div class="board-header-main">
                  <div class="board-header-top">
                    <div class="board-header-left">
                      <div class="board-name">
                        <div
                          class="ds-editable-component"
                          style="width: auto; height: auto"
                        >
                          <div class="ds-text-component" dir="auto">
                            <span>{{ team.name }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="board-header-right" id="board-header-right">
                      <div class="board-actions-v2">
                        <div
                          class="subscribers-images-component subscribers-images-component-v2"
                        >
                          <div class="subscribers-overlap-images-wrapper">
                            <div class="board-header-label">
                              <div class="label-text">Last seen</div>
                              <div class="label-labeled">
                                <div class="overlap-images-component">
                                  <div class="overlap-images-wrapper">
                                    <div
                                      class="overlap-image"
                                      style="
                                        height: 30px;
                                        width: 30px;
                                        margin: 0px;
                                      "
                                    >
                                      <img
                                        :src="$page.user.profile_photo_url"
                                        class="inner-image"
                                      />
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div
                          class="board-actions-section subscribers-list-wrapper"
                        >
                          <div class="monday-board-control">
                            <div class="monday-board-control__icon">
                              <i class="fa fa-users"></i>
                            </div>
                            <div class="monday-board-control__text">
                              Member / {{ team.users.length + 1 }}
                            </div>
                          </div>
                        </div>
                        <div class="monday-add-to-board-wrapper" @click="AddNewProject">
                          <div
                            class="monday-add-to-board-menu"
                            id="monday-add-to-board-menu-container"
                          >
                            <div class="ds-menu-button-container" @clik="">
                              <div class="monday-add-to-board-menu-button">
                                <div class="monday-board-control">
                                  <div class="monday-board-control__icon">
                                    <i class="fa fa-plus-square"></i>
                                  </div>
                                  <div class="monday-board-control__text">
                                    Add Projects
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="board-description can-edit">
                      <div
                        class="ds-editable-component"
                        style="width: auto; height: auto"
                      >
                        <div class="ds-text-component description-content">
                          <div class="description-line">
                            <span class="text-content">{{
                              team.description
                            }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="board-header-view-bar">
                  <div class="board-filter new-board-filter monday-v2-header">
                    <div class="board-subset-left-side-container"></div>
                    <div class="filter-buttons-wrapper">
                      <div
                        class="board-filter-input-container board-filter-search board-filter-input-container--expandable"
                      >
                        <span class="fa fa-search"></span>
                        <div class="board-filter-input-wrapper_v2">
                          <div class="icon-and-input-wrapper">
                            <input placeholder="Search" value="" />
                          </div>
                        </div>
                      </div>
                      <div
                        class="board-filter-item-component rule-based-filer-component"
                      >
                        <div class="board-filter-item-content-wrapper">
                          <div
                            class="board-filter-item-content rule-based-filer-component with-caret show-title-when-closed show-title-when-open"
                          >
                            <i class="item-icon fa fa-filter"></i
                            ><span class="item-title">Filter</span>
                            <div class="caret-icon-container">
                              <i class="fa fa-angle-down"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div
                        class="board-filter-item-component sort-settings-component"
                      >
                        <div class="board-filter-item-content-wrapper">
                          <div
                            class="board-filter-item-content sort-settings-component show-title-when-closed show-title-when-open"
                          >
                            <i class="item-icon fas fa-sort-alt"></i
                            ><span class="item-title">Sort</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="board-header-view-actions-wrapper">
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
                  </div>
                </div>
              </div>
            </div>
            <kanban-area>
              <kanban-box v-for="project in projects"
              :key="project.access_token"
              @click.native="viewProject(project)">
                <template #jobs><span>{{project.name}}</span></template>
                <template #tags
                  ><span class="field_tag tag_color_6"
                    ><span></span>Kelvin Leonardi</span
                  ></template
                >
              </kanban-box>
              <kanban-ghost v-for="n in 75" :key="n"></kanban-ghost>
            </kanban-area>
          </div>
        </div>
      </div>
    </div>
    <jet-dialog-modal :show="AddProjectModal" @close="AddProjectModal = false">
        <template #title> CreateProject </template>

        <template #content>

          <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="name" value="Project Name" />
              <jet-input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="CreateProject.name"
              />
              <jet-input-error :message="CreateProject.error('email')" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
              <label class="form-check-label " for="allow_timesheets"
                  >Allow Timesheets
                </label>
              <input
                  class="form-check-input ml-3"
                  type="checkbox"
                  v-model="CreateProject.allow_timesheets"
                  name="private_profile"
                  id="user_private_profile"
                />
              <jet-input-error :message="CreateProject.error('email')" class="mt-2" />
            </div>
          </div>
        </template>

        <template #footer>
          <jet-success-button
            class="ml-2"
            @click.native="CreateNewProjects"
            :class="{ 'opacity-25': CreateProject.processing }"
            :disabled="CreateProject.processing"
          >
            Create
          </jet-success-button>
        </template>
      </jet-dialog-modal>
    <div id="thumbnail-container"></div>
    <div id="video-center-button-container"></div>
    <div id="monday-only-bug-button-container"></div>
  </div>
</template>

<script>
import JetApplicationLogo from "@/Jetstream/ApplicationLogo";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSuccessButton from "@/Jetstream/SuccessButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
// Kanban Component
import KanbanArea from "@/Jetstream/KanbanArea";
import KanbanBox from "@/Jetstream/KanbanBox";
import KanbanGhost from "@/Jetstream/KanbanGhost";

export default {
  props: ["team", "users","projects"],

  components: {
    JetApplicationLogo,
    KanbanArea,
    KanbanBox,
    KanbanGhost,
    JetDialogModal,
    JetSuccessButton,
    JetSecondaryButton,
    JetInput,
    JetInputError,
    JetLabel,
  },
  data(){
    return{
      AddProjectModal:false,
      CreateProject: this.$inertia.form(
        {
          name: "",
          allow_timesheets: true,
          access_token: Math.random().toString(36).substring(7),
          sequence: Math.floor(Math.random() * 1000) + 1,
          user_id:this.users.id,
          team_id: this.users.current_team_id,
          create_uid: this.users.id,
          write_uid: this.users.id,
        },
        {
          bag: "InviteUserModal",
        }
      ),
    }
  },
  methods: {
    AddNewProject() {
      console.log('____________')
      this.CreateProject.name = "";

      this.AddProjectModal = true

      setTimeout(() => {
        this.$refs.name.focus();
      }, 250);
    },
    CreateNewProjects(){
      this.CreateProject
        .post(route("project.store"), {
          preserveScroll: true,
        })
        .then((response) => {
          this.CreateProject.access_token= Math.random().toString(36).substring(7)
          if (!this.CreateProject.hasErrors()) {
            this.AddProjectModal = false;
          }
          console.log(this.CreateProject)
        });
    }
  },
};
</script>
