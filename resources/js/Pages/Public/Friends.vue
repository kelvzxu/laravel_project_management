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
            :href="route('profile.followers', $page.user.email)"
            >{{ users.original.result.followers.length }} followers
          </inertia-link></template
        >
        <template #following>
          <i class="fa fa-users" aria-hidden="true"></i>
          <inertia-link
            class="text-link"
            :href="route('profile.following', $page.user.email)"
            >{{ users.original.result.following.length }} following
          </inertia-link></template
        >
        <template #navigation_menu>
          <ul
            class="nav-links user-profile-nav scrolling-tabs nav nav-tabs is-initialized"
            v-if="users.original.result.id != $page.user.id"
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
          <ul
            class="nav-links user-profile-nav scrolling-tabs nav nav-tabs is-initialized"
            v-else
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
          <kanban-area v-if="view_type == 'followers'">
            <kanban-box
              v-for="follower in users.original.result.followers"
              :key="follower.userfollowers.email"
              @click.native="viewUser(follower.userfollowers)"
            >
              <template #image
                ><div
                  class="kanban_image_fill_left"
                  v-bind:style="{
                    'background-image':
                      'url(/storage/' +
                      follower.userfollowers.profile_photo_path +
                      ')',
                  }"
                ></div
              ></template>
              <template #name
                ><span>{{ follower.userfollowers.name }}</span></template
              >
              <template #jobs
                ><span>{{ follower.userfollowers.job_title }}</span></template
              >
              <template #tags v-if="follower.userfollowers.location != null"
                ><span class="field_tag tag_color_6"
                  ><span></span>{{ follower.userfollowers.location }}</span
                ></template
              >
              <template #email
                ><span
                  ><small>{{ follower.userfollowers.email }}</small></span
                ></template
              >
              <template #button>
                <form
                  method="POST"
                  v-if="follower.userfollowers.state == null"
                  @submit.prevent="
                    Follow($page.user.id, follower.userfollowers.id)
                  "
                >
                  <jet-Primary-button class="float-right">
                    Follow
                  </jet-Primary-button>
                </form>
                <form
                  method="POST"
                  v-else
                  @submit.prevent="
                    Unfollow($page.user.id, follower.userfollowers.id)
                  "
                >
                  <jet-Primary-button class="float-right">
                    Unfollow
                  </jet-Primary-button>
                </form>
              </template>
            </kanban-box>
            <kanban-ghost
              v-for="n in 80 - users.original.result.followers.length"
              :key="n"
            ></kanban-ghost>
          </kanban-area>
          <kanban-area v-if="view_type == 'following'">
            <kanban-box
              v-for="following in users.original.result.following"
              :key="following.userfollowing.email"
              @click.native="viewUser(following.userfollowing)"
            >
              <template #image
                ><div
                  class="kanban_image_fill_left"
                  v-bind:style="{
                    'background-image':
                      'url(/storage/' +
                      following.userfollowing.profile_photo_path +
                      ')',
                  }"
                ></div
              ></template>
              <template #name
                ><span>{{ following.userfollowing.name }}</span></template
              >
              <template #jobs
                ><span>{{ following.userfollowing.job_title }}</span></template
              >
              <template #tags v-if="following.userfollowing.location != null"
                ><span class="field_tag tag_color_6"
                  ><span></span>{{ following.userfollowing.location }}</span
                ></template
              >
              <template #email
                ><span
                  ><small>{{ following.userfollowing.email }}</small></span
                ></template
              >
              <template #button>
                <form
                  method="POST"
                  v-if="following.userfollowing.state == null"
                  @submit.prevent="
                    Follow($page.user.id, following.userfollowing.id)
                  "
                >
                  <jet-Primary-button class="float-right">
                    Follow
                  </jet-Primary-button>
                </form>
                <form
                  method="POST"
                  v-else
                  @submit.prevent="
                    Unfollow($page.user.id, following.userfollowing.id)
                  "
                >
                  <jet-Primary-button class="float-right">
                    Unfollow
                  </jet-Primary-button>
                </form>
              </template>
            </kanban-box>
            <kanban-ghost
              v-for="n in 80 - users.original.result.following.length"
              :key="n"
            ></kanban-ghost>
          </kanban-area>
        </template>
      </jet-profile-header>
    </app-content>
  </app-layout>
</template>

<script>
import AppContent from "@/Jetstream/ApplicationContent";
import AppLayout from "@/Layouts/AppLayout";
import JetProfileHeader from "@/Jetstream/ProfileHeader";
// Button Component
import JetPrimaryButton from "@/Jetstream/PrimaryButton";
// Kanban Component
import KanbanArea from "@/Jetstream/KanbanArea";
import KanbanBox from "@/Jetstream/KanbanBox";
import KanbanGhost from "@/Jetstream/KanbanGhost";

export default {
  props: ["users", "view_type"],

  components: {
    AppContent,
    AppLayout,
    JetProfileHeader,
    JetPrimaryButton,
    KanbanArea,
    KanbanBox,
    KanbanGhost,
  },
  methods: {
    Follow(uid, friend) {
      this.$inertia.post(route("user.follow"), {
        user_id: uid,
        friend_id: friend,
        preserveState: false,
      });
    },
    Unfollow(uid, friend) {
      this.$inertia.post(route("user.unfollow"), {
        user_id: uid,
        friend_id: friend,
        preserveState: false,
      });
    },
    viewUser(row) {
      this.$inertia.visit(route("profile.public", row.email));
    },
  },
};
</script>