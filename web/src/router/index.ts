import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/authStore'
import LoginView from '@/views/auth/LoginView.vue'
import AppLayout from '@/views/layouts/AppLayout.vue'
import HomeView from '@/views/HomeView.vue'
import IntentionsView from '@/views/intentions/IntentionsView.vue'
import IntentionsDetails from '@/views/intentions/IntentionsDetails.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      meta: { requiresAuth: false }
    },
    {
      path: '/',
      component: AppLayout,
      meta: { requiresAuth: true },
      children: [
        {
          path: '',
          name: 'home',
          component: HomeView
        },
        {
          path: '/intencoes',
          name: 'intentions',
          component: IntentionsView,
          meta: {
            requiresAuth: true
          }
        },
        {
          path: '/intentions/:date',
          name: 'intentions-details',
          component: IntentionsDetails,
          meta: {
            requiresAuth: true
          }
        }
      ]
    },
  ],
})

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth)

  if (requiresAuth && !authStore.isAuthenticated) {
    next('/login')
  } else if (to.path === '/login' && authStore.isAuthenticated) {
    next('/')
  } else {
    next()
  }
})

export default router
