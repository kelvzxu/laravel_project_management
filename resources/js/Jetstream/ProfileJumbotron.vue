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
                <a href="#">Working Status</a>
              </li>
              <jet-responsive-nav-link
                :href="route('profile.password')"
                :active="route().current('profile.password')"
                >Password</jet-responsive-nav-link
              >
              <jet-responsive-nav-link
                :href="route('profile.preferences')"
                :active="route().current('profile.preferences')"
                >Preferences</jet-responsive-nav-link
              >
              <li class="">
                <a href="#">Notifications</a>
              </li>
              <li class="">
                <a href="#">Email Integration</a>
              </li>
              <jet-responsive-nav-link
                :href="route('profile.session')"
                :active="route().current('profile.session')"
                >Sessions</jet-responsive-nav-link
              >
            </ul>
          </div>
          <jet-dropdown
            class="user_profile_mobile_menu"
            align="right"
            width="48"
          >
            <template #trigger> menu </template>
            <template #content>
              <jet-dropdown-link :href="route('profile.show')">
                Profile
              </jet-dropdown-link>
              <jet-dropdown-link :href="route('profile.session')"
                >Sessions</jet-dropdown-link
              >
            </template>
          </jet-dropdown>
          <!-- <select class="user_profile_mobile_menu" @change="changePage($event)">
            <option value="personal_info">Personal Info</option>
            <option value="working_status">Working Status</option>
            <option value="password">Password</option>
            <option value="preferences">Preferences</option>
            <option value="notifications">Notifications</option>
            <option value="email_integration">Email Integration</option>
            <option value="sessions">Sessions</option>
          </select> -->
        </div>
      </section>
    </div>
    <slot></slot>
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
    changePage(val) {
      console.log(val.target.value);
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
