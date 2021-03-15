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
                    v-model="search"
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
          <template #pager_value
            >{{ pagination.from }}-{{ pagination.to }}</template
          >
          <template #pager_limit>{{ pagination.total }}</template>
          <template #pager_button>
            <button
              v-if="pagination.prevPage"
              @click="--pagination.currentPage"
              type="button"
              title="Previous"
              class="btn btn-secondary pager_previous"
            >
              <i class="fa fa-chevron-left"></i>
            </button>
            <button
              v-if="pagination.nextPage"
              @click="++pagination.currentPage"
              type="button"
              class="btn btn-secondary o_pager_next"
            >
              <i class="fa fa-chevron-right"></i>
            </button>
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
          <kanban-area v-if="DataType == 'users'">
            <kanban-box
              class="data_row"
              v-for="user in DataRow"
              :key="user.email"
              @click.native="viewUser(user)"
            >
              <template #image
                ><div
                  v-if="user.profile_photo_path"
                  class="kanban_image_fill_left"
                  v-bind:style="{
                    'background-image':
                      'url(/storage/' + user.profile_photo_path + ')',
                  }"
                ></div>
                <div
                  v-else
                  class="kanban_image_fill_left"
                  v-bind:style="{
                    'background-image':
                      'url(https://ui-avatars.com/api/?name=' +
                      user.profile_photo_url +
                      '&color=7F9CF5&background=EBF4FF)',
                  }"
                ></div>
              </template>
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
              v-for="n in 80 - DataRow.length"
              :key="n"
            ></kanban-ghost>
          </kanban-area>
          <kanban-area v-else>
            <kanban-box v-for="team in DataRow" :key="team.access_token">
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
                  v-if="team.join == null && team.request == null"
                  @submit.prevent="Join($page.user, team)"
                >
                  <jet-Primary-button class="float-right">
                    Join
                  </jet-Primary-button>
                </form>
                <form
                  method="POST"
                  v-if="team.join == null && team.request != null"
                  @submit.prevent="CancelRequest($page.user, team)"
                >
                  <jet-Primary-button class="float-right">
                    Cancel Request
                  </jet-Primary-button>
                </form>
                <form
                  method="POST"
                  v-if="team.join != null && team.request == null"
                  @submit.prevent="LeaveTeam($page.user, team)"
                >
                  <jet-Primary-button class="float-right">
                    Leave
                  </jet-Primary-button>
                </form>
              </template>
            </kanban-box>
            <kanban-ghost
              v-for="n in 80 - DataRow.length"
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
// import { search } from "../../utils/index.js";
import axios from "axios";

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
    let sortOrders = {};
    return {
      isMobile: true,
      fetchUser: false,
      fetchTeam: true,
      // search and Paginate
      sortKey: "",
      sortOrders: sortOrders,
      search: "",
      length: 30,
      pagination: {
        currentPage: 1,
        total: "",
        nextPage: "",
        prevPage: "",
        from: "",
        to: "",
      },
    };
  },
  created() {
    this.detectMob();
  },

  methods: {
    detectMob() {
      if (window.innerWidth <= 767) {
        this.isMobile = true;
      } else {
        this.isMobile = false;
      }
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
    paginate(array, length, pageNumber) {
      this.pagination.from = array.length ? (pageNumber - 1) * length + 1 : " ";
      this.pagination.to =
        pageNumber * length > array.length ? array.length : pageNumber * length;
      this.pagination.prevPage = pageNumber > 1 ? pageNumber : "";
      this.pagination.nextPage =
        array.length > this.pagination.to ? pageNumber + 1 : "";
      return array.slice((pageNumber - 1) * length, pageNumber * length);
    },
    resetPagination() {
      this.pagination.currentPage = 1;
      this.pagination.prevPage = "";
      this.pagination.nextPage = "";
    },
    sortBy(key) {
      this.resetPagination();
      this.sortKey = key;
      this.sortOrders[key] = this.sortOrders[key] * -1;
    },
    CancelRequest(user, team) {
      this.$inertia.delete(route("request_join.destroy", [team, user]));
    },
    LeaveTeam(user, team) {
      this.$inertia.delete(route("team-members.destroy", [team, user]));
    },
    viewTeam(row) {
      this.$inertia.visit(route("teams.show", row.access_token));
    },
    viewUser(row) {
      this.$inertia.visit(route("profile.public", row.email));
    },
  },
  computed: {
    _preparationData() {
      if (this.fetchUser == true) {
        return this.users.original.result;
      } else {
        return this.teams.original.result;
      }
    },
    CheckDataType() {
      if (this.fetchUser == true) {
        return "users";
      } else {
        return "team";
      }
    },
    filterdata() {
      this.resetPagination();
      let value = this._preparationData;
      if (this.search) {
        value = value.filter((row) => {
          return Object.keys(row).some((key) => {
            return (
              String(row[key])
                .toLowerCase()
                .indexOf(this.search.toLowerCase()) > -1
            );
          });
        });
      }
      let sortKey = this.sortKey;
      let order = this.sortOrders[sortKey] || 1;
      if (sortKey) {
        value = value.slice().sort((a, b) => {
          let index = this.getIndex(this.columns, "name", sortKey);
          a = String(a[sortKey]).toLowerCase();
          b = String(b[sortKey]).toLowerCase();
          if (this.columns[index].type && this.columns[index].type === "date") {
            return (
              (a === b
                ? 0
                : new Date(a).getTime() > new Date(b).getTime()
                ? 1
                : -1) * order
            );
          } else if (
            this.columns[index].type &&
            this.columns[index].type === "number"
          ) {
            return (+a === +b ? 0 : +a > +b ? 1 : -1) * order;
          } else {
            return (a === b ? 0 : a > b ? 1 : -1) * order;
          }
        });
      }
      return value;
    },
    DataRow() {
      return this.paginate(
        this.filterdata,
        this.length,
        this.pagination.currentPage
      );
    },
    DataType() {
      return this.CheckDataType;
    },
  },
};
</script>
