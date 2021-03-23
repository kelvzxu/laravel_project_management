<template>
  <ul
    class="nav-links user-profile-nav scrolling-tabs nav nav-tabs is-initialized"
  >
    <li class="js-info-tab">
      <inertia-link
        :href="route('profile.show')"
        :class="{
                  'active': route().current('profile.show') == true,
                }"
        >Personal Info</inertia-link
      >
    </li>
    <li class="js-password-tab">
      <inertia-link
        :href="route('profile.password')"
        :class="{
                  'active': route().current('profile.password') == true,
                }"
        >Password</inertia-link
      >
    </li>
    <li class="js-preferences-tab">
      <inertia-link
        :href="route('profile.preferences')"
        :class="{
                  'active': route().current('profile.preferences') == true,
                }"
        >Preferences</inertia-link
      >
    </li>
    <li class="js-followers-tab">
      <inertia-link
        :href="route('profile.followers', users.original.result.email)"
        :class="{
          active:
            route().current('profile.followers') == true &&
            view_type == 'followers',
        }"
        >Followers</inertia-link
      >
    </li>
    <li class="js-following-tab">
      <inertia-link
        :href="route('profile.following', users.original.result.email)"
        :class="{
          active:
            route().current('profile.following') == true &&
            view_type == 'following',
        }"
        >Following</inertia-link
      >
    </li>
    <li class="js-session-tab">
      <inertia-link
        :href="route('profile.session')"
        :class="{
                  'active': route().current('profile.session') == true,
                }"
        >Sessions</inertia-link
      >
    </li>
  </ul>
</template>
<script>
export default {
  props: ["users", "view_type"],
};
</script>

