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
                            <span><slot name="board_name"/></span>
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
                              <div class="label-text"><slot name="board_subs_images_label"/></div>
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
                                      <slot name="board_subs_images"/>
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
                              Member / {{ team.users.length + 1 }}
                            </div>
                          </div>
                        </div>
                        <slot name="board_button"/>
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
                            <span class="text-content"><slot name="board_description"/></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="board-header-view-bar">
                  <div class="board-filter new-board-filter monday-v2-header">
                    <div class="board-subset-left-side-container"></div>
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
                            <i class="item-icon fas fa-sort-alt"></i
                            ><span class="item-title">Sort</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="board-header-view-actions-wrapper">
                    <slot name="board_header_action"/>
                  </div>
                </div>
              </div>
            </div>
            <slot name="board_component"/>
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
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSuccessButton from "@/Jetstream/SuccessButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

export default {
  props: ["team", "users","projects"],

  components: {
    JetApplicationLogo,
    JetDialogModal,
    JetSuccessButton,
    JetSecondaryButton,
    JetInput,
    JetInputError,
    JetLabel,
  },
};
</script>
