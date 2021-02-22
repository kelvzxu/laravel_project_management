<template>
  <app-layout>
    <app-content>
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
              <i class="mr-1 fa fa-filter search_panel_section_icon" style></i>
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
      </div>
      {{ DataRow }}
    </app-content>
  </app-layout>
</template>


<script>
import AppContent from "@/Jetstream/ApplicationContent";
import AppLayout from "@/Layouts/AppLayout";
import ControlPanel from "@/Jetstream/ControlPanel";
import SearchPanel from "@/Jetstream/SearchPanel";
import JetSuccessButton from "@/Jetstream/SuccessButton";

export default {
  props: ["teams"],

  components: {
    AppContent,
    AppLayout,
    ControlPanel,
    SearchPanel,
    JetSuccessButton,
  },
  data() {
    return {
      dataUsers: [],
      dataTeams: [],
      currentUser: [],
      isMobile: true,
      fetchUser: false,
      fetchTeam: true,
    };
  },
  created() {
    this.detectMob();
    this.fetchTeams();
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
    fetchUsers() {
      axios
        .get("/user/fetch/" + this.currentUser.id)
        .then((response) => {
          this.dataUsers = response.data.result;
          console.log(this.dataUsers);
        })
        .catch((error) => console.error(error));
    },
    fetchTeams() {
      axios
        .get("/team/fetch/")
        .then((response) => {
          this.dataTeams = response.data.result;
        })
        .catch((error) => console.error(error));
    },
  },
  computed: {
    _preparationData() {
      if (this.fetchUser == true) {
        this.fetchUsers();
        return this.dataUsers;
      } else {
        return this.dataTeams;
      }
    },
    DataRow() {
      return this._preparationData;
    },
  },
};
</script>
