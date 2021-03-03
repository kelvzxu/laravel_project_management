<template>
  <app-layout>
    <app-content>
      <div class="application-content">
        <control-panel>
          <template #title
            ><li
              class="breadcrumb-item active font-weight-bold text-black"
              v-if="isMobile == false"
            >
              Search Page
            </li></template
          >
          <template #search>
            <div
              role="search"
              class="cp_search_view mb-0"
              v-if="isMobile == false"
            >
              <div role="search" class="o_searchview">
                <i role="img" class="searchview_icon fa fa-search"></i>
                <div class="searchview_input_container">
                  <input
                    type="text"
                    placeholder="Search..."
                    role="searchbox"
                    class="searchview_input"
                  />
                </div>
              </div>
            </div>
            <div role="search" class="cp_searchview o_searchview_quick" v-else>
              <div role="search" class="o_searchview">
                <button
                  type="button"
                  class="enable_searchview btn btn-link fa fa-arrow-left"
                ></button>
                <div class="searchview_input_container">
                  <input
                    type="text"
                    placeholder="Search..."
                    role="searchbox"
                    class="searchview_input"
                  />
                </div>
                <button
                  type="button"
                  class="toggle_searchview_full btn fa fa-filter"
                ></button>
              </div>
            </div>
          </template>
        </control-panel>

        <div class="controller_with_searchpanel">
          <div class="search_panel d-none d-md-block" style="height: 100vh">
            <section class="search_panel_section search_panel_category">
              <header class="search_panel_section_header">
                <i
                  class="mr-1 fa fa-filter search_panel_section_icon"
                  style
                ></i>
                <b>Filter By</b>
              </header>

              <ul class="list-group d-block search_panel_field">
                <li
                  class="search_panel_category_value border-0 list-group-item"
                  @click="
                    (fetchTeams = true),
                      (fetchUser = false),
                      (currentUser = $page.user)
                  "
                >
                  <header class="list-group-item-action">
                    <label for="Merchandise" class="search_panel_label mb0">
                      <span class="search_panel_label_title">Teams</span>
                    </label>
                  </header>
                </li>
                <li
                  class="search_panel_category_value border-0 list-group-item"
                  @click="
                    (fetchTeams = false),
                      (fetchUser = true),
                      (currentUser = $page.user)
                  "
                >
                  <header class="list-group-item-action">
                    <label for="Administration" class="search_panel_label mb0">
                      <span class="search_panel_label_title">Users</span>
                    </label>
                  </header>
                </li>
              </ul>
            </section>
          </div>
          <kanban-area v-if="DataRow == 'users'">
            <kanban-box
              class="data_row"
              v-for="user in users.original.result"
              :key="user.email"
              @click.native="viewUser(user)"
            >
              <template #image
                ><div
                  class="kanban_image_fill_left"
                  v-bind:style="{
                    'background-image':
                      'url(/storage/' + user.profile_photo_path + ')',
                  }"
                ></div
              ></template>
              <template #name
                ><span>{{ user.name }}</span></template
              >
              <template #jobs
                ><span>{{ user.job_title }}</span></template
              >
              <template #tags v-if="user.location != null"
                ><span class="field_tag tag_color_6"
                  ><span></span>{{ user.location }}</span
                ></template
              >
              <template #email
                ><span
                  ><small>{{ user.email }}</small></span
                ></template
              >
              <template #button>
                <form
                  method="POST"
                  v-if="user.state == null"
                  @submit.prevent="Follow($page.user.id, user.id)"
                >
                  <jet-Primary-button class="float-right">
                    Follow
                  </jet-Primary-button>
                </form>
                <form
                  method="POST"
                  v-else
                  @submit.prevent="Unfollow($page.user.id, user.id)"
                >
                  <jet-Primary-button class="float-right">
                    Unfollow
                  </jet-Primary-button>
                </form>
              </template>
            </kanban-box>
            <kanban-ghost
              v-for="n in 80 - teams.original.result.length"
              :key="n"
            ></kanban-ghost>
          </kanban-area>
          <kanban-area v-else>
            <kanban-box v-for="team in teams.original.result" :key="team.name">
              <template #image
                ><div
                  class="kanban_image_fill_left"
                  style="
                    background-image: url('https://erp.kltech-intl.technology/images/icons/avatar.png');
                  "
                  @click="viewTeam(team)"
                ></div
              ></template>
              <template #jobs
                ><span @click="viewTeam(team)">{{ team.name }}</span></template
              >
              <template #tags
                ><span class="field_tag tag_color_6"
                  ><span></span>{{ team.team_type }}</span
                ></template
              >

              <template #button>
                <form
                  method="POST"
                  v-if="team.join == null"
                  @submit.prevent="Join($page.user, team)"
                >
                  <jet-Primary-button class="float-right">
                    Join
                  </jet-Primary-button>
                </form>
                <form
                  method="POST"
                  v-else
                  @submit.prevent="LeaveTeam($page.user, team)"
                >
                  <jet-Primary-button class="float-right">
                    Leave
                  </jet-Primary-button>
                </form>
              </template>
            </kanban-box>
            <kanban-ghost
              v-for="n in 80 - teams.original.result.length"
              :key="n"
            ></kanban-ghost>
          </kanban-area>
        </div>
      </div>
    </app-content>
  </app-layout>
</template>


<script>
import AppContent from "@/Jetstream/ApplicationContent";
import AppLayout from "@/Layouts/AppLayout";
import ControlPanel from "@/Jetstream/ControlPanel";
import SearchPanel from "@/Jetstream/SearchPanel";
import JetPrimaryButton from "@/Jetstream/PrimaryButton";
// Kanban Component
import KanbanArea from "@/Jetstream/KanbanArea";
import KanbanBox from "@/Jetstream/KanbanBox";
import KanbanGhost from "@/Jetstream/KanbanGhost";

export default {
  props: ["teams", "users"],

  components: {
    AppContent,
    AppLayout,
    ControlPanel,
    SearchPanel,
    JetPrimaryButton,
    KanbanArea,
    KanbanBox,
    KanbanGhost,
  },
  data() {
    return {
      isMobile: true,
      fetchUser: false,
      fetchTeam: true,
    };
  },
  created() {
    this.detectMob();
    // this.Follow();
  },
  methods: {
    detectMob() {
      if (window.innerWidth <= 767) {
        this.isMobile = true;
      } else {
        this.isMobile = false;
      }
    },
    viewDetail(row) {
      this.$inertia.visit(route("teams.show", row.id));
    },
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
    Join(user, team) {
      this.$inertia.post(route("team.join", team), {
        user: user,
        email: user.email,
        role: "editor",
        preserveScroll: true,
      });
    },
    LeaveTeam(user, team) {
      this.$inertia.delete(route("team-members.destroy", [team, user]));
    },
    viewTeam(row) {
      this.$inertia.visit(route("teams.show", row.id));
    },
    viewUser(row) {
      this.$inertia.visit(route("profile.public", row.email));
    },
  },
  computed: {
    _preparationData() {
      if (this.fetchUser == true) {
        return "users";
      } else {
        return "teams";
      }
    },
    DataRow() {
      return this._preparationData;
    },
  },
};
</script>
