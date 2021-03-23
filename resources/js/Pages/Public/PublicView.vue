<template>
  <dashboard :users="users" :view_type="view_type">
    <template #content>
      <div class="user_inner_container mt-5">
        <div class="contact_information_container">
          <h2>Overview</h2>
          <div class="personal-info-field">
            <div class="icon-container">
              <div>
                <i class="fas fa-briefcase contact_info_icon mt-2"></i>
              </div>
            </div>
            <div class="data_container popup_edit_link">
              <div class="data_row_container">
                <div class="profile-field-title">
                  <div class="ds-text-component" dir="auto">
                    <span>Job Title:</span>
                  </div>
                </div>
                <div class="profile-field-content">
                  <span class="value-container"
                    ><span>{{users.original.result.job_title}}</span></span>
                </div>
              </div>
            </div>
          </div>
          <div class="personal-info-field">
            <div class="icon-container">
              <div>
                <i class="fal fa-envelope-open-text contact_info_icon mt-2"></i>
              </div>
            </div>
            <div class="data_container popup_edit_link">
              <div class="data_row_container">
                <div class="profile-field-title">
                  <div class="ds-text-component" dir="auto">
                    <span>Email:</span>
                  </div>
                </div>
                <div class="profile-field-content">
                  <span class="value-container"
                    ><a class="value" :href="'mailto:'+users.original.result.email"
                      ><span>{{users.original.result.email}}</span></a
                    ></span>
                </div>
              </div>
            </div>
          </div>
          <div class="personal-info-field">
            <div class="icon-container">
              <div>
                <i class="fab fa-skype contact_info_icon mt-2"></i>
              </div>
            </div>
            <div class="data_container popup_edit_link">
              <div class="data_row_container">
                <div class="profile-field-title">
                  <div class="ds-text-component" dir="auto">
                    <span>Skype:</span>
                  </div>
                </div>
                <div class="profile-field-content">
                  <span class="value-container"
                    ><span>{{users.original.result.skype}}</span></span>
                </div>
              </div>
            </div>
          </div>
          <div class="personal-info-field">
            <div class="icon-container">
              <div>
                <i class="fab fa-linkedin-in contact_info_icon mt-2"></i>
              </div>
            </div>
            <div class="data_container popup_edit_link">
              <div class="data_row_container">
                <div class="profile-field-title">
                  <div class="ds-text-component" dir="auto">
                    <span>Linkedin:</span>
                  </div>
                </div>
                <div class="profile-field-content">
                  <span class="value-container"
                    ><span>{{users.original.result.linkedin}}</span></span>
                </div>
              </div>
            </div>
          </div>
          <div class="personal-info-field">
            <div class="icon-container">
              <div>
                <i class="fal fa-map-marker-check contact_info_icon mt-2"></i>
              </div>
            </div>
            <div class="data_container popup_edit_link">
              <div class="data_row_container">
                <div class="profile-field-title">
                  <div class="ds-text-component" dir="auto">
                    <span>Location:</span>
                  </div>
                </div>
                <div class="profile-field-content">
                  <span class="value-container"
                    ><span>{{users.original.result.location}}</span></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </dashboard>
</template>

<script>
// Page
import dashboard from "./dashboard";

export default {
  props: ["users", "view_type"],

  components: {
    dashboard,
  },
  created() {
    console.log(this.users)
  }
};
</script>