<template>
  <app-layout>
    <template #header>
      <h2 class="h4 font-weight-bold">
        Profile
      </h2>
    </template>

    <div class="container py-5">
        <div v-if="$page.props.jetstream.canUpdateProfileInformation">
            <update-profile-information-form :user="$page.props.user" />

            <jet-section-border />
        </div>

        <div v-if="$page.props.jetstream.canUpdatePassword">
            <update-password-form />

            <jet-section-border />
        </div>


    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import DeleteUserForm from './DeleteUserForm'
import JetSectionBorder from '@/Jetstream/SectionBorder'
import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm'
import TwoFactorAuthenticationForm from './TwoFactorAuthenticationForm'
import UpdatePasswordForm from './UpdatePasswordForm'
import UpdateProfileInformationForm from './UpdateProfileInformationForm'

export default {
  props: ['sessions'],

  components: {
    AppLayout,
    DeleteUserForm,
    JetSectionBorder,
    LogoutOtherBrowserSessionsForm,
    TwoFactorAuthenticationForm,
    UpdatePasswordForm,
    UpdateProfileInformationForm,
  },
}
</script>
