<template>
  <dashboard :users="users" :view_type="view_type">
    <template #content>
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
              @submit.prevent="Follow($page.user.id, follower.userfollowers.id)"
            >
              <jet-Primary-button class="float-right">
                Follow
              </jet-Primary-button>
            </form>
            <form
              method="POST"
              v-else
              @submit.prevent="Unfollow($page.user.id, follower.userfollowers.id)"
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
              @submit.prevent="Follow($page.user.id, following.userfollowing.id)"
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
  </dashboard>
</template>

<script>
// Button Component
import JetPrimaryButton from "@/Jetstream/PrimaryButton";
// Kanban Component
import KanbanArea from "@/Jetstream/KanbanArea";
import KanbanBox from "@/Jetstream/KanbanBox";
import KanbanGhost from "@/Jetstream/KanbanGhost";
// Page
import dashboard from "./dashboard";

export default {
  props: ["users", "view_type"],

  components: {
    JetPrimaryButton,
    KanbanArea,
    KanbanBox,
    KanbanGhost,
    dashboard,
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