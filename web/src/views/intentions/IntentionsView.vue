<template>
  <div class="flex flex-wrap gap-4 justify-start px-6">
    <Card
      v-for="(intentionGroup, date) in intentions"
      :key="date"
      class="w-full sm:w-[calc(50%-1rem)] lg:w-[calc(53.33%-1rem)]"
    >
      <CardHeader>
        <CardTitle>
          Intenções do dia ({{ formatDate(date) }})
        </CardTitle>
      </CardHeader>

      <CardContent>
        <p class="text-muted-foreground">
          Clique no botão abaixo para visualizar as intenções deste dia.
        </p>
      </CardContent>

      <CardFooter>
        <router-link :to="{ name: 'intentions-details', params: { date } }">
          <Button class="h-10">
            Acessar
            <ArrowRight class="w-4 h-4" />
          </Button>
        </router-link>
      </CardFooter>
    </Card>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { ArrowRight } from 'lucide-vue-next'
import { Card, CardHeader, CardTitle, CardContent, CardFooter } from '@/components/ui/card'
import { toast } from 'vue-sonner'
import api from '@/services/api'
import Button from '@/components/ui/button/Button.vue'
import type { IntentionGroup } from '@/types/models'
import type { ApiResponse } from '@/types/api'

const intentions = ref<IntentionGroup>({})

function formatDate (date: string): string {
  try {
    const [year, month, day] = date.split('-').map(Number)
    const jsDate = new Date(year, month - 1, day)
    return new Intl.DateTimeFormat('pt-BR', {
      day: '2-digit',
      month: '2-digit'
    }).format(jsDate)
  } catch (e) {
    return date
  }
}

async function fetchIntentions (): Promise<void> {
  try {
    const response = await api.get<ApiResponse<IntentionGroup>>('/intentions')
    intentions.value = response.data.data
  } catch (error) {
    toast.error('Erro ao buscar intenções')
  }
}

onMounted(() => {
  fetchIntentions()
})
</script>
