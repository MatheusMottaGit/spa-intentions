<template>
  <main class="font-inter bg-zinc-950 text-white min-h-screen flex flex-col gap-6 p-4 sm:p-6">
    <div class="flex-1 flex flex-col items-center justify-center gap-12 md:gap-16">
      <div class="w-full max-w-lg flex flex-col gap-5">
        <img src="@/assets/logo.svg" alt="Logo" class="mx-auto size-44">

        <div class="text-center space-y-3">
          <h1 class="font-bold text-3xl">Bem-vindo!</h1>
          <p class="opacity-60 font-medium">
            Siga as instruções do formulário para entrar e registrar as suas intenções para a missa desejada!
          </p>
        </div>
      </div>

      <div class="max-w-6xl">
        <form @submit.prevent="handleSubmit" class="grid gap-4 md:grid-cols-2">
          <div class="space-y-2">
            <Label for="name">Nome</Label>
            <Input
              v-model="form.name"
              placeholder="Digite seu nome"
              name="name"
              id="name"
              type="text"
            />
            <span v-if="errors.name" class="text-red-500 font-medium">{{ errors.name }}</span>
          </div>

          <div class="space-y-2">
            <Label for="pin">
              Identificador <span class="opacity-60">(Número de 5 dígitos)</span>
            </Label>
            <Input
              v-model="form.pin"
              placeholder="Exemplo: 46378"
              name="pin"
              id="pin"
              type="text"
            />
            <span v-if="errors.pin" class="text-red-500 font-medium">{{ errors.pin }}</span>
          </div>

          <Button type="submit" class="md:col-span-2" :disabled="isLoading">
            <span class="font-medium">Entrar</span>
            <Loader2 v-if="isLoading" class="h-5 w-5 animate-spin" />
            <ArrowRightToLine v-else class="h-5 w-5" />
          </Button>
        </form>
      </div>
    </div>
  </main>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { ArrowRightToLine, Loader2 } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { useAuthStore } from '@/stores/authStore'
import { loginRequest } from '@/services/authService'
import { toast } from 'vue-sonner'
import type { LoginErrors, LoginForm } from '@/types/forms'

const router = useRouter()
const authStore = useAuthStore()

const form = ref<LoginForm>({
  name: '',
  pin: ''
})
const errors = ref<LoginErrors>({})
const isLoading = ref(false)

async function handleSubmit (): Promise<void> {
  try {
    isLoading.value = true
    const response = await loginRequest(form.value.name, form.value.pin)

    if (!response) return
    
    const { user, token } = response.data
    authStore.login(user, token)
    
    router.push('/')
  } catch {
    toast.error('Erro ao fazer login!')
  } finally {
    isLoading.value = false
  }
}
</script>
