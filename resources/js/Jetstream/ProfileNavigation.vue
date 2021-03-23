<template>
    <ul
            class="nav-links user-profile-nav scrolling-tabs nav nav-tabs is-initialized"
          >
            <li class="js-overview-tab">
              <inertia-link
                :href="route('profile.public', users.original.result.email)"
                :class="{
                  'active': route().current('profile.public') == true,
                }"
                >Overview</inertia-link
              > 
            </li>
            <li class="js-groups-tab">
              <inertia-link
                :href="route('profile.teams', users.original.result.email)"
                :class="{
                  'active': route().current('profile.teams') == true,
                }"
                >Teams</inertia-link
              > 
            </li>
            <li class="js-contributed-tab">
              <inertia-link
                :href="route('profile.projects', users.original.result.email)"
                :class="{
                  'active': route().current('profile.projects') == true,
                }"
                >Contributed projects</inertia-link
              > 
            </li>
            <li class="js-followers-tab">
              <inertia-link
                :href="route('profile.followers', users.original.result.email)"
                :class="{
                  'active': route().current('profile.followers') == true && view_type == 'followers',
                }"
                >Followers</inertia-link
              >
            </li>
            <li class="js-following-tab">
              <inertia-link
                :href="route('profile.following', users.original.result.email)"
                :class="{
                  'active': route().current('profile.following') == true && view_type == 'following',
                }"
                >Following</inertia-link
              >
            </li>
          </ul>
</template>
<script>
export default {
  props: ["users","view_type"]
};
</script>
