<template>
  <app-layout>
    <app-content>
      <jet-profile-header>
        <template #avatar>
          <a
            target="_blank"
            rel="noopener noreferrer"
            :href="users.original.result.profile_photo_url"
            ><img
              class="avatar s90 js-lazy-loaded qa-js-lazy-loaded"
              itemprop="image"
              :src="users.original.result.profile_photo_url"
              :alt="users.original.result.name"
              loading="lazy"
            />
          </a>
        </template>
        <template #name>{{ users.original.result.name }}</template>
        <template #username v-if="users.original.result.show_public_email">
          <span class="middle-dot-divider">
            {{ users.original.result.email }}
          </span>
        </template>
        <template #join_date
          ><small
            >Member Since
            {{ users.original.result.created_at | formatDate }}</small
          ></template
        >
        <template #location v-if="users.original.result.location">
          <i class="fa fa-map-marker" aria-hidden="true"></i>
          <span class="vertical-align-middle" itemprop="addressLocality">
            {{ users.original.result.location }}
          </span>
        </template>
        <template #website v-if="users.original.result.website_url">
          <a
            class="text-link"
            target="_blank"
            rel="me noopener noreferrer nofollow"
            itemprop="url"
            :href="users.original.result.website_url"
            >{{ users.original.result.website_url }}</a
          >
        </template>
        <template #followers>
          <i class="fa fa-users" aria-hidden="true"></i>
          <inertia-link
            class="text-link"
            :href="route('profile.followers', users.original.result.email)"
            >{{ users.original.result.followers.length }} followers
          </inertia-link></template
        >
        <template #following>
          <i class="fa fa-users" aria-hidden="true"></i>
          <inertia-link
            class="text-link"
            :href="route('profile.following', users.original.result.email)"
            >{{ users.original.result.following.length }} following
          </inertia-link></template
        >
        <template #navigation_menu>
          <ul
            class="nav-links user-profile-nav scrolling-tabs nav nav-tabs is-initialized"
          >
            <li class="js-overview-tab">
              <a
                data-target="div#js-overview"
                data-action="overview"
                data-toggle="tab"
                href="/kelvzxu"
                class="active"
                >Overview
              </a>
            </li>
            <li class="js-groups-tab">
              <inertia-link
                :href="route('profile.teams', users.original.result.email)"
                :active="route().current('profile.teams')"
                >Teams</inertia-link
              >
            </li>
            <li class="js-contributed-tab">
              <a
                data-target="div#contributed"
                data-action="contributed"
                data-toggle="tab"
                data-endpoint="/users/kelvzxu/contributed.json"
                href="/users/kelvzxu/contributed"
                >Contributed projects
              </a>
            </li>
            <li class="js-projects-tab">
              <a
                data-target="div#projects"
                data-action="projects"
                data-toggle="tab"
                data-endpoint="/users/kelvzxu/projects.json"
                href="/users/kelvzxu/projects"
                >Personal projects
              </a>
            </li>
            <li class="js-followers-tab">
              <inertia-link
                :href="route('profile.followers', users.original.result.email)"
                :active="route().current('profile.followers')"
                >Followers</inertia-link
              >
            </li>
            <li class="js-following-tab">
              <inertia-link
                :href="route('profile.following', users.original.result.email)"
                :active="route().current('profile.following')"
                >Following</inertia-link
              >
            </li>
          </ul>
        </template>
        <template #main>
          <slot name="main"></slot>
        </template>
      </jet-profile-header>
    </app-content>
  </app-layout>
</template>

<script>
import AppContent from "@/Jetstream/ApplicationContent";
import AppLayout from "@/Layouts/AppLayout";
import JetProfileHeader from "@/Jetstream/ProfileHeader";

export default {
  props: ["users"],

  components: {
    AppContent,
    AppLayout,
    JetProfileHeader,
  },
  created() {
    console.log(this);
  }
};
</script>