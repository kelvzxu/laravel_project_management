<template>
  <jet-dashboard>
    <template #workspace_icon>{{ project.name[0] }}</template>
    <template #workspace_name>{{ project.name }}</template>
    <template #workspace_sub_header>
      <jet-workspace-sub-header :project="project" />
    </template>
    <template #board_name>{{ project.name }}</template>
    <template #board_description><b>Project Timesheets</b></template>
    <template #board_subs_images_label>Manager </template>
    <template #board_subs_images>
      <img :src="project.manager.profile_photo_url" class="inner-image" />
    </template>
    <template #board_subs> Member / {{ team.users.length + 1 }} </template>
    <template #board_button>
      <create-timesheet :users="users" :project="project" :team="team" />
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
            <th class="text-center" style="width: 100px">Date</th>
            <th style="width: 171px">Description</th>
            <th style="width: 190px">Project</th>
            <th style="width: 190px">Task</th>
            <th style="width: 190px">Duration (Hours)</th>
            <th style="width: 20px"></th>
            <th style="width: 20px"></th>
          </tr>
        </template>
        <template #content>
          <tr class="data_row" v-for="(timesheet, i) in DataRow" :key="i">
            <td v-if="UpdateForm.id !== timesheet.id">
              {{ timesheet.date }}
            </td>
            <td v-if="UpdateForm.id === timesheet.id">
              <input type="date" class="w-full" v-model="UpdateForm.date" />
            </td>
            <td v-if="UpdateForm.id !== timesheet.id">
              {{ timesheet.name }}
            </td>
            <td v-if="UpdateForm.name === timesheet.name">
              <input type="text" class="w-full" v-model="UpdateForm.name" />
            </td>
            <td>{{ timesheet.project.name }}</td>
            <td v-if="UpdateForm.id !== timesheet.id">
              {{ timesheet.task.name }}
            </td>
            <td v-if="UpdateForm.id === timesheet.id">
              <select v-model="UpdateForm.task_id" class="w-full">
                <option
                  v-for="row in project.task"
                  :select="row.id == UpdateForm.task_id"
                  :key="row.id"
                  :value="row.id"
                >
                  {{ row.name }}
                </option>
              </select>
            </td>
            <td v-if="UpdateForm.id !== timesheet.id" class="text-center">
              {{ FormatHours(timesheet.unit_amount) }}
            </td>
            <td v-if="UpdateForm.name === timesheet.name">
              <input
                type="number"
                style="display: inline; width: 50"
                v-model="UpdateForm.hours"
              />
              <input
                type="number"
                style="display: inline; width: 50"
                v-model="UpdateForm.minutes"
              />
            </td>
            <td class="text-center">
              <div
                @click="editTimesheet(timesheet)"
                v-if="UpdateForm.id !== timesheet.id"
              >
                <i class="far fa-edit" aria-hidden="true"></i>
              </div>
              <div
                @click="UpdateTimesheet"
                v-if="UpdateForm.id === timesheet.id"
              >
                <i class="far fa-save" aria-hidden="true"></i>
              </div>
            </td>
            <td class="text-center">
              <div
                @click="DestroyTimesheet(timesheet)"
                v-if="UpdateForm.id !== timesheet.id"
              >
                <i class="fa fa-trash" aria-hidden="true"></i>
              </div>
              <div @click="Discard" v-if="UpdateForm.id === timesheet.id">
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
import CreateTimesheet from "./CreateTimesheet";

export default {
  props: ["team", "users", "project", "timesheets"],

  components: {
    JetDashboard,
    CreateTimesheet,
    TableResponsive,
    JetBoardSorting,
    JetBoardSearch,
    JetBoardDropdown,
    JetBoardFilterDropdown,
    draggable,
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
  created() {
    console.log(this);
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
    FormatHours(value) {
      let minutes = value * 60;
      return this.time_convert(minutes);
    },
    time_convert(num) {
      let hours = Math.floor(num / 60);
      if (hours < 10) {
        hours = `0${hours}`;
      }
      let minutes = Math.round(num % 60);
      if (minutes < 10) {
        minutes = `0${minutes}`;
      }
      return `${hours}:${minutes}`;
    },
    DestroyTimesheet(timesheet) {
      this.form.delete(route("timesheet.destroy", timesheet), {
        preserveScroll: true,
      });
    },
    editTimesheet(timesheet) {
      delete this.$page.errors[`Timesheet.${timesheet.id}`];
      this.UpdateForm = timesheet;
      let minutes = timesheet.unit_amount * 60;
      console.log(timesheet.unit_amount);
      console.log(Math.floor(minutes / 60));
      this.UpdateForm.hours = Math.floor(minutes / 60);
      this.UpdateForm.minutes = Math.round(minutes % 60);
      console.log(this.UpdateForm);
    },
    UpdateTimesheet() {
      this.$inertia
        .post(route("timesheet.update"), {
          id: this.UpdateForm.id,
          name: this.UpdateForm.name,
          date: this.UpdateForm.date,
          hours: this.UpdateForm.hours,
          minutes: this.UpdateForm.minutes,
          task_id: this.UpdateForm.task_id,
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
      let value = this.timesheets;
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
