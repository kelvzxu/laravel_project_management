<template>
  <div>
    <div v-if="userPermissions.canAddTeamMembers">
      <button
        type="button"
        class="btn btn-secondary ml-2 ml-md-5 mt-2"
        @click="InviteNewUser"
      >
        Add Member
      </button>
    </div>

    <div class="space-y-6">
      <div
        class="flex items-center justify-between"
        v-for="user in team.users"
        :key="user.id"
      >
        <div class="flex items-center">
          <img
            class="w-8 h-8 rounded-full"
            :src="user.profile_photo_url"
            :alt="user.name"
          />
          <div class="ml-4">{{ user.name }}</div>
        </div>

        <div class="flex items-center">
          <button
            class="ml-2 text-sm text-gray-400 underline"
            v-if="userPermissions.canAddTeamMembers && availableRoles.length"
            @click="manageRole(user)"
          >
            {{ displayableRole(user.membership.role) }}
          </button>

          <div
            class="ml-2 text-sm text-gray-400"
            v-else-if="availableRoles.length"
          >
            {{ displayableRole(user.membership.role) }}
          </div>

          <button
            class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none"
            @click="confirmLeavingTeam"
            v-if="$page.user.id === user.id"
          >
            Leave
          </button>

          <button
            class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none"
            @click="confirmTeamMemberRemoval(user)"
            v-if="userPermissions.canRemoveTeamMembers"
          >
            Remove
          </button>
        </div>
      </div>
    </div>

    <!-- Invite Member Modal -->
    <jet-dialog-modal :show="InviteModal" @close="InviteModal = false">
      <template #title> Add Team Member </template>

      <template #content>
        <div class="col-span-6">
          <div class="max-w-xl text-sm text-gray-600">
            Please provide the email address of the person you would like to add
            to this team. The email address must be associated with an existing
            account.
          </div>
        </div>

        <div class="col-span-6 sm:col-span-4">
          <jet-label for="email" value="Email" />
          <jet-input
            id="email"
            type="text"
            class="mt-1 block w-full"
            ref="email"
            v-model="addTeamMemberForm.email"
          />
          <jet-input-error
            :message="addTeamMemberForm.error('email')"
            class="mt-2"
          />
        </div>

        <div
          class="col-span-6 lg:col-span-4 mt-4"
          v-if="availableRoles.length > 0"
        >
          <jet-label for="roles" value="Role" />
          <jet-input-error
            :message="addTeamMemberForm.error('role')"
            class="mt-2"
          />

          <div class="mt-1 border border-gray-200 rounded-lg cursor-pointer">
            <div
              class="px-4 py-3"
              :class="{ 'border-t border-gray-200': i > 0 }"
              @click="addTeamMemberForm.role = role.key"
              v-for="(role, i) in availableRoles"
              :key="role.key"
            >
              <div
                :class="{
                  'opacity-50':
                    addTeamMemberForm.role &&
                    addTeamMemberForm.role != role.key,
                }"
              >
                <div class="flex items-center">
                  <div
                    class="text-sm text-gray-600"
                    :class="{
                      'font-semibold': addTeamMemberForm.role == role.key,
                    }"
                  >
                    {{ role.name }}
                  </div>

                  <svg
                    v-if="addTeamMemberForm.role == role.key"
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
      </template>

      <template #footer>
        <jet-action-message
          :on="addTeamMemberForm.recentlySuccessful"
          class="mr-3"
        >
          Added.
        </jet-action-message>

        <jet-button
          :class="{ 'opacity-25': addTeamMemberForm.processing }"
          :disabled="addTeamMemberForm.processing"
          @click.native="addTeamMember"
        >
          Add
        </jet-button>
      </template>
    </jet-dialog-modal>
    
    <!-- Role Management Modal -->
    <jet-dialog-modal
      :show="currentlyManagingRole"
      @close="currentlyManagingRole = false"
    >
      <template #title> Manage Role </template>

      <template #content>
        <div v-if="managingRoleFor">
          <div class="mt-1 border border-gray-200 rounded-lg cursor-pointer">
            <div
              class="px-4 py-3"
              :class="{ 'border-t border-gray-200': i > 0 }"
              @click="updateRoleForm.role = role.key"
              v-for="(role, i) in availableRoles"
              :key="role.key"
            >
              <div
                :class="{
                  'opacity-50':
                    updateRoleForm.role && updateRoleForm.role != role.key,
                }"
              >
                <div class="flex items-center">
                  <div
                    class="text-sm text-gray-600"
                    :class="{
                      'font-semibold': updateRoleForm.role == role.key,
                    }"
                  >
                    {{ role.name }}
                  </div>

                  <svg
                    v-if="updateRoleForm.role == role.key"
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

                <div class="mt-2 text-xs text-gray-600">
                  {{ role.description }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click.native="currentlyManagingRole = false">
          Nevermind
        </jet-secondary-button>

        <jet-button
          class="ml-2"
          @click.native="updateRole"
          :class="{ 'opacity-25': updateRoleForm.processing }"
          :disabled="updateRoleForm.processing"
        >
          Save
        </jet-button>
      </template>
    </jet-dialog-modal>

    <!-- Leave Team Confirmation Modal -->
    <jet-confirmation-modal
      :show="confirmingLeavingTeam"
      @close="confirmingLeavingTeam = false"
    >
      <template #title> Leave Team </template>

      <template #content>
        Are you sure you would like to leave this team?
      </template>

      <template #footer>
        <jet-secondary-button @click.native="confirmingLeavingTeam = false">
          Nevermind
        </jet-secondary-button>

        <jet-danger-button
          class="ml-2"
          @click.native="leaveTeam"
          :class="{ 'opacity-25': leaveTeamForm.processing }"
          :disabled="leaveTeamForm.processing"
        >
          Leave
        </jet-danger-button>
      </template>
    </jet-confirmation-modal>

    <!-- Remove Team Member Confirmation Modal -->
    <jet-confirmation-modal
      :show="teamMemberBeingRemoved"
      @close="teamMemberBeingRemoved = null"
    >
      <template #title> Remove Team Member </template>

      <template #content>
        Are you sure you would like to remove this person from the team?
      </template>

      <template #footer>
        <jet-secondary-button @click.native="teamMemberBeingRemoved = null">
          Nevermind
        </jet-secondary-button>

        <jet-danger-button
          class="ml-2"
          @click.native="removeTeamMember"
          :class="{ 'opacity-25': removeTeamMemberForm.processing }"
          :disabled="removeTeamMemberForm.processing"
        >
          Remove
        </jet-danger-button>
      </template>
    </jet-confirmation-modal>
  </div>
</template>

<script>
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetActionSection from "@/Jetstream/ActionSection";
import JetButton from "@/Jetstream/Button";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetSectionBorder from "@/Jetstream/SectionBorder";

export default {
  components: {
    JetActionMessage,
    JetActionSection,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetDialogModal,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    JetSectionBorder,
  },

  props: ["team", "availableRoles", "userPermissions"],

  data() {
    return {
      InviteModal: false,
      addTeamMemberForm: this.$inertia.form(
        {
          email: "",
          role: null,
        },
        {
          bag: "addTeamMember",
          resetOnSuccess: true,
        }
      ),

      updateRoleForm: this.$inertia.form(
        {
          role: null,
        },
        {
          bag: "updateRole",
          resetOnSuccess: false,
        }
      ),

      leaveTeamForm: this.$inertia.form(
        {
          //
        },
        {
          bag: "leaveTeam",
        }
      ),

      removeTeamMemberForm: this.$inertia.form(
        {
          //
        },
        {
          bag: "removeTeamMember",
        }
      ),

      currentlyManagingRole: false,
      managingRoleFor: null,
      confirmingLeavingTeam: false,
      teamMemberBeingRemoved: null,
    };
  },

  methods: {
    InviteNewUser() {
      this.addTeamMemberForm.email = "";

      this.InviteModal = true;

      setTimeout(() => {
        this.$refs.email.focus();
      }, 250);
    },
    addTeamMember() {
      this.addTeamMemberForm
        .post(route("team-members.store", this.team), {
          preserveScroll: true,
        })
        .then((response) => {
          if (!this.addTeamMemberForm.hasErrors()) {
            this.InviteModal = false;
          }
        });
    },

    manageRole(teamMember) {
      this.managingRoleFor = teamMember;
      this.updateRoleForm.role = teamMember.membership.role;
      this.currentlyManagingRole = true;
    },

    updateRole() {
      this.updateRoleForm
        .put(route("team-members.update", [this.team, this.managingRoleFor]), {
          preserveScroll: true,
        })
        .then(() => {
          this.currentlyManagingRole = false;
        });
    },

    confirmLeavingTeam() {
      this.confirmingLeavingTeam = true;
    },

    leaveTeam() {
      this.leaveTeamForm.delete(
        route("team-members.destroy", [this.team, this.$page.user])
      );
    },

    confirmTeamMemberRemoval(teamMember) {
      this.teamMemberBeingRemoved = teamMember;
    },

    removeTeamMember() {
      this.removeTeamMemberForm
        .delete(
          route("team-members.destroy", [
            this.team,
            this.teamMemberBeingRemoved,
          ]),
          {
            preserveScroll: true,
            preserveState: true,
          }
        )
        .then(() => {
          this.teamMemberBeingRemoved = null;
        });
    },

    displayableRole(role) {
      return this.availableRoles.find((r) => r.key == role).name;
    },
  },
};
</script>
