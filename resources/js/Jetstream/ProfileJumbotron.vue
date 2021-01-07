<template>
  <div class="user_profile_container">
    <div class="user_profile">
      <section class="user_profile_top_container">
        <div class="locale-picker-wrapper">
          <!-- <select
            class="custom-select"
            style="border: none"
            id="inputGroupSelect01"
          >
            <option selected>Choose...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select> -->
        </div>
        <div class="user-profile-top-component">
          <div class="user_inner_container user_profile_top">
            <div class="profile-image-component">
              <div
                class="inline_block out_of_office_icon_container position_relative"
              >
                <div class="out_of_office_user animated FadeIn inline_block">
                  <img
                    class="out_of_office-icon"
                    src="https://cdn7.monday.com/images/working-status/wfh.svg"
                  />
                </div>
              </div>
              <div class="ds-menu-button-container">
                <div class="hover-wrapper">
                  <img
                    class="profile-image hover"
                    :src="$page.user.profile_photo_url"
                    :alt="$page.user.name"
                  />
                </div>
              </div>
            </div>
            <div class="user_name">
              <h1>
                <div>
                  <span class="editable">{{ $page.user.name }}</span>
                </div>
              </h1>
            </div>
          </div>
        </div>
        <div class="user_profile_menu_container">
          <div id="user_profile_tabs">
            <ul class="pulse-tabs">
              <jet-responsive-nav-link
                :href="route('profile.show')"
                :active="route().current('profile.show')"
                >Personal Info</jet-responsive-nav-link
              >
              <li class="">
                <a href="/users/17864734/settings/working_status"
                  >Working Status</a
                >
              </li>
              <li class="">
                <a href="/users/17864734/settings/password">Password</a>
              </li>
              <li class="">
                <a href="/users/17864734/settings/preferences">Preferences</a>
              </li>
              <li class="">
                <a href="/users/17864734/settings/notifications"
                  >Notifications</a
                >
              </li>
              <li class="">
                <a href="/users/17864734/settings/email_integration"
                  >Email Integration</a
                >
              </li>
              <jet-responsive-nav-link
                :href="route('profile.session')"
                :active="route().current('profile.session')"
                >Sessions</jet-responsive-nav-link
              >
            </ul>
          </div>
          <select class="user_profile_mobile_menu">
            <option value="personal_info">Personal Info</option>
            <option value="working_status">Working Status</option>
            <option value="password">Password</option>
            <option value="preferences">Preferences</option>
            <option value="notifications">Notifications</option>
            <option value="email_integration">Email Integration</option>
            <option value="sessions">Sessions</option>
          </select>
        </div>
      </section>
    </div>
    <slot></slot>
  </div>
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ProfileNav";

export default {
  components: {
    JetResponsiveNavLink,
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
        console.log(this.showingProfileDialog);
      }
    };
  },
};
</script>
