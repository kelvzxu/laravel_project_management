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
        <jet-workspace>
          <template #workspace_icon><slot name="workspace_icon"/></template>
          <template #workspace_name><slot name="workspace_name"/></template>
          <template #workspace_sub_header><slot name="workspace_sub_header"/></template>
        </jet-workspace>
      </div>
      <slot name="main_content"></slot>
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
import JetWorkspace from "@/Jetstream/ControlComponent";

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
    JetWorkspace,
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
