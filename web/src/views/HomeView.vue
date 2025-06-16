<template>
  <main class="flex-1 flex flex-col gap-6 items-center justify-center px-4 sm:px-6 pb-7">
    <div class="text-center space-y-4">
      <h1 class="text-2xl font-bold">Envie suas intenções!</h1>
      <p class="opacity-60 font-medium">
        Tudo será acessado pelo(a) animador(a) na comunidade, e será lida no seu dia especificado de forma anônima!
      </p>
    </div>

    <div class="max-w-7xl">
      <CreateIntentionForm :churches="churches" />
    </div>
    
    <div v-if="authStore.user?.role === 'admin'" class="w-full flex flex-col gap-5">
      <div class="inline-flex items-center justify-center w-full">
        <hr class="w-full h-px bg-zinc-800 border-0">
        <span class="absolute px-3 font-medium -translate-x-1/2 bg-zinc-950 text-zinc-600 left-1/2">ou</span>
      </div>

      <RouterLink 
        to="/intencoes" 
        class="w-full flex items-center justify-center gap-2 px-4 font-medium text-zinc-400 bg-zinc-900 hover:bg-zinc-900/60 h-12 lg:h-14 rounded"
      >
        <NotepadText class="w-6 h-6" />
        <span class="w-full">Veja todas as intenções</span>
        <ArrowRight class="w-5 h-5 ms-2 rtl:rotate-180" />
      </RouterLink> 
    </div>
  </main>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useAuthStore } from '@/stores/authStore'
import { NotepadText, ArrowRight } from 'lucide-vue-next'
import CreateIntentionForm from '@/components/forms/CreateIntentionForm.vue'
import api from '@/services/api'
import { toast } from 'vue-sonner'
import type { Church } from '@/types/models'
import type { ApiResponse } from '@/types/api'

const authStore = useAuthStore()
const churches = ref<Church[]>([])

onMounted(async () => {
  try {
    const response = await api.get<ApiResponse<Church[]>>('/churches');
    churches.value = response.data.data
  } catch (error) {
    toast.error('Erro ao buscar comunidades!')
  }
})
</script>
