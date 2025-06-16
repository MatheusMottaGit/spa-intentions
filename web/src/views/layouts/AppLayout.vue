<template>
  <div class="font-inter bg-zinc-950 text-white min-h-screen flex flex-col">
    <header class="w-full flex flex-col sm:flex-row sm:items-center sm:justify-between mx-auto p-4">
      <div class="flex items-start">
        <img src="@/assets/logo.svg" class="h-28" alt="Logo">
        <div class="flex flex-col gap-1 items-start mt-3">
          <span class="font-bold">{{ authStore.user?.name }}</span>
          <button 
            @click="handleLogout" 
            class="text-red-500 underline font-medium"
          >
            Sair
          </button>
        </div>
      </div>
    </header>

    <main class="flex-1">
      <RouterView />
    </main>
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/stores/authStore'
import { useRouter } from 'vue-router'

const authStore = useAuthStore()
const router = useRouter()

const handleLogout = () => {
  authStore.logout()
  router.push('/login')
}
</script>
