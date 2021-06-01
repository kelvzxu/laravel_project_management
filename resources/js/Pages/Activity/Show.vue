<template>
  <jet-dashboard>
    <template #workspace_icon>{{ project.name[0] }}</template>
    <template #workspace_name>{{ project.name }}</template>
    <template #workspace_sub_header>
      <jet-workspace-sub-header :project="project" />
    </template>
    <template #board_name>{{ project.name }}</template>
    <template #board_description><b>Project Activity</b></template>
    <template #board_subs_images_label>Manager </template>
    <template #board_subs_images>
      <img :src="project.manager.profile_photo_url" class="inner-image" />
    </template>
    <template #board_subs> Member / {{ team.users.length + 1 }} </template>
    <template #board_button>
      <jet-wrapper-button @click.native="AddActivity">
        Scedule New
      </jet-wrapper-button>
    </template>
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
    <template #board_component>
      <table-responsive>
        <template #header>
          <tr>
            <th
              class="o_handle_cell o_column_sortable o_list_number_th"
              style="min-width: 33px; width: 33px"
            ></th>
            <th style="width: 171px">Activity Name</th>
            <th style="width: 190px">Activity Type</th>
            <th style="width: 190px">Responsible</th>
            <th style="width: 190px">Due Date</th>
            <th style="width: 20px"></th>
            <th
              style="width: 20px"
              v-if="$page.user.id == project.manager.id"
            ></th>
            <th
              style="width: 20px"
              v-if="$page.user.id == project.manager.id"
            ></th>
          </tr>
        </template>
        <template #content>
          <tr class="data_row" v-for="(activity, i) in DataRow" :key="i">
            <td>
              <span
                class="row_handle fa fa-arrows ui-sortable-handle o_field_widget"
                name="sequence"
              ></span>
            </td>
            <td>
              <span>{{ activity.name }}</span>
            </td>
            <td>{{ activity.activity_type }}</td>
            <td>
              {{ activity.responsible.name }}
            </td>
            <td>
              {{ activity.due_date }}
            </td>
            <td class="text-center" v-if="activity.state == 'draft'">
              <div
                v-if="
                  $page.user.id == project.manager.id ||
                  $page.user.id == activity.responsible.id
                "
                @click="ActionDone(activity)"
              >
                <i class="fas fa-check-circle" aria-hidden="true"></i>
              </div>
            </td>
            <td class="text-center" v-if="activity.state == 'done'">
              <span class="badge badge-pill badge-success">Done</span>
            </td>
            <td class="text-center" v-if="$page.user.id == project.manager.id">
              <div @click="editActivity(activity)">
                <i class="far fa-edit" aria-hidden="true"></i>
              </div>
            </td>
            <td class="text-center" v-if="$page.user.id == project.manager.id">
              <div @click="DestroyActivity(activity)">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </div>
            </td>
          </tr>
        </template>
      </table-responsive>
    </template>
  </jet-dashboard>
</template>

<script>
import JetDashboard from "@/Jetstream/Dashboard";
// Workspace Component
import JetBoardSorting from "@/Jetstream/BoardSorting";
import JetBoardSearch from "@/Jetstream/BoardSearch";
import JetBoardDropdown from "@/Jetstream/BoardDropdown";
import JetBoardFilterDropdown from "@/Jetstream/BoardFilterDropdown";
import JetWorkspaceSubHeader from "@/Jetstream/WorkspaceSubHeader";
import JetWrapperButton from "@/Jetstream/WrapperButton";
// List Component
import TableResponsive from "@/Jetstream/TableResponsive";
// Module
import draggable from "vuedraggable";

export default {
  props: ["team", "users", "project", "activities"],

  components: {
    JetDashboard,
    JetWrapperButton,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    draggable,
    TableResponsive,
    JetWorkspaceSubHeader,
  },
  data() {
    let sortOrders = {};
    return {
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
  methods: {
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
    AddActivity() {
      this.$inertia.get(route("activity.create", this.project.access_token), {
        preserveScroll: true,
      });
    },
    ActionDone(activity) {
      this.$inertia.post(route("activity.update"), {
        id: activity.id,
        name: activity.name,
        due_date: activity.due_date,
        state: "done",
        preserveScroll: true,
      });
    },
    DestroyActivity(activity) {
      this.$inertia.delete(route("activity.destroy", activity), {
        preserveScroll: true,
      });
    },
    editActivity(activity) {
      this.$inertia.get(route("activity.edit", activity.access_token), {
        preserveScroll: true,
      });
    },
  },
  computed: {
    filterdata() {
      this.resetPagination();
      let value = this.activities;
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
  },
};
</script>
