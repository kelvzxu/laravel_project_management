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
    <template #followers>
      <i class="fa fa-users" aria-hidden="true"></i>
      <inertia-link
        :href="route('profile.followers', $page.user.email)"
        :active="route().current('profile.followers')"
        >{{ users.original.result.followers.length }} followers
      </inertia-link></template
    >
    <template #following>
      <i class="fa fa-users" aria-hidden="true"></i>
      <inertia-link
        :href="route('profile.following', $page.user.email)"
        :active="route().current('profile.following')"
        >{{ users.original.result.following.length }} Following</inertia-link
      ></template
    >
    <template #navigation_menu>
      <jet-profile-nav-int :users="users" />
    </template>
    <template #main>
      <slot name="main"></slot>
    </template>
  </jet-profile-header>
</template>

<script>
import JetProfileNav from "@/Jetstream/ProfileNav";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import JetProfileHeader from "@/Jetstream/ProfileHeader";
import JetProfileNavInt from "@/Jetstream/ProfileNav";

export default {
  props: ["users"],

  components: {
    JetProfileNav,
    JetDropdown,
    JetDropdownLink,
    JetProfileHeader,
    JetProfileNavInt,
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
