<template>
  <li ref="dropdown" class="dropdown dropdown-notifications c-header-nav-item d-md-down-none mx-2">
    <a class="dropdown-toggle c-header-nav-link" href="#" @click.prevent="toggleDropdown">
      <i :data-count="total" class="c-icon cil-bell notification-icon" :class="{ 'hide-count': !hasUnread }" />
    </a>

    <div class="dropdown-container">
      <div class="dropdown-toolbar">
        <div v-show="hasUnread" class="dropdown-toolbar-actions">
          <a href="#" @click.prevent="markAllRead">Mark all as read</a>
        </div>

        <h3 class="dropdown-toolbar-title">
          Notifications ({{ total }})
        </h3>
      </div>

      <ul class="dropdown-menu">
        <notification v-for="notification in notifications"
                      :key="notification.id"
                      :notification="notification"
                      @read="markAsRead(notification)"
        />

        <li v-if="!hasUnread" class="notification">
          You don't have any unread notifications.
        </li>
      </ul>

      <div v-if="hasUnread" class="dropdown-footer text-center">
        <a href="#" @click.prevent="fetch(null)">View All</a>
      </div>
    </div>
  </li>
</template>

<script>

export default {

  data: () => ({
    total: 0,
    notifications: []
  }),
  props: ['userId'],

  computed: {
    hasUnread () {
      return this.total > 0
    }
  },

  mounted () {
    this.registerServiceWorker()
    this.fetch()

    if (window.Echo) {
      this.listen()
    }

    this.initDropdown()
  },

  methods: {
    /**
     * Register the service worker.
     */
    registerServiceWorker () {
      if (!('serviceWorker' in navigator)) {
        console.log('Service workers aren\'t supported in this browser.')
        return
      }

      navigator.serviceWorker.register('/sw.js')
        .then(() => this.initialiseServiceWorker())
    },

    initialiseServiceWorker () {
      if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
        console.log('Notifications aren\'t supported.')
        return
      }

      if (Notification.permission === 'denied') {
        console.log('The user has blocked notifications.')
        return
      }

      if (!('PushManager' in window)) {
        console.log('Push messaging isn\'t supported.')
        return
      }

      navigator.serviceWorker.ready.then(registration => {
        registration.pushManager.getSubscription()
          .then(subscription => {
            if (!subscription) {
              this.subscribe()
            }
            this.updateSubscription(subscription)

            this.isPushEnabled = true
          })
          .catch(e => {
            console.log('Error during getSubscription()', e)
          })
      })
    },

    /**
     * Subscribe for push notifications.
     */
    subscribe () {
      navigator.serviceWorker.ready.then(registration => {
        const options = { userVisibleOnly: true }
        const vapidPublicKey =process.env.MIX_VAPID_PUBLIC_KEY

        if (vapidPublicKey) {
          options.applicationServerKey = this.urlBase64ToUint8Array(vapidPublicKey)
        }

        registration.pushManager.subscribe(options)
          .then(subscription => {
            this.isPushEnabled = true

            this.updateSubscription(subscription)
          })
          .catch(e => {
            if (Notification.permission === 'denied') {
              console.log('Permission for Notifications was denied')
            } else {
              console.log('Unable to subscribe to push.', e)
            }
          })
      })
    },

    /**
     * Send a request to the server to update user's subscription.
     *
     * @param {PushSubscription} subscription
     */
    updateSubscription (subscription) {
      const key = subscription.getKey('p256dh')
      const token = subscription.getKey('auth')
      const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0]

      const data = {
        endpoint: subscription.endpoint,
        publicKey: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
        authToken: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null,
        contentEncoding
      }
      axios.post('/subscriptions', data)
        .then(() => { })
    },

    urlBase64ToUint8Array (base64String) {
      const padding = '='.repeat((4 - base64String.length % 4) % 4)
      const base64 = (base64String + padding)
        .replace(/-/g, '+')
        .replace(/_/g, '/')
      const rawData = window.atob(base64)
      const outputArray = new Uint8Array(rawData.length)
      for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i)
      }
      return outputArray
    },

    /**
     * Fetch notifications.
     *
     * @param {Number} limit
     */
    fetch (limit = 5) {
      axios.get('/notifications', { params: { limit } })
        .then(({ data: { total, notifications } }) => {
          this.total = total
          this.notifications = notifications.map(({ id, data, created }) => {
            return {
              id: id,
              title: data.title,
              body: data.body,
              created: created,
              action_url: data.action_url
            }
          })
        })
    },

    /**
     * Mark the given notification as read.
     *
     * @param {Object} notification
     */
    markAsRead ({ id }) {
      const index = this.notifications.findIndex(n => n.id === id)

      if (index > -1) {
        this.total--
        this.notifications.splice(index, 1)
        axios.patch(`/notifications/${id}/read`)
      }
    },

    /**
     * Mark all notifications as read.
     */
    markAllRead () {
      this.total = 0
      this.notifications = []

      axios.post('/notifications/mark-all-read')
    },

    /**
     * Listen for Echo push notifications.
     */
    listen () {
      Echo.private(`App.Models.User.${this.userId}`)
        .notification(notification => {
          this.total++
          this.notifications.unshift(notification)
        })
        .listen('NotificationRead', ({ notificationId }) => {
          this.total--

          const index = this.notifications.findIndex(n => n.id === notificationId)
          if (index > -1) {
            this.notifications.splice(index, 1)
          }
        })
        .listen('NotificationReadAll', () => {
          this.total = 0
          this.notifications = []
        })
    },

    /**
     * Initialize the notifications dropdown.
     */
    initDropdown () {
      const dropdown = $(this.$refs.dropdown)

      $(document).on('click', (e) => {
        if (!dropdown.is(e.target) && dropdown.has(e.target).length === 0 &&
          !$(e.target).parent().hasClass('notification-mark-read')) {
          dropdown.removeClass('open')
        }
      })
    },

    /**
     * Toggle the notifications dropdown.
     */
    toggleDropdown () {
      $(this.$refs.dropdown).toggleClass('open')
    }
  }
}
</script>
