<template>
  <div>
    <div @click="open = !open" class="relativesidebar-profile-menu-wrapper">
      <slot name="trigger"></slot>
    </div>

    <!-- Full Screen Dropdown Overlay -->
    <!-- <div v-show="open" class="fixed inset-0 z-40" @click="open = false"></div> -->

    <transition
      enter-active-class="transition ease-out duration-200"
      enter-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <div
        class="dialog-node"
        v-show="open"
        style="display: none"
        @click="open = false"
      >
        <div
          tabindex="-1"
          class="ds-dialog-content-wrapper"
          style="position: relative; left: 60px; top: 143px"
        >
          <div class="ds-dialog-content-component">
            <div class="ds-menu-dialog ds-menu-md surface-avatar-menu-dialog">
              <div class="ds-menu-inner">
                <div
                  class="ds-menu-section menu-section-as-wrapper menu-section-header"
                >
                  <div class="ds-menu-column">
                    <div class="ds-menu-item-content">
                      <span class="image-wrapper"
                        ><img
                          class="image-inner"
                          src="https://cdn7.monday.com/images/logos/monday_logo_icon.png"
                      /></span>
                      <div class="menu-item-content-titles-wrapper">
                        <div class="menu-item-content-subtitle">kelvzxu</div>
                      </div>
                    </div>
                  </div>
                  <div class="ds-menu-column menu-column-with-link">
                    <div class="ds-menu-item disable-hover-highlight">
                      <span class="ds-title">Log out</span>
                      <div class="secondary-menu-icon">
                        <i class="far fa-sign-out-alt"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="ds-menu-section menu-section-as-wrapper menu-section-body"
                >
                  <div class="ds-menu-column">
                    <div class="ds-menu-section">
                      <div class="ds-menu-section-title">Account</div>
                      <a href="/users/17864734" class="button_link">
                        <div class="ds-menu-item">
                          <div class="ds-icon"><i class="far fa-user"></i></div>
                          <span class="ds-title">My profile</span>
                        </div> </a
                      ><a
                        href="/integration_groups/imports"
                        class="button_link"
                      >
                        <div class="ds-menu-item">
                          <div class="ds-icon">
                            <i class="fal fa-download"></i>
                          </div>
                          <span class="ds-title">Import data</span>
                        </div>
                      </a>
                      <div class="ds-menu-item">
                        <div class="ds-icon"><i class="fa fa-code"></i></div>
                        <span class="ds-title">Developers</span>
                      </div>
                      <a href="/recycle_bin" class="button_link">
                        <div class="ds-menu-item">
                          <div class="ds-icon">
                            <i class="far fa-trash"></i>
                          </div>
                          <span class="ds-title">Recycle bin</span>
                        </div>
                      </a>
                      <a href="#" class="button_link">
                        <div class="ds-menu-item">
                          <div class="ds-icon">
                            <i class="fal fa-archive"></i>
                          </div>
                          <span class="ds-title">Archived boards</span>
                        </div>
                      </a>
                      <div class="ds-menu-item">
                        <div class="ds-icon"><i class="fal fa-clock"></i></div>
                        <span class="ds-title">Active Session</span>
                      </div>
                      <div class="ds-menu-item">
                        <div class="ds-icon">
                          <i class="fal fa-lock-alt"></i>
                        </div>
                        <span class="ds-title">Security</span>
                      </div>
                    </div>
                  </div>
                  <div class="ds-menu-column menu-section-short-divider">
                    <div class="ds-menu-section">
                      <div class="ds-menu-section-title">Explore</div>
                      <div class="ds-menu-item">
                        <div class="ds-icon">
                          <i class="icon icon-present"></i>
                        </div>
                        <span class="ds-title">
                          <div class="whats-new-title-wrapper">
                            <span class="whats-new-title">What's new</span>
                            <div class="whats-new-title-dot"></div>
                          </div>
                        </span>
                      </div>
                      <div class="ds-menu-item">
                        <div class="ds-icon">
                          <i class="icon icon-dapulse-keyboard-no-keys"></i>
                        </div>
                        <span class="ds-title">Shortcuts</span>
                      </div>
                      <div class="ds-menu-item">
                        <div class="ds-icon">
                          <i class="far fa-user-plus"></i>
                        </div>
                        <span class="ds-title">Invite members</span>
                      </div>
                      <div class="ds-menu-item">
                        <div class="ds-icon">
                          <i class="fal fa-headset"></i>
                        </div>
                        <span class="ds-title">Contact sales</span>
                      </div>
                    </div>
                    <div class="new-upgrade-button-container" submenuindex="0">
                      <button
                        type="button"
                        class="new-upgrade-button monday-style-button monday-style-button--size-md monday-style-button--kind-primary monday-style-button--color-positive"
                        name=""
                        id=""
                        aria-labelledby=""
                        aria-label=""
                        aria-busy="false"
                        style="
                          --element-width: 159.797px;
                          --element-height: 40px;
                        "
                      >
                        <span
                          class="icon_component monday-style-button--left-icon icon_component--no-focus-style fa icon-upgrade-stars-new"
                          aria-label=""
                          tabindex="-1"
                          role=""
                        ></span
                        >Upgrade
                      </button>
                    </div>
                  </div>
                </div>
                <!-- <div class="ds-menu-section menu-section-footer">
                                <div class="ds-menu-section-title">Working status</div>
                                <div class="do-not-disturb-fast-settings-container"><i
                                        class="icon icon-v2-surfce-notifications dnd-icon"></i><span class="dnd-title">Do not
                                        disturb</span>
                                    <div class="radio-button-component"><label
                                            class="monday-style-radio-button-component dnd-radio"><span
                                                class="monday-style-radio-button-component__radio-input-container"><input
                                                    class="monday-style-radio-button-component__radio-input-container__radio-input"
                                                    type="radio" name="dnd" value=""><span
                                                    class="monday-style-radio-button-component__radio-input-container__radio-control"></span></span><span
                                                class="monday-style-radio-button-component__radio-label">On</span></label></div>
                                    <div class="radio-button-component"><label
                                            class="monday-style-radio-button-component dnd-radio"><span
                                                class="monday-style-radio-button-component__radio-input-container"><input
                                                    class="monday-style-radio-button-component__radio-input-container__radio-input"
                                                    type="radio" name="dnd" value="" checked=""><span
                                                    class="monday-style-radio-button-component__radio-input-container__radio-control"></span></span><span
                                                class="monday-style-radio-button-component__radio-label">Off</span></label>
                                    </div>
                                    <div class="more-working-status"><a href="/users/17864734/settings/working_status/"
                                            class="button_link">
                                            <div class="ds-menu-item more-working-status"><span class="ds-title">More</span>
                                                <div class="secondary-menu-icon"><i class="icon-list-arrow"></i></div>
                                            </div>
                                        </a></div>
                                </div>
                            </div> -->
              </div>
              <div class="ds-seconday-menu-wrapper-right"></div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  data() {
    return {
      open: false,
    };
  },

  created() {
    const closeOnEscape = (e) => {
      if (this.open && e.keyCode === 27) {
        this.open = false;
      }
    };

    this.$once("hook:destroyed", () => {
      document.removeEventListener("keydown", closeOnEscape);
    });

    document.addEventListener("keydown", closeOnEscape);
  },
};
</script>
