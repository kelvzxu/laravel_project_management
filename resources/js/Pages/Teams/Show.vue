<template>
  <app-layout>
    <app-content>
      <div class="workspace-page-component">
        <div class="workspace-header-component">
          <div class="workspace-cover-component-wrapper">
            <div
              class="workspace-cover-component"
              v-bind:style="[
                team.banner
                  ? {
                      'background-image':
                        'url(/storage/' + team.banner.url + ')',
                    }
                  : {
                      'background-image':
                        'url(/assets/img/standartbanner.jpeg)',
                    },
              ]"
              style="background-size: 100%; background-position: center center"
            ></div>
          </div>
          <div class="workspace-header">
            <div class="workspace-page-icon">
              <div class="workspace-icon-container workspace-size-xl">
                <div
                  class="workspace-icon-shape-container"
                  style="background-color: rgb(242, 121, 242)"
                >
                  <div class="workspace-icon icon">
                    <span class="letter">{{ team.name[0].toUpperCase() }}</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="workspace-header-content">
              <div class="top-row">
                <i class="fa fa-home main-workspace-icon"></i>
                <div class="workspace-name-wrapper">
                  <div class="rename-workspace-component">
                    <div
                      class="ds-editable-component rename-workspace-editable"
                      style="width: auto; height: auto"
                    >
                      <div class="ds-text-component" dir="auto">
                        <span>{{ team.name }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="workspace-description-component">
                <div>
                  <div class="board-description can-edit has-content">
                    <div
                      class="ds-editable-component"
                      style="width: auto; height: auto"
                    >
                      <div class="ds-text-component description-content">
                        <div class="description-line">
                          <span class="text-content"
                            >Use the Main Workspace to manage and collaborate on
                            all company-wide boards. All team members are in
                            this workspace.</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="workspace-header-mobile-content">
            <div class="row">
              <div class="col-12 text-center">
                <i class="fa fa-home"></i>
                <span class="font-weight-bold">{{ team.name }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-5 mt-md-4">
          <update-team-information
            :team="team"
            :permissions="permissions"
            :available-roles="availableRoles"
            :projects="projects"
          />
        </div>
        <!-- <div>
          <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <team-member-manager
              class="mt-10 sm:mt-0"
              :team="team"
              :available-roles="availableRoles"
              :user-permissions="permissions"
            />

            <template v-if="permissions.canDeleteTeam && !team.personal_team">
              <jet-section-border />

              <delete-team-form class="mt-10 sm:mt-0" :team="team" />
            </template>
          </div>
        </div> -->
      </div>
    </app-content>
  </app-layout>
</template>

<script>
import AppContent from "@/Jetstream/ApplicationContent";
import TeamMemberManager from "./TeamMemberManager";
import AppLayout from "@/Layouts/AppLayout";
import DeleteTeamForm from "./DeleteTeamForm";
import JetSectionBorder from "@/Jetstream/SectionBorder";
import UpdateTeamInformation from "./UpdateTeamInformation";

export default {
  props: ["team", "availableRoles", "permissions", "projects"],

  components: {
    AppContent,
    AppLayout,
    DeleteTeamForm,
    JetSectionBorder,
    TeamMemberManager,
    UpdateTeamInformation,
  },
  methods: {
    updateBanner() {
      const reader = new FileReader();
      reader.onload = (e) => {
        this.BannerImage = e.target.result;
      };
      reader.readAsDataURL(this.$refs.photo.files[0]);
    },
    selectBanner() {
      this.$refs.photo.click();
    },
  },
};
</script>
