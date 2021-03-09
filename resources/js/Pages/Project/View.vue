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
              Project Detail
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
          <template #button>
            <inertia-link
              class="btn btn-primary rounded"
              :href="route('teams.create')"
            >
              Create
            </inertia-link>
          </template>
        </control-panel>
        <div class="o_not_full oe_button_box mt-1">
          <button
            type="button"
            class="btn oe_stat_button"
            name="attachment_tree_view"
          >
            <i class="fas fa-fw o_button_icon fa-tasks-alt"></i>
            <div
              name="doc_count"
              class="o_field_widget o_stat_info o_readonly_modifier"
              data-original-title=""
              title=""
            >
              <span class="o_stat_value">1</span>
              <span class="o_stat_text">Documents</span>
            </div>
          </button>
          <button
            type="button"
            class="btn oe_stat_button"
            name="attachment_tree_view"
          >
            <i class="fa fa-fw o_button_icon fa-file-text-o"></i>
            <div
              name="doc_count"
              class="o_field_widget o_stat_info o_readonly_modifier"
              data-original-title=""
              title=""
            >
              <span class="o_stat_value">1</span>
              <span class="o_stat_text">Documents</span>
            </div>
          </button>
        </div>
        <div class="mt-5 mt-md-4">
          <div class="oe_title">
            <div class="col-12">
              <h1>
                <input
                  class="o_field_char o_field_widget o_input o_required_modifier"
                  name="name"
                  placeholder="Project Name"
                  type="text"
                  autocomplete="none"
                  id="o_field_input_698"
                  data-original-title=""
                  title=""
                />
              </h1>
              <div name="options_active">
                <div>
                  <label
                    class="o_form_label oe_inline"
                    for="o_field_input_663"
                    data-original-title=""
                    title=""
                    >Name of the tasks:</label
                  ><input
                    class="o_field_char o_field_widget o_input o_field_translate oe_inline oe_input_align"
                    name="label_tasks"
                    placeholder=""
                    type="text"
                    autocomplete="none"
                    id="o_field_input_663"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="o_notebook" data-name="_default_">
            <div class="o_notebook_headers">
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a
                    data-toggle="tab"
                    disable_anchor="true"
                    class="nav-link"
                    :class="{ active: ViewDescription == true }"
                    role="tab"
                    @click="DescriptionPage"
                    >Description</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    data-toggle="tab"
                    disable_anchor="true"
                    class="nav-link"
                    :class="{ active: ViewSetting == true }"
                    role="tab"
                    @click="SettingPage"
                    >Setting</a
                  >
                </li>
              </ul>
            </div>
            <div class="tab-content">
              <div
                class="tab-pane"
                :class="{ active: ViewDescription == true }"
                id="notebook_page_team"
              ></div>
              <div
                class="tab-pane"
                :class="{ active: ViewSetting == true }"
                id="notebook_page_project"
              >
                <div class="o_group">
                  <table class="o_group o_inner_group o_group_col_6">
                    <tbody>
                      <tr>
                        <td class="o_td_label"></td>
                        <td style="width: 100%"></td>
                      </tr>
                      <tr>
                        <td class="o_td_label">
                          <label
                            class="o_form_label"
                            for="o_field_input_667"
                            data-original-title=""
                            title=""
                            >Project Manager</label
                          >
                        </td>
                        <td style="width: 100%">
                          <div
                            class="o_field_widget o_field_many2one"
                            aria-atomic="true"
                            name="user_id"
                          >
                            <div class="o_input_dropdown">
                              <input
                                type="text"
                                class="o_input ui-autocomplete-input"
                                autocomplete="off"
                                id="o_field_input_667"
                              />
                              <a
                                role="button"
                                class="o_dropdown_button"
                                draggable="false"
                              ></a>
                            </div>
                            <button
                              type="button"
                              class="fa fa-external-link btn btn-secondary o_external_button"
                              tabindex="-1"
                              draggable="false"
                              aria-label="External link"
                              title="External link"
                              style="display: none"
                            ></button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="o_td_label">
                          <label
                            class="o_form_label"
                            for="o_field_input_668"
                            data-original-title=""
                            title=""
                            >Customer</label
                          >
                        </td>
                        <td style="width: 100%">
                          <div
                            class="o_field_widget o_field_many2one"
                            aria-atomic="true"
                            name="partner_id"
                          >
                            <div class="o_input_dropdown">
                              <input
                                type="text"
                                class="o_input ui-autocomplete-input"
                                autocomplete="off"
                                id="o_field_input_668"
                              />
                              <a
                                role="button"
                                class="o_dropdown_button"
                                draggable="false"
                              ></a>
                            </div>
                            <button
                              type="button"
                              class="fa fa-external-link btn btn-secondary o_external_button"
                              tabindex="-1"
                              draggable="false"
                              aria-label="External link"
                              title="External link"
                              style="display: none"
                            ></button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="o_td_label">
                          <label
                            class="o_form_label o_invisible_modifier"
                            for="o_field_input_669"
                            data-original-title=""
                            title=""
                            >Phone</label
                          >
                        </td>
                        <td style="width: 100%">
                          <input
                            class="o_field_phone o_field_widget o_input o_invisible_modifier"
                            name="partner_phone"
                            placeholder=""
                            type="text"
                            autocomplete="none"
                            id="o_field_input_669"
                          />
                        </td>
                      </tr>
                      <tr>
                        <td class="o_td_label">
                          <label
                            class="o_form_label o_invisible_modifier"
                            for="o_field_input_670"
                            data-original-title=""
                            title=""
                            >Email</label
                          >
                        </td>
                        <td style="width: 100%">
                          <input
                            class="o_field_email o_field_widget o_input o_invisible_modifier"
                            name="partner_email"
                            placeholder=""
                            type="text"
                            autocomplete="none"
                            id="o_field_input_670"
                          />
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2" style="width: 100%">
                          <div
                            name="alias_def"
                            colspan="2"
                            attrs="{'invisible': [('alias_domain', '=', False)]}"
                            class="o_invisible_modifier"
                          >
                            <label
                              class="o_form_label font-weight-bold"
                              for="o_field_input_671"
                              >Create tasks by sending an email</label
                            ><span
                              ><span
                                class="font-weight-bold oe_read_only o_invisible_modifier"
                                attrs="{'invisible':  [('alias_name', '=', False)]}"
                                >to </span
                              ><span class="font-weight-bold oe_edit_only"
                                >to </span
                              ><input
                                class="o_field_char o_field_widget o_input oe_inline"
                                name="alias_name"
                                placeholder=""
                                type="text"
                                autocomplete="none"
                                id="o_field_input_699"
                                data-original-title=""
                                title="" /><span
                                class="oe_read_only o_invisible_modifier"
                                attrs="{'invisible':  [('alias_name', '=', False)]}"
                                >@</span
                              ><span class="oe_edit_only">@</span
                              ><span
                                class="o_field_char o_field_widget o_invisible_modifier o_readonly_modifier o_field_empty oe_inline oe_read_only"
                                name="alias_domain"
                                data-original-title=""
                                title=""
                              ></span
                              ><span
                                class="o_field_char o_field_widget o_readonly_modifier o_field_empty oe_inline oe_edit_only"
                                name="alias_domain"
                                data-original-title=""
                                title=""
                              ></span
                            ></span>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="o_td_label oe_edit_only">
                          <label
                            class="o_form_label o_invisible_modifier o_required_modifier"
                            for="o_field_input_672"
                            data-original-title=""
                            title=""
                            >Accept Emails From</label
                          >
                        </td>
                        <td class="oe_edit_only" style="width: 100%">
                          <select
                            class="o_input o_field_widget o_invisible_modifier o_required_modifier oe_inline oe_edit_only"
                            name="alias_contact"
                            id="o_field_input_672"
                          >
                            <option
                              value="false"
                              style="display: none"
                            ></option>
                            <option value='"everyone"' style="">
                              Everyone
                            </option>
                            <option value='"partners"' style="">
                              Authenticated Partners
                            </option>
                            <option value='"followers"' style="">
                              Followers only
                            </option>
                            <option value='"employees"' style="">
                              Authenticated Employees
                            </option>
                          </select>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="o_group o_inner_group o_group_col_6">
                    <tbody>
                      <tr>
                        <td class="o_td_label"></td>
                        <td style="width: 100%"></td>
                      </tr>
                      <tr>
                        <td class="o_td_label">
                          <label
                            class="o_form_label o_required_modifier"
                            for="o_field_input_674"
                            data-original-title=""
                            title=""
                            >Visibility</label
                          >
                        </td>
                        <td style="width: 100%">
                          <div
                            class="o_field_radio o_vertical o_field_widget o_required_modifier"
                            name="privacy_visibility"
                            role="radiogroup"
                            aria-label="Visibility"
                            id="o_field_input_674"
                          >
                            <div
                              class="custom-control custom-radio o_radio_item"
                              aria-atomic="true"
                            >
                              <input
                                type="radio"
                                class="custom-control-input o_radio_input"
                                name="radio712"
                                data-value="followers"
                                data-index="0"
                                id="radio712_followers"
                              />
                              <label
                                class="custom-control-label o_form_label"
                                for="radio712_followers"
                                >Invited internal users</label
                              >
                            </div>

                            <div
                              class="custom-control custom-radio o_radio_item"
                              aria-atomic="true"
                            >
                              <input
                                type="radio"
                                class="custom-control-input o_radio_input"
                                name="radio712"
                                data-value="employees"
                                data-index="1"
                                id="radio712_employees"
                              />
                              <label
                                class="custom-control-label o_form_label"
                                for="radio712_employees"
                                >All internal users</label
                              >
                            </div>

                            <div
                              class="custom-control custom-radio o_radio_item"
                              aria-atomic="true"
                            >
                              <input
                                type="radio"
                                class="custom-control-input o_radio_input"
                                checked="true"
                                name="radio712"
                                data-value="portal"
                                data-index="2"
                                id="radio712_portal"
                              />
                              <label
                                class="custom-control-label o_form_label"
                                for="radio712_portal"
                                >Invited portal users and all internal
                                users</label
                              >
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="o_td_label">
                          <label
                            class="o_form_label o_invisible_modifier"
                            for="o_field_input_675"
                            data-original-title=""
                            title=""
                            >Allowed Internal Users</label
                          >
                        </td>
                        <td style="width: 100%">
                          <div
                            class="o_field_many2manytags o_input o_field_widget o_invisible_modifier"
                            name="allowed_internal_user_ids"
                          >
                            <div
                              class="badge badge-pill o_tag_color_0"
                              data-color="0"
                              data-index="0"
                              data-id="2"
                              title="Tag color: No color"
                            >
                              <span class="o_badge_text" title="Kelvin Leonardi"
                                ><span
                                  role="img"
                                  aria-label="Tag color: No color"
                                ></span
                                >Kelvin Leonardi</span
                              >

                              <a
                                href="#"
                                class="fa fa-times o_delete"
                                title="Delete"
                                aria-label="Delete"
                              ></a>
                            </div>

                            <div
                              class="o_field_widget o_field_many2one"
                              aria-atomic="true"
                              name="allowed_internal_user_ids"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_675"
                                />
                                <a
                                  role="button"
                                  class="o_dropdown_button"
                                  draggable="false"
                                ></a>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="o_td_label">
                          <label
                            class="o_form_label"
                            for="o_field_input_676"
                            data-original-title=""
                            title=""
                            >Allowed Portal Users</label
                          >
                        </td>
                        <td style="width: 100%">
                          <div
                            class="o_field_many2manytags o_input o_field_widget"
                            name="allowed_portal_user_ids"
                          >
                            <div
                              class="o_field_widget o_field_many2one"
                              aria-atomic="true"
                              name="allowed_portal_user_ids"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_676"
                                />
                                <a
                                  role="button"
                                  class="o_dropdown_button"
                                  draggable="false"
                                ></a>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="o_td_label"></td>
                        <td style="width: 100%"></td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="o_group o_inner_group o_group_col_6">
                    <tbody>
                      <tr></tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </app-content>
  </app-layout>
</template>


<script>
import AppContent from "@/Jetstream/ApplicationContent";
import AppLayout from "@/Layouts/AppLayout";
import ControlPanel from "@/Jetstream/ControlPanel";
import TableResponsive from "@/Jetstream/TableResponsive";
import JetSuccessButton from "@/Jetstream/SuccessButton";

export default {
  props: ["teams"],

  components: {
    AppContent,
    AppLayout,
    ControlPanel,
    TableResponsive,
    JetSuccessButton,
  },
  data() {
    return {
      isMobile: true,
      ViewDescription: true,
      ViewSetting: false,
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
    DescriptionPage() {
      this.ViewDescription = true;
      this.ViewSetting = false;
    },
    SettingPage() {
      this.ViewDescription = false;
      this.ViewSetting = true;
    },
  },
};
</script>
