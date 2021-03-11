<template>
  <jet-form @submitted="updateTeamName">
    <template #form>
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
              :disabled="!permissions.canUpdateTeam"
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
                    v-model="team.owner.name"
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
                  for="o_field_input_666"
                  data-original-title=""
                  title=""
                  >Team Type</label
                >
              </td>
              <td style="width: 100%">
                <jet-input
                  id="name1"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.name"
                  :disabled="!permissions.canUpdateTeam"
                />
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
        <div class="tab-content">
          <div
            class="tab-pane"
            :class="{ active: ViewMember == true }"
            id="notebook_page_team"
          >
            <team-member-manager
              :team="team"
              :available-roles="availableRoles"
              :user-permissions="permissions"
            />
          </div>
          <div
            class="tab-pane"
            :class="{ active: ViewProject == true }"
            id="notebook_page_project"
          >
            <team-project :team="team" :projects="projects" />
          </div>
        </div>
      </div>
    </template>

    <template #actions v-if="permissions.canUpdateTeam">
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
</template>

<script>
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetForm from "@/Jetstream/Form";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import TeamMemberManager from "./TeamMemberManager";
import TeamProject from "./TeamProjects";

export default {
  components: {
    JetActionMessage,
    JetButton,
    JetForm,
    JetInput,
    JetInputError,
    JetLabel,
    TeamMemberManager,
    TeamProject,
  },

  props: ["team", "permissions", "availableRoles", "projects"],

  data() {
    return {
      ViewMember: true,
      ViewProject: false,
      form: this.$inertia.form(
        {
          name: this.team.name,
        },
        {
          bag: "updateTeamName",
          resetOnSuccess: false,
        }
      ),
    };
  },

  methods: {
    updateTeamName() {
      this.form.put(route("teams.update", this.team), {
        preserveScroll: true,
      });
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
