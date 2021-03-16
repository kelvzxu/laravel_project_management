<template>
  <jet-dashboard>
    <template #workspace_icon>{{ project.name[0] }}</template>
    <template #workspace_name>{{ project.name }}</template>
    <template #workspace_sub_header>
      <jet-workspace-sub-header :project="project" />
    </template>
    <template #page Modal>
      <!-- <create-task :users="users" :project="project" /> -->
    </template>
    <template #board_name>{{ project.name }}</template>
    <template #board_description><b>Project Tags</b></template>
    <template #board_subs_images_label>Manager </template>
    <template #board_subs_images>
      <img :src="project.manager.profile_photo_url" class="inner-image" />
    </template>
    <template #board_subs> Member / {{ team.users.length + 1 }} </template>
    <template #board_button>
      <create-stage :users="users" :project="project" :team="team" />
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
            <th style="width: 171px">Tags Name</th>
            <th style="width: 190px">Projects</th>
            <th style="width: 190px">Color</th>
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
          <tr class="data_row" v-for="(tag, i) in DataRow" :key="i">
            <td>
              <span
                class="row_handle fa fa-arrows ui-sortable-handle o_field_widget"
                name="sequence"
              ></span>
            </td>
            <td>
              <span v-if="UpdateForm.id !== tag.id">{{ tag.name }}</span
              ><input v-else type="text" class="w-full" v-model="tag.name" />
            </td>
            <td>{{ project.name }}</td>
            <td>
              <span
                class="badge"
                v-bind:style="{ 'background-color': tag.color }"
                >{{ tag.color }}</span
              >
            </td>
            <td class="text-center" v-if="$page.user.id == project.manager.id">
              <div @click="editTags(tag)" v-if="UpdateForm.id !== tag.id">
                <i class="far fa-edit" aria-hidden="true"></i>
              </div>
              <div @click="UpdateTags" v-else>
                <i class="far fa-save" aria-hidden="true"></i>
              </div>
            </td>
            <td class="text-center" v-if="$page.user.id == project.manager.id">
              <div @click="DestroyTags(tag)" v-if="UpdateForm.id !== tag.id">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </div>
              <div @click="Discard" v-else>
                <i class="fas fa-undo-alt" aria-hidden="true"></i>
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
// List Component
import TableResponsive from "@/Jetstream/TableResponsive";
// Module
import draggable from "vuedraggable";
// Page Component
import CreateStage from "./CreateStage";

export default {
  props: ["team", "users", "project", "tags"],

  components: {
    JetDashboard,
    CreateStage,
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
      TaskUpdate: this.$inertia.form({
        id: "",
        stage_id: "",
      }),
      form: this.$inertia.form(
        {
          id: "",
          name: "",
        },
        {
          bag: "deleteTask",
        }
      ),
      UpdateForm: this.$inertia.form(
        {
          //
        },
        {
          bag: "deleteTask",
        }
      ),
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
    DestroyTags(stage) {
      this.form.delete(route("tags.destroy", stage), {
        preserveScroll: true,
      });
    },
    editTags(stage) {
      this.UpdateForm = stage;
    },
    UpdateTags() {
      this.$inertia
        .post(route("tags.update"), {
          id: this.UpdateForm.id,
          name: this.UpdateForm.name,
          preserveScroll: true,
        })
        .then((response) => {
          this.Discard();
        });
    },
    Discard() {
      this.UpdateForm = this.$inertia.form(
        {
          //
        },
        {
          bag: "deleteTask",
        }
      );
    },
  },
  computed: {
    filterdata() {
      this.resetPagination();
      let value = this.tags;
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
