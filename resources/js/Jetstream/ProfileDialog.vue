<template>
  <div class="dialog-node">
    <div
      tabindex="-1"
      class="ds-dialog-content-wrapper profile-dialog-component"
      style="position: relative; left: 60px"
    >
      <div class="ds-dialog-content-component">
        <div class="ds-menu-dialog ds-menu-md surface-avatar-menu-dialog">
          <div class="ds-menu-inner">
            <div
              class="ds-menu-section menu-section-as-wrapper menu-section-header"
            >
              <div class="ds-menu-column">
                <div class="ds-menu-item-content">
                  <span class="image-wrapper">
                    <jet-application-mark class="image-inner"
                  /></span>
                  <div class="menu-item-content-titles-wrapper">
                    <div class="ml-2 menu-item-content-subtitle">
                      {{ $page.user.name }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="ds-menu-column menu-column-with-link">
                <div class="ds-menu-item disable-hover-highlight">
                  <form method="POST" @submit.prevent="logout">
                    <button
                      class="btn ds-title"
                      style="border: none; outline: none"
                    >
                      <i class="far fa-sign-out-alt"></i>
                      Log out
                    </button>
                  </form>
                </div>
              </div>
            </div>
            <div
              class="ds-menu-section menu-section-as-wrapper menu-section-body"
            >
              <div class="ds-menu-column">
                <div class="ds-menu-section">
                  <div class="ds-menu-section-title">Account</div>
                  <jet-responsive-nav-link
                    :href="route('profile.show')"
                    :active="route().current('profile.show')"
                  >
                    <div class="ds-menu-item">
                      <div class="ds-icon"><i class="far fa-user"></i></div>
                      <span class="ds-title">My profile</span>
                    </div>
                  </jet-responsive-nav-link>
                  <jet-responsive-nav-link
                    :href="route('profile.show')"
                    :active="route().current('profile.show')"
                  >
                    <div class="ds-menu-item">
                      <div class="ds-icon"><i class="fal fa-download"></i></div>
                      <span class="ds-title">Import data</span>
                    </div>
                  </jet-responsive-nav-link>
                  <jet-responsive-nav-link
                    :href="route('api-tokens.index')"
                    :active="route().current('api-tokens.index')"
                  >
                    <div class="ds-menu-item">
                      <div class="ds-icon"><i class="fa fa-code"></i></div>
                      <span class="ds-title">Developers</span>
                    </div>
                  </jet-responsive-nav-link>
                  <a href="/archived_boards" class="button_link">
                    <div class="ds-menu-item">
                      <div class="ds-icon"><i class="fal fa-archive"></i></div>
                      <span class="ds-title">Archived boards</span>
                    </div>
                  </a>
                  <jet-responsive-nav-link
                    :href="route('team.myteam')"
                    :active="route().current('team.myteam')"
                  >
                    <div class="ds-menu-item">
                      <div class="ds-icon"><i class="fa fa-code"></i></div>
                      <span class="ds-title">teams</span>
                    </div>
                  </jet-responsive-nav-link>
                  <jet-responsive-nav-link
                    :href="route('profile.password')"
                    :active="route().current('profile.password')"
                  >
                  <div class="ds-menu-item">
                    <div class="ds-icon"><i class="fal fa-lock-alt"></i></div>
                    <span class="ds-title">Security</span>
                  </div>
                  </jet-responsive-nav-link>
                </div>
              </div>
              <div class="ds-menu-column menu-section-short-divider">
                <div class="ds-menu-section">
                  <div class="ds-menu-section-title">Explore</div>
                  <div class="ds-menu-item">
                    <div class="ds-icon"><i class="icon icon-present"></i></div>
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
                    <div class="ds-icon"><i class="far fa-user-plus"></i></div>
                    <span class="ds-title">Invite members</span>
                  </div>
                  <div class="ds-menu-item">
                    <div class="ds-icon"><i class="fal fa-headset"></i></div>
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
                    style="--element-width: 159.797px; --element-height: 40px"
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
          </div>
          <div class="ds-seconday-menu-wrapper-right"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import JetApplicationMark from "@/Jetstream/ApplicationMark";

export default {
  components: {
    JetResponsiveNavLink,
    JetApplicationMark,
  },

  data() {
    return {
      showingNavigationDropdown: false,
    };
  },
  methods: {
    logout() {
      axios.post(route("logout").url()).then((response) => {
        window.location = "/";
      });
    },
  },
};
</script>