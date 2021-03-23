<template>
  <div class="user-profile">
    <div class="cover-block user-cover-block">
      <div class="profile-header">
        <div class="avatar-holder">
          <slot name="avatar"></slot>
        </div>
        <div class="user-info">
          <div class="cover-title" itemprop="name">
            <slot name="name"></slot>
          </div>
          <p class="mb-1 mb-sm-2 mt-2 mt-sm-3">
            <slot name="username"></slot><slot name="join_date"></slot>
          </p>

          <div class="cover-desc mb-1 mb-sm-2">
            <div
              class="profile-link-holder middle-dot-divider-sm d-block d-sm-inline mb-1 mb-sm-0"
            >
              <slot name="location"></slot>
            </div>
          </div>
          <div class="cover-desc cgray mb-1 mb-sm-2">
            <div
              class="profile-link-holder middle-dot-divider-sm d-block d-sm-inline mt-1 mt-sm-0"
            >
              <slot name="website"></slot>
            </div>
          </div>
          <div class="cover-desc gl-text-gray-900 gl-mb-2 mb-sm-2">
            <div class="profile-link-holder middle-dot-divider">
              <slot name="followers"></slot>
            </div>
            <div class="profile-link-holder middle-dot-divider">
              <slot name="following"></slot>
            </div>
          </div>
        </div>
      </div>
      <div class="scrolling-tabs-container">
        <div class="fade-left">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </div>
        <div class="fade-right">
          <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </div>
        <slot name="navigation_menu"></slot>
      </div>
    </div>
    <slot name="main"></slot>
  </div>
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ProfileNav";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";

export default {
  components: {
    JetResponsiveNavLink,
    JetDropdown,
    JetDropdownLink,
  },

  data() {
    return {
      showingNavigationDropdown: false,
      showingProfileDialog: false,
    };
  },

  methods: {
    switchToTeam(team) {
      this.$inertia.put(
        route("current-team.update"),
        {
          team_id: team.id,
        },
        {
          preserveState: false,
        }
      );
    },
  },

  created() {
    const closeOnEscape = (e) => {
      if (this.showingProfileDialog && e.keyCode === 27) {
        this.showingProfileDialog = false;
      }
    };
  },
};
</script>
