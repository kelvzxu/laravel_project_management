<template>
  <jet-profile-header>
    <template #avatar>
      <a
        target="_blank"
        rel="noopener noreferrer"
        :href="$page.user.profile_photo_url"
        ><img
          class="avatar s90 js-lazy-loaded qa-js-lazy-loaded"
          itemprop="image"
          :src="$page.user.profile_photo_url"
          :alt="$page.user.name"
          loading="lazy"
        />
      </a>
    </template>
    <template #name>{{ $page.user.name }}</template>
    <template #username v-if="$page.user.show_public_email">
      <span class="middle-dot-divider"> @{{ $page.user.email }} </span>
    </template>
    <template #join_date
      ><small
        >Member Since {{ $page.user.created_at | formatDate }}</small
      ></template
    >
    <template #location v-if="$page.user.location">
      <i class="fa fa-map-marker" aria-hidden="true"></i>
      <span class="vertical-align-middle" itemprop="addressLocality">
        {{ $page.user.location }}
      </span>
    </template>
    <template #website v-if="$page.user.website_url">
      <a
        class="text-link"
        target="_blank"
        itemprop="url"
        :href="$page.user.website_url"
        >{{ $page.user.website_url }}</a
      >
    </template>
    <template #followers> <slot name="followers"></slot></template>
    <template #following> <slot name="following"></slot></template>
    <template #navigation_menu>
      <ul
        class="nav-links user-profile-nav scrolling-tabs nav nav-tabs is-initialized"
      >
        <li class="js-info-tab">
          <inertia-link
            :href="route('profile.show')"
            :active="route().current('profile.show')"
            >Personal Info</inertia-link
          >
        </li>
        <li class="js-password-tab">
          <inertia-link
            :href="route('profile.password')"
            :active="route().current('profile.password')"
            >Password</inertia-link
          >
        </li>
        <li class="js-preferences-tab">
          <inertia-link
            :href="route('profile.preferences')"
            :active="route().current('profile.preferences')"
            >Preferences</inertia-link
          >
        </li>
        <li class="js-followers-tab">
          <inertia-link
            :href="route('profile.followers', $page.user.email)"
            :active="route().current('profile.followers')"
            >Followers</inertia-link
          >
        </li>
        <li class="js-following-tab">
          <inertia-link
            :href="route('profile.following', $page.user.email)"
            :active="route().current('profile.following')"
            >Following</inertia-link
          >
        </li>
        <li class="js-session-tab">
          <inertia-link
            :href="route('profile.session')"
            :active="route().current('profile.session')"
            >Sessions</inertia-link
          >
        </li>
      </ul>
    </template>
    <template #main>
      <slot name="main"></slot>
    </template>
  </jet-profile-header>
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ProfileNav";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import JetProfileHeader from "@/Jetstream/ProfileHeader";

export default {
  components: {
    JetResponsiveNavLink,
    JetDropdown,
    JetDropdownLink,
    JetProfileHeader,
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
