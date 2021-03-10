<template>
  <app-layout>
    <jet-application-control :users="users" :team="team">
      <template #workspace_icon>{{ project.name[0] }}</template>
      <template #workspace_name>{{ project.name }}</template>
      <template #workspace_sub_header>
        <div class="home-workspace-items-content-sub-header-wrapper">
          <div class="new-boards-list-button-component">
            <jet-responsive-nav-link
              :href="route('project.show', project.access_token)"
              :active="route().current('teams.show')"
            >
              <div class="ds-menu-button-container">
                <div>
                  <div class="top-new-button-component default-icon">
                    <div
                      class="new-boards-list-button add_new_board_btn leftpane-workspace-header-redesign"
                    >
                      <i class="fa fa-th-large main-icon"></i>Kanban Board
                    </div>
                  </div>
                </div>
              </div>
            </jet-responsive-nav-link>
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
                  <i class="far fa-stopwatch main-icon"></i
                  ><span class="filters-text">Timesheet</span>
                </div>
              </div>
            </jet-responsive-nav-link>
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
                  <i class="fas fa-file-chart-line main-icon"></i
                  ><span class="filters-text">Project Report</span>
                </div>
              </div>
            </jet-responsive-nav-link>
          </div>
          <div
            class="boards-list-header-component selected leftpane-workspace-header-redesign bg-light"
          >
            <jet-responsive-nav-link
              :href="route('stage.show', project.access_token)"
              :active="route().current('stage.view')"
            >
              <div class="boards-filter-row-wrapper">
                <div class="boards-list-filter-button-component">
                  <i class="far fa-layer-group main-icon"></i
                  ><span class="filters-text">Project Stage</span>
                </div>
              </div>
            </jet-responsive-nav-link>
          </div>
          <div
            class="boards-list-header-component selected leftpane-workspace-header-redesign"
          >
            <jet-responsive-nav-link
              :href="route('project.detail', project.access_token)"
              :active="route().current('project.detail')"
            >
              <div class="boards-filter-row-wrapper">
                <div class="boards-list-filter-button-component">
                  <i class="fa fa-cog main-icon"></i
                  ><span class="filters-text">Project Details</span>
                </div>
              </div>
            </jet-responsive-nav-link>
          </div>
        </div>
      </template>
      <template #main_content>
        <jet-dialog-modal :show="AddNewStage" @close="AddNewStage = false">
          <template #title> New Stage </template>

          <template #content>
            <div class="mt-4">
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Stage Name" />
                <jet-input
                  id="name"
                  type="text"
                  ref="name"
                  class="mt-1 block w-full"
                  v-model="form.name"
                />
                <jet-input-error :message="form.error('name')" class="mt-2" />
              </div>
              <div class="col-span-6 sm:col-span-4 mt-2">
                <jet-label for="sequence" value="Stage sequence" />
                <jet-input
                  id="sequence"
                  type="text"
                  ref="sequence"
                  required
                  class="mt-1 block w-full"
                  v-model="form.sequence"
                />
                <jet-input-error :message="form.error('name')" class="mt-2" />
              </div>
              <div class="col-span-6 sm:col-span-4 mt-1">
                <label class="form-check-label" for="is_closed"
                  >Closing State
                </label>
                <input
                  class="form-check-input ml-3"
                  type="checkbox"
                  v-model="form.is_closed"
                  name="is_closed"
                  id="is_closed"
                />
                <jet-input-error
                  :message="form.error('is_closed')"
                  class="mt-2"
                />
              </div>
            </div>
          </template>

          <template #footer>
            <jet-success-button
              class="ml-2"
              @click.native="CreateNewStages"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Create
            </jet-success-button>
          </template>
        </jet-dialog-modal>
        <jet-content-wrapper
          :users="users"
          :team="team"
          :projects="project"
          class="project_view"
        >
          <template #board_name>{{ project.name }}</template>
          <template #board_description>{{ project.description }}</template>
          <template #board_subs_images_label>Manager </template>
          <template #board_subs_images>
            <img :src="project.manager.profile_photo_url" class="inner-image" />
          </template>
          <template #board_button>
            <div class="monday-add-to-board-wrapper" @click="AddStage">
              <div
                class="monday-add-to-board-menu"
                id="monday-add-to-board-menu-container"
              >
                <div class="ds-menu-button-container">
                  <div class="monday-add-to-board-menu-button">
                    <div class="monday-board-control">
                      <div class="monday-board-control__icon">
                        <i class="fa fa-plus-square"></i>
                      </div>
                      <div class="monday-board-control__text">Add Stage</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </template>
          <template #board_button_group>
            <jet-board-search
              ><input placeholder="Search" value=""
            /></jet-board-search>
            <jet-board-filter-dropdown @click.native="FilterData" />
            <jet-board-sorting />
          </template>
          <template #board_component>
            <table-responsive>
              <template #header>
                <tr>
                  <th
                    class="o_handle_cell o_column_sortable o_list_number_th"
                    style="min-width: 33px; width: 33px"
                  ></th>
                  <th style="width: 171px">Stage Name</th>
                  <th style="width: 190px">Projects</th>
                  <th style="width: 190px">Closing State</th>
                </tr>
              </template>
              <template #content>
                <tr
                  class="data_row"
                  v-for="(task, i) in project.task_type"
                  :key="i"
                >
                  <td class="text-center">{{ i + 1 }}</td>
                  <td>{{ task.name }}</td>
                  <td>{{ project.name }}</td>
                  <td>{{ task.is_closed }}</td>
                </tr>
              </template>
            </table-responsive>
          </template>
        </jet-content-wrapper>
      </template>
    </jet-application-control>
  </app-layout>
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import JetApplicationControl from "@/Jetstream/ApplicationControl";
import AppLayout from "@/Layouts/AppLayout";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSuccessButton from "@/Jetstream/SuccessButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
// Workspace Component
import JetContentWrapper from "@/Jetstream/ContentWrapper";
import JetBoardSorting from "@/Jetstream/BoardSorting";
import JetBoardSearch from "@/Jetstream/BoardSearch";
import JetBoardDropdown from "@/Jetstream/BoardDropdown";
import JetBoardFilterDropdown from "@/Jetstream/BoardFilterDropdown";
// List Component
import TableResponsive from "@/Jetstream/TableResponsive";

