<template>
  <jet-dashboard>
    <template #filter>
      <jet-workspace-button
        :class="{
          'workspace floating': DataType == 'users',
        }"
        @click.native="
          (fetchTeams = false), (fetchUser = true), (currentUser = $page.user)
        "
      >
        <i class="fas fa-user main-icon"></i>Users
      </jet-workspace-button>
      <jet-workspace-button
        :class="{
          'workspace floating': DataType == 'team',
        }"
        @click.native="
          (fetchTeams = true), (fetchUser = false), (currentUser = $page.user)
        "
      >
        <i class="fas fa-users main-icon"></i>Teams
      </jet-workspace-button>
    </template>
    <template #page_name>{{ view_type }}</template>
    <template #page
      >{{ pagination.from }}-{{ pagination.to }} /
      {{ pagination.total }}</template
    >
    <template #board_button_group>
      <jet-board-search
        ><input placeholder="Search... " v-model="search" style="width: 100%"
      /></jet-board-search>
    </template>
    <template #board_header_action>
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
    <template #record>
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
                'background-image': 'url(' + user.profile_photo_url + ')',
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
        <kanban-ghost v-for="n in 80 - DataRow.length" :key="n"></kanban-ghost>
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
              <jet-danger-button :type="'submit'" class="float-right">
                Leave
              </jet-danger-button>
            </form>
          </template>
        </kanban-box>
        <kanban-ghost v-for="n in 80 - DataRow.length" :key="n"></kanban-ghost>
      </kanban-area>
    </template>
  </jet-dashboard>
</template>

<script>
// Dependence Page
import JetDashboard from "./Dashboard";
// workspace
import JetWorkspaceButton from "@/Jetstream/WorkspaceButton";
import JetBoardSearch from "@/Jetstream/BoardSearch";
// button Component
import JetPrimaryButton from "@/Jetstream/PrimaryButton";
import JetDangerButton from "@/Jetstream/DangerButton";
// Kanban Component
import KanbanArea from "@/Jetstream/KanbanArea";
import KanbanBox from "@/Jetstream/KanbanBox";
import KanbanGhost from "@/Jetstream/KanbanGhost";

export default {
  props: ["teams", "users"],
  components: {
    JetDashboard,
    JetWorkspaceButton,
    JetBoardSearch,
    JetPrimaryButton,
    JetDangerButton,
    KanbanArea,
    KanbanBox,
    KanbanGhost,
  },
  data() {
    let sortOrders = {};
    return {
      fetchUser: true,
      fetchTeam: false,
      view_type: "Search Users",
      // search and Pcaginate
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
        this.pagination.total = this.users.original.result.length;
        this.view_type = "Search Users";
        return "users";
      } else {
        this.pagination.total = this.teams.original.result.length;
        this.view_type = "Search Team";
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