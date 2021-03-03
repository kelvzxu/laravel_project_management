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
                      class="btn ds-title far fa-sign-out-alt"
                      style="border: none; outline: none"
                    >
                      Log out
                    </button>
                  </form>
                </div>
              </div>
            </div>
            <slot></slot>
          </div>
          <div class="ds-seconday-menu-wrapper-right"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark";

export default {
  components: {
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