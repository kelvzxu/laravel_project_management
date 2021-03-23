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
          <jet-profile-nav v-if="users.original.result.id != $page.user.id" :users="users" :view_type="view_type"/>
          <jet-profile-nav-int v-else :users="users" :view_type="view_type"/>
        </template>
        <template #main>
          <slot name="content"></slot>
        </template>
      </jet-profile-header>
    </app-content>
  </app-layout>
</template>

<script>
import AppContent from "@/Jetstream/ApplicationContent";
import AppLayout from "@/Layouts/AppLayout";
import JetProfileHeader from "@/Jetstream/ProfileHeader";
import JetProfileNav from "@/Jetstream/ProfileNavigation";
import JetProfileNavInt from "@/Jetstream/ProfileNav";
export default {
  props: ["users","view_type"],

  components: {
    AppContent,
    AppLayout,
    JetProfileHeader,
    JetProfileNav,
    JetProfileNavInt,
  },
};
</script>