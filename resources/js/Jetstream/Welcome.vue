<template>
  <div
    class="first-level-content-wrapper first-level-control-pinned"
    id="first-level-content-wrapper"
  >
    <div
      class="first-level-content-header"
      id="first-level-content-header"
    ></div>
    <div id="board-view-ui-container"></div>
    <div
      class="first-level-content react-board"
      id="first-level-content"
      style="margin-right: 0px"
    >
      <div class="current-board-component" id="current-board-component-id">
        <div tabindex="-1" class="board-with-keyboard-navigation-component">
          <div class="board-with-keyboard-overlay"></div>
          <div id="board-wrapper-first-level-content" class="board-wrapper">
            <div>
              <div class="board-subscribers-dialog-component"></div>
              <div class="templates-creation-onboarding-dialog-component"></div>
            </div>
            <div id="board-header" class="board-header collapse-mode-enabled">
              <div class="board-header-top"></div>
              <div
                class="board-header-content-wrapper monday-board-header-content-wrapper-v2"
              >
                <div class="board-header-main">
                  <div class="board-header-top">
                    <div class="board-header-left">
                      <div class="board-name">
                        <div
                          class="ds-editable-component"
                          style="width: auto; height: auto"
                        >
                          <div class="ds-text-component" dir="auto">
                            <span>{{ team.name }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="board-header-right" id="board-header-right">
                      <div class="board-actions-v2">
                        <div
                          class="subscribers-images-component subscribers-images-component-v2"
                        >
                          <div class="subscribers-overlap-images-wrapper">
                            <div class="board-header-label">
                              <div class="label-text">Last seen</div>
                              <div class="label-labeled">
                                <div class="overlap-images-component">
                                  <div class="overlap-images-wrapper">
                                    <div
                                      class="overlap-image"
                                      style="
                                        height: 30px;
                                        width: 30px;
                                        margin: 0px;
                                      "
                                    >
                                      <img
                                        :src="$page.user.profile_photo_url"
                                        class="inner-image"
                                      />
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div
                          class="board-actions-section subscribers-list-wrapper"
                        >
                          <div class="monday-board-control">
                            <div class="monday-board-control__icon">
                              <i class="fa fa-users"></i>
                            </div>
                            <div class="monday-board-control__text">
                              Member / 1
                            </div>
                          </div>
                        </div>
                        <div class="monday-add-to-board-wrapper">
                          <div
                            class="monday-add-to-board-menu"
                            id="monday-add-to-board-menu-container"
                          >
                            <div class="ds-menu-button-container">
                              <div class="monday-add-to-board-menu-button">
                                <div class="monday-board-control">
                                  <div class="monday-board-control__icon">
                                    <i class="fa fa-plus-square"></i>
                                  </div>
                                  <div class="monday-board-control__text">
                                    Add Projects
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="board-menu" id="current-board-menu-button">
                          <div class="ds-menu-button-container">
                            <a class="board-menu-button fullscreen-views"
                              ><span
                                class="icon ellipsis icon-v2-ellipsis"
                              ></span
                            ></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="board-description can-edit">
                      <div
                        class="ds-editable-component"
                        style="width: auto; height: auto"
                      >
                        <div class="ds-text-component description-content">
                          <div class="description-line">
                            <span class="text-content"
                              >{{ team.description }}</span
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="monday-board-subset-toolbar">
                  <div class="monday-board-subset-toolbar__subset-picker">
                    <div class="board-subset-picker-component-v2">
                      <div class="board-subset-picker-button">
                        <div class="board-subset-picker-switch">
                          <div class="board-subset-picker-switch__icon">
                            <i class="icon icon-v2-hamburger-menu"></i>
                          </div>
                          <div class="board-subset-picker-switch__text">
                            <div class="ds-text-component" dir="auto">
                              <span>All Views</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="monday-board-subset-toolbar__separator"></div>
                  <div class="monday-board-subset-toolbar__pinned-subsets">
                    <div class="monday-board-pinned-subsets">
                      <div class="monday-board-subset-item">
                        <button
                          type="button"
                          class="monday-board-subset-item__button monday-style-button monday-style-button--size-md monday-style-button--kind-tertiary monday-style-button--color-primary"
                          name=""
                          id=""
                          aria-labelledby=""
                          aria-label=""
                          aria-busy="false"
                          style="
                            width: 128.031px;
                            --element-width: 128.031px;
                            --element-height: 40px;
                          "
                        >
                          <div class="monday-board-subset-item__left-icon">
                            <i class="icon-v2-view-table"></i>
                            <div
                              class="monday-board-subset-item__subset-additional-icon monday-board-subset-item__home-icon"
                            >
                              <i class="icon icon-v2-default-view-house"></i>
                            </div>
                          </div>
                          <div class="monday-board-subset-item__label">
                            <div
                              class="ds-editable-component subset-name"
                              style="width: auto; height: auto"
                            >
                              <div class="ds-text-component" dir="auto">
                                <span>Main Table</span>
                              </div>
                            </div>
                          </div>
                          <div class="ds-menu-button-container">
                            <div
                              class="monday-board-subset-item__options-button menu-subset-edit-options-button-container menu-subset-edit-options-button-container-with-subset-id"
                            >
                              <span
                                class="icon ellipsis icon-v2-ellipsis menu-subset-edit-options-button"
                              ></span>
                            </div>
                          </div>
                        </button>
                      </div>
                      <div
                        class="monday-board-subset-item monday-board-subset-item--active"
                      >
                        <button
                          type="button"
                          class="monday-board-subset-item__button monday-style-button monday-style-button--size-md monday-style-button--kind-tertiary monday-style-button--color-primary"
                          name=""
                          id=""
                          aria-labelledby=""
                          aria-label=""
                          aria-busy="false"
                          style="
                            width: 107.312px;
                            --element-width: 107.313px;
                            --element-height: 40px;
                          "
                        >
                          <div class="monday-board-subset-item__left-icon">
                            <i class="icon icon-v2-line-kanban"></i>
                            <div
                              class="monday-board-subset-item__subset-additional-icon monday-board-subset-item__pinned-icon"
                            >
                              <i class="icon icon-v2-pin-with-fill"></i>
                            </div>
                          </div>
                          <div class="monday-board-subset-item__label">
                            <div
                              class="ds-editable-component subset-name"
                              style="width: auto; height: auto"
                            >
                              <div class="ds-text-component" dir="auto">
                                <span>Kanban</span>
                              </div>
                            </div>
                          </div>
                          <div class="ds-menu-button-container">
                            <div
                              class="monday-board-subset-item__options-button menu-subset-edit-options-button-container menu-subset-edit-options-button-container-with-subset-id"
                            >
                              <span
                                class="icon ellipsis icon-v2-ellipsis menu-subset-edit-options-button"
                              ></span>
                            </div>
                          </div>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div
                    class="monday-subset-toolbar-extended collapse-mode-enabled"
                  >
                    <div
                      class="monday-subset-toolbar-extended__automations-integrations"
                    >
                      <div class="automations-button-component">
                        <div class="automations-buttons-inner">
                          <div class="integrations-button">
                            <div class="integrations-button-content">
                              <span
                                class="entity-icon icon icon-dapulse-integrations"
                              ></span
                              >Integrate
                              <div class="apps-badges-container">
                                <div class="integration-badges-component">
                                  <div class="integration-badge-container">
                                    <div class="hexagon-container disabled">
                                      <svg
                                        width="40"
                                        height="40"
                                        viewBox="0 0 54 50"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                      >
                                        <g filter="url(#filter0_d)">
                                          <path
                                            d="M29.004 5.5359L43.0081 13.6211C44.2457 14.3357 45.0081 15.6562 45.0081 17.0852V33.2557C45.0081 34.6848 44.2457 36.0053 43.0081 36.7198L29.004 44.805C27.7664 45.5196 26.2416 45.5196 25.004 44.805L11 36.7198C9.7624 36.0053 9 34.6848 9 33.2557V17.0852C9 15.6562 9.7624 14.3357 11 13.6211L25.004 5.5359C26.2416 4.82137 27.7664 4.82137 29.004 5.5359Z"
                                            fill="var(--primary-background-color)"
                                            stroke="var(--layout-border-color)"
                                            stroke-width="2"
                                          ></path>
                                        </g>
                                        <defs>
                                          <filter
                                            id="filter0_d"
                                            x="0"
                                            y="0"
                                            width="49.0081"
                                            height="53.3409"
                                            filterUnits="userSpaceOnUse"
                                            color-interpolation-filters="sRGB"
                                          >
                                            <feFlood
                                              flood-opacity="0"
                                              result="BackgroundImageFix"
                                            ></feFlood>
                                            <feColorMatrix
                                              in="SourceAlpha"
                                              type="matrix"
                                              values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                            ></feColorMatrix>
                                            <feOffset dy="0"></feOffset>
                                            <feGaussianBlur
                                              stdDeviation="0"
                                            ></feGaussianBlur>
                                            <feColorMatrix
                                              type="matrix"
                                              values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0"
                                            ></feColorMatrix>
                                            <feBlend
                                              mode="normal"
                                              in2="BackgroundImageFix"
                                              result="effect1_dropShadow"
                                            ></feBlend>
                                            <feBlend
                                              mode="normal"
                                              in="SourceGraphic"
                                              in2="effect1_dropShadow"
                                              result="shape"
                                            ></feBlend>
                                          </filter>
                                        </defs></svg
                                      ><img
                                        class="integration-logo"
                                        :src="$page.user.profile_photo_url"
                                      />
                                    </div>
                                  </div>
                                  <div class="integration-badge-container">
                                    <div class="hexagon-container disabled">
                                      <svg
                                        width="40"
                                        height="40"
                                        viewBox="0 0 54 50"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                      >
                                        <g filter="url(#filter0_d)">
                                          <path
                                            d="M29.004 5.5359L43.0081 13.6211C44.2457 14.3357 45.0081 15.6562 45.0081 17.0852V33.2557C45.0081 34.6848 44.2457 36.0053 43.0081 36.7198L29.004 44.805C27.7664 45.5196 26.2416 45.5196 25.004 44.805L11 36.7198C9.7624 36.0053 9 34.6848 9 33.2557V17.0852C9 15.6562 9.7624 14.3357 11 13.6211L25.004 5.5359C26.2416 4.82137 27.7664 4.82137 29.004 5.5359Z"
                                            fill="var(--primary-background-color)"
                                            stroke="var(--layout-border-color)"
                                            stroke-width="2"
                                          ></path>
                                        </g>
                                        <defs>
                                          <filter
                                            id="filter0_d"
                                            x="0"
                                            y="0"
                                            width="49.0081"
                                            height="53.3409"
                                            filterUnits="userSpaceOnUse"
                                            color-interpolation-filters="sRGB"
                                          >
                                            <feFlood
                                              flood-opacity="0"
                                              result="BackgroundImageFix"
                                            ></feFlood>
                                            <feColorMatrix
                                              in="SourceAlpha"
                                              type="matrix"
                                              values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                            ></feColorMatrix>
                                            <feOffset dy="0"></feOffset>
                                            <feGaussianBlur
                                              stdDeviation="0"
                                            ></feGaussianBlur>
                                            <feColorMatrix
                                              type="matrix"
                                              values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0"
                                            ></feColorMatrix>
                                            <feBlend
                                              mode="normal"
                                              in2="BackgroundImageFix"
                                              result="effect1_dropShadow"
                                            ></feBlend>
                                            <feBlend
                                              mode="normal"
                                              in="SourceGraphic"
                                              in2="effect1_dropShadow"
                                              result="shape"
                                            ></feBlend>
                                          </filter>
                                        </defs></svg
                                      ><img
                                        class="integration-logo"
                                        :src="$page.user.profile_photo_url"
                                      />
                                    </div>
                                  </div>
                                  <div class="integration-badge-container">
                                    <div class="hexagon-container disabled">
                                      <svg
                                        width="40"
                                        height="40"
                                        viewBox="0 0 54 50"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                      >
                                        <g filter="url(#filter0_d)">
                                          <path
                                            d="M29.004 5.5359L43.0081 13.6211C44.2457 14.3357 45.0081 15.6562 45.0081 17.0852V33.2557C45.0081 34.6848 44.2457 36.0053 43.0081 36.7198L29.004 44.805C27.7664 45.5196 26.2416 45.5196 25.004 44.805L11 36.7198C9.7624 36.0053 9 34.6848 9 33.2557V17.0852C9 15.6562 9.7624 14.3357 11 13.6211L25.004 5.5359C26.2416 4.82137 27.7664 4.82137 29.004 5.5359Z"
                                            fill="var(--primary-background-color)"
                                            stroke="var(--layout-border-color)"
                                            stroke-width="2"
                                          ></path>
                                        </g>
                                        <defs>
                                          <filter
                                            id="filter0_d"
                                            x="0"
                                            y="0"
                                            width="49.0081"
                                            height="53.3409"
                                            filterUnits="userSpaceOnUse"
                                            color-interpolation-filters="sRGB"
                                          >
                                            <feFlood
                                              flood-opacity="0"
                                              result="BackgroundImageFix"
                                            ></feFlood>
                                            <feColorMatrix
                                              in="SourceAlpha"
                                              type="matrix"
                                              values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                            ></feColorMatrix>
                                            <feOffset dy="0"></feOffset>
                                            <feGaussianBlur
                                              stdDeviation="0"
                                            ></feGaussianBlur>
                                            <feColorMatrix
                                              type="matrix"
                                              values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0"
                                            ></feColorMatrix>
                                            <feBlend
                                              mode="normal"
                                              in2="BackgroundImageFix"
                                              result="effect1_dropShadow"
                                            ></feBlend>
                                            <feBlend
                                              mode="normal"
                                              in="SourceGraphic"
                                              in2="effect1_dropShadow"
                                              result="shape"
                                            ></feBlend>
                                          </filter>
                                        </defs></svg
                                      ><img
                                        :src="$page.user.profile_photo_url"
                                      />
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="automations-button">
                            <span class="button-label"
                              ><span
                                class="entity-icon icon icon icon-autopilot"
                              ></span>
                              <div class="automations-button-text">
                                Automate
                              </div>
                              <span class="entity-counter">/ 1</span>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="board-header-collapse-mode-button-component monday-subset-toolbar-extended__collapse-header-btn expand-mode"
                    >
                      <i class="collapse-icon fa fa-angle-right"></i>
                    </div>
                  </div>
                </div> -->
                <div class="board-header-view-bar">
                  <div class="board-filter new-board-filter monday-v2-header">
                    <div class="board-subset-left-side-container"></div>
                    <!-- <div class="add-board-entity-button-wrapper">
                      <div class="add-task-button-component">
                        <button
                          type="button"
                          class="add-with-dropdown monday-style-button monday-style-button--size-sm monday-style-button--kind-primary monday-style-button--color-primary"
                          name=""
                          id=""
                          aria-labelledby=""
                          aria-label=""
                          aria-busy="false"
                          style="
                            --element-width: 75.4531px;
                            --element-height: 32px;
                          "
                        >
                          New Item
                        </button>
                        <div class="ds-menu-button-container">
                          <div class="dropdown-button small-button">
                            <i class="fa fa-angle-down"></i>
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <div class="filter-buttons-wrapper">
                      <div
                        class="board-filter-input-container board-filter-search board-filter-input-container--expandable"
                      >
                        <span class="fa fa-search"></span>
                        <div class="board-filter-input-wrapper_v2">
                          <div class="icon-and-input-wrapper">
                            <input placeholder="Search" value="" />
                          </div>
                        </div>
                      </div>
                      <div
                        class="board-filter-item-component rule-based-filer-component"
                      >
                        <div class="board-filter-item-content-wrapper">
                          <div
                            class="board-filter-item-content rule-based-filer-component with-caret show-title-when-closed show-title-when-open"
                          >
                            <i class="item-icon fa fa-filter"></i
                            ><span class="item-title">Filter</span>
                            <div class="caret-icon-container">
                              <i class="fa fa-angle-down"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div
                        class="board-filter-item-component sort-settings-component"
                      >
                        <div class="board-filter-item-content-wrapper">
                          <div
                            class="board-filter-item-content sort-settings-component show-title-when-closed show-title-when-open"
                          >
                            <i
                              class="item-icon fas fa-sort-alt"
                            ></i
                            ><span class="item-title">Sort</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="board-header-view-actions-wrapper">
                    <div class="board-header-view-actions">
                      <div class="board-filter-item-component active">
                        <div class="board-filter-item-content-wrapper">
                          <div
                            class="board-filter-item-content without-additional-data"
                          >
                            <i
                              class="item-icon fa fa-lg fa-th-large"
                            ></i>
                          </div>
                        </div>
                      </div>
                      <div class="board-filter-item-component">
                        <div class="board-filter-item-content-wrapper">
                          <div
                            class="board-filter-item-content without-additional-data"
                          >
                            <i
                              class="item-icon fa fa-lg fa-list-ul"
                            ></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <kanban-area>
              <kanban-box >
              <template #jobs
                ><span>Project Tugas</span></template
              >
              <template #tags
                ><span class="field_tag tag_color_6"
                  ><span></span>Kelvin Leonardi</span
                ></template
              >

            </kanban-box>
            <kanban-box >
              <template #jobs
                ><span>Project Tugas 2</span></template
              >
              <template #tags
                ><span class="field_tag tag_color_6"
                  ><span></span>Kelvin Leonardi</span
                ></template
              >

            </kanban-box>
            <kanban-box >
              <template #jobs
                ><span>Project Tugas 3</span></template
              >
              <template #tags
                ><span class="field_tag tag_color_6"
                  ><span></span>Kelvin Leonardi</span
                ></template
              >

            </kanban-box>
            <kanban-box >
              <template #jobs
                ><span>Project Tugas 4</span></template
              >
              <template #tags
                ><span class="field_tag tag_color_6"
                  ><span></span>Kelvin Leonardi</span
                ></template
              >

            </kanban-box>
            <kanban-box >
              <template #jobs
                ><span>Project Tugas 5</span></template
              >
              <template #tags
                ><span class="field_tag tag_color_6"
                  ><span></span>Kelvin Leonardi</span
                ></template
              >

            </kanban-box>
            <kanban-ghost
              v-for="n in 75"
              :key="n"
            ></kanban-ghost>
          </kanban-area> -->
          </div>
        </div>
      </div>
    </div>

    <div id="thumbnail-container"></div>
    <div id="video-center-button-container"></div>
    <div id="monday-only-bug-button-container"></div>
  </div>
</template>

<script>
import JetApplicationLogo from "@/Jetstream/ApplicationLogo";
// Kanban Component
import KanbanArea from "@/Jetstream/KanbanArea";
import KanbanBox from "@/Jetstream/KanbanBox";
import KanbanGhost from "@/Jetstream/KanbanGhost";

export default {
  props: ["team", "users"],

  components: {
    JetApplicationLogo,
    KanbanArea,
    KanbanBox,
    KanbanGhost,
  },
  created() {
    console.log(this)
  },
};
</script>