// Module
import draggable from "vuedraggable";

export default {
  props: ["team", "users", "project"],

  components: {
    AppLayout,
    JetContentWrapper,
    JetApplicationControl,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetLabel,
    JetResponsiveNavLink,
    JetSuccessButton,
    JetSecondaryButton,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    draggable,
    TableResponsive,
  },
  data() {
    return {
      InviteModal: false,
      SidebarSecondary: false,
      ExpanceControl: true,
      AddNewStage: false,
      form: this.$inertia.form(
        {
          name: "",
          active: true,
          project_id: this.project.id,
          is_closed: false,
          create_uid: this.users.id,
          write_uid: this.users.id,
          sequence: "",
        },
        {
          bag: "CreateStage",
        }
      ),
    };
  },
  created() {
    console.log(this);
  },
  methods: {
    InviteNewUser() {
      this.form.email = "";

      this.InviteModal = true;

      setTimeout(() => {
        this.$refs.email.focus();
      }, 250);
    },
    AddStage() {
      this.form.name = "";

      this.AddNewStage = true;

      setTimeout(() => {
        this.$refs.name.focus();
      }, 250);
    },
    CreateNewStages() {
      this.form
        .post(route("stage.store"), {
          preserveScroll: true,
        })
        .then((response) => {
          this.form.access_token = Math.random().toString(36).substring(7);
          if (!this.form.hasErrors()) {
            this.AddNewStage = false;
          }
          console.log(this.form);
        });
    },
    viewProject(row) {
      this.$inertia.visit(route("project.show", row.id));
    },
    onAdd(event, stage) {
      this.TaskUpdate.id = event.item.getAttribute("data-id");
      this.TaskUpdate.stage_id = stage;
      this.TaskUpdate.post(route("task_stage.update"), {
        preserveScroll: true,
      });
    },
  },
};
</script>
