<template>
  <app-layout>
    <app-content>
      <control-panel>
        <template #title
          ><li class="breadcrumb-item active font-weight-bold text-black">
            Kelvin Leonardi Teams
          </li></template
        >
        <template #search>
          <div role="search" class="cp_search_view mb-0" style="display: block">
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
          <div
            role="search"
            class="cp_searchview o_searchview_quick"
            style="display: none"
          >
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
        <template #button>
          <jet-success-button> Create </jet-success-button>
        </template>
      </control-panel>
    </app-content>
  </app-layout>
</template>


<script>
import AppContent from "@/Jetstream/ApplicationContent";
import AppLayout from "@/Layouts/AppLayout";
import ControlPanel from "@/Jetstream/ControlPanel";
import JetSuccessButton from "@/Jetstream/SuccessButton";

export default {
  props: ["sessions"],

  components: {
    AppContent,
    AppLayout,
    ControlPanel,
    JetSuccessButton,
  },
  computed: {
    detectMob() {
      if (window.innerWidth <= 600) {
        let mobile = detectMob();
        return true;
        console.log(mobile);
        console.log(window.innerWidth);
      }
    },
  },
};
</script>
