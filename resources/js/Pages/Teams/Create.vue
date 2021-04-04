<template>
  <app-layout>
    <app-content>
      <jet-form @submitted="createTeam">
        <template #form>
          <div class="workspace-page-component">
            <div class="workspace-header-component">
              <div class="workspace-cover-component-wrapper">
                <div
                  class="workspace-cover-component"
                  v-bind:style="[
                    BannerImage
                      ? {
                          'background-image': 'url(\'' + BannerImage + '\')',
                        }
                      : {
                          'background-image':
                            'url(/assets/img/standartbanner.jpeg)',
                        },
                  ]"
                  style="
                    background-size: 100%;
                    background-position: center center;
                  "
                >
                  <div class="add-cover-button-component-wrapper">
                    <div class="add-cover-button-component">
                      <input
                        type="file"
                        class="hidden"
                        ref="photo"
                        @change="updateBanner"
                      />
                      <div
                        class="add-cover-button"
                        @click.prevent="selectBanner"
                      >
                        + Add cover
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="workspace-header">
                <div class="workspace-page-icon">
                  <div class="workspace-icon-container workspace-size-xl">
                    <div
                      class="workspace-icon-shape-container"
                      style="background-color: rgb(242, 121, 242)"
                    >
                      <div class="workspace-icon icon">
                        <span class="letter"></span>
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
                            <span></span>
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
                                >Use the Main Workspace to manage and
                                collaborate on all company-wide boards. All team
                                members are in this workspace.</span
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
                    <span class="font-weight-bold"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-5 mt-md-4">
              <div class="oe_title">
                <div class="col-12">
                  <label
                    class="o_form_label oe_edit_only"
                    for="o_field_input_663"
                    data-original-title=""
                    title=""
                    >Team Name</label
                  >
                  <h1>
                    <jet-input
                      id="name"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.name"
                    />
                  </h1>
                </div>
              </div>
              <div class="o_group">
                <table class="o_group o_inner_group col-12 col-md-5">
                  <tbody>
                    <tr>
                      <td class="o_td_label">
                        <label
                          class="o_form_label"
                          for="o_field_input_665"
                          data-original-title=""
                          title=""
                          >Leader</label
                        >
                      </td>
                      <td style="width: 100%">
                        <div class="o_input_dropdown">
                          <jet-input
                            id="name2"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="$page.user.name"
                            disabled
                          />
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table class="o_group o_inner_group col-12 col-md-5">
                  <tbody>
                    <tr>
                      <td class="o_td_label">
                        <label
                          class="o_form_label"
                          for="o_field_input_665"
                          data-original-title=""
                          title=""
                          >Team Type</label
                        >
                      </td>
                      <td style="width: 100%">
                        <div class="o_input_dropdown">
                          <select
                            v-model="form.team_type"
                            class="mt-1 block w-full"
                          >
                            <option
                              v-for="row in team_types"
                              :select="row.id == form.team_type"
                              :key="row.id"
                              :value="row.id"
                            >
                              {{ row.name }}
                            </option>
                          </select>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="o_notebook" data-name="_default_">
                <div class="o_notebook_headers">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a
                        data-toggle="tab"
                        disable_anchor="true"
                        class="nav-link"
                        :class="{ active: ViewMember == true }"
                        role="tab"
                        @click="TeamMember"
                        >Team Members</a
                      >
                    </li>
                    <li class="nav-item">
                      <a
                        data-toggle="tab"
                        disable_anchor="true"
                        class="nav-link"
                        :class="{ active: ViewProject == true }"
                        role="tab"
                        @click="TeamProject"
                        >Team Project</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </template>
        <template #actions>
          <jet-action-message :on="form.recentlySuccessful" class="mr-3">
            Saved.
          </jet-action-message>

          <jet-button
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Save
          </jet-button>
        </template>
      </jet-form>
    </app-content>
  </app-layout>
</template>

<script>
// Application Component
import AppContent from "@/Jetstream/ApplicationContent";
import AppLayout from "@/Layouts/AppLayout";
import JetSectionBorder from "@/Jetstream/SectionBorder";

// Form Component
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetForm from "@/Jetstream/Form";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

// Another Page
import TeamMemberManager from "./TeamMemberManager";
import UpdateTeamInformation from "./UpdateTeamInformation";

export default {
  props: ["team"],

  components: {
    AppContent,
    AppLayout,
    JetSectionBorder,
    TeamMemberManager,
    UpdateTeamInformation,
    JetActionMessage,
    JetButton,
    JetForm,
    JetInput,
    JetInputError,
    JetLabel,
  },
  data() {
    let team_type = [
      { id: "public", name: "Public" },
      { id: "private", name: "Private" },
    ];

    return {
      team_types: team_type,
      ViewMember: true,
      ViewProject: false,
      BannerImage: null,
      form: this.$inertia.form(
        {
          user_id: this.$page.user.id,
          name: "",
          attachment: "",
          access_token: "",
          team_type: "private",
          // owner: this.user.name,
        },
        {
          bag: "createTeam",
          resetOnSuccess: false,
        }
      ),
      StoreBanner: this.$inertia.form({
        name: "image_1920",
        description: "Image Banner Team",
        res_model: "teams.table",
        res_field: "banner_image_id",
        type: "",
        url: "",
        size: "",
      }),
    };
  },
  methods: {
    createTeam() {
      if (this.$refs.photo.files[0]) {
        this.StoreBanner.url = this.$refs.photo.files[0].name;
        this.StoreBanner.type = this.$refs.photo.files[0].type;
        this.StoreBanner.size = this.$refs.photo.files[0].size;
        this.StoreBanner.file = this.$refs.photo.files[0];
        this.form.attachment = this.StoreBanner;
      }
      this.form.post(route("teams.store"), {
        preserveScroll: true,
      });
    },
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
    TeamMember() {
      this.ViewMember = true;
      this.ViewProject = false;
    },
    TeamProject() {
      this.ViewMember = false;
      this.ViewProject = true;
    },
  },
};
</script>

