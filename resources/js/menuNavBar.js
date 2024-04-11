import {
    mdiMenu,
    mdiClockOutline,
    mdiCloud,
    mdiDownloadCircle,
    mdiPrinterOutline,
    mdiCrop,
    mdiAccount,
    mdiCogOutline,
    mdiEmail,
    mdiLogout,
    mdiThemeLightDark,
    mdiGithub,
    mdiHammerWrench
  } from '@mdi/js'

  export default [
    {
      icon: mdiHammerWrench,
      label: 'Tools',
      menu: [
        {
          icon: mdiCrop,
          label: "Capture",
        },
        {
          icon: mdiDownloadCircle,
          label: "Download",
        },
        {
          isDivider: true,
        },
        {
          icon: mdiPrinterOutline,
          label: "Print",
          isPrint: true,
        },
      ],
    },
    {
      isCurrentUser: true,
      menu: [
        {
          icon: mdiAccount,
          label: 'My Profile',
          to: '/admin/edit-account-info'
        },
        {
          icon: mdiCogOutline,
          label: 'Settings'
        },
        {
          icon: mdiEmail,
          label: 'Messages'
        },
        {
          isDivider: true
        },

      ]
    },
    {
      icon: mdiThemeLightDark,
      label: 'Light/Dark',
      isDesktopNoLabel: true,
      isToggleLightDark: true
    },
    // {
    //   icon: mdiGithub,
    //   label: 'GitHub',
    //   isDesktopNoLabel: true,
    //   href: 'https://github.com/balajidharma/laravel-vue-admin-panel',
    //   target: '_blank'
    // },
    // {
    //   icon: mdiLogout,
    //   label: 'Log out',
    //   isDesktopNoLabel: true,
    //   isLogout: true
    // }
  ]
