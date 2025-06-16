<template>
  <div class="flex-1 p-6">
    <div class="flex flex-col md:flex-row gap-2">
      <!-- comunidades -->
      <div class="w-full md:w-auto flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4 items-center">
        <Select v-model="selectedChurch">
          <SelectTrigger class="w-full md:w-64">
            <SelectValue placeholder="Selecionar comunidade">
              <div class="flex items-center gap-2">
                <ChurchIcon class="size-4 text-muted-foreground" />
                <span>{{selectedChurch ? churches.find(c => c.id === selectedChurch)?.name : 'Selecionar comunidade'}}</span>
              </div>
            </SelectValue>
          </SelectTrigger>
          <SelectContent>
            <SelectGroup>
              <SelectItem v-for="church in churches" :key="church.id" :value="church.id"
                @click="selectIntentionsFilter(selectedHour, church.id)">
                {{ church.name }}
              </SelectItem>
            </SelectGroup>
          </SelectContent>
        </Select>
      </div>
      
      <!-- horários -->
      <div class="w-full flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4 items-center">
        <Select v-model="selectedHour">
          <SelectTrigger class="w-full md:w-64">
            <SelectValue placeholder="Selecionar horário">
              <div class="flex items-center gap-2">
                <Clock class="size-4 text-muted-foreground" />
                <span>{{ selectedHour || 'Selecionar horário' }}</span>
              </div>
            </SelectValue>
          </SelectTrigger>
          <SelectContent>
            <SelectGroup>
              <SelectItem v-for="hour in hours" :key="hour" :value="hour"
                @click="selectIntentionsFilter(hour, selectedChurch)">
                {{ hour }}
              </SelectItem>
            </SelectGroup>
          </SelectContent>
        </Select>
      </div>
    </div>

    <div class="w-full text-sm space-y-3 mt-5">
      <div class="rounded-md border">
        <div v-if="filteredIntentions.length">
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead class="bg-primary text-primary-foreground overflow-hidden rounded-t-sm">Intenções</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              <TableRow v-for="(intention, index) in filteredIntentions" :key="index">
                <TableCell v-for="(content, contentIndex) in intention.contents" :key="contentIndex">
                  {{ content }}
                </TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </div>
        <div v-else class="text-center py-4">
          <p class="text-lg text-muted-foreground font-medium">
            Nenhuma intenção para este horário ou comunidade...
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import { useRoute } from 'vue-router'
import { Clock, Church as ChurchIcon } from 'lucide-vue-next'
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { toast } from 'vue-sonner'
import api from '@/services/api'
import type { Church, Intention, IntentionGroup } from '@/types/models'
import type { ApiResponse } from '@/types/api'

const route = useRoute()
const date = computed(() => route.params.date as string)

const hours = [
  '07:00', '08:30', '09:00', '10:00',
  '18:00', '19:00'
]

const churches = ref<Church[]>([])
const intentions = ref<Intention[]>([])
const selectedHour = ref<string>('')
const selectedChurch = ref<number | null>(null)

const filteredIntentions = computed(() => {
  if (!selectedHour.value || !selectedChurch.value) {
    return []
  }

  return intentions.value.filter(intention => {
    const intentionMassDate = intention.mass_date.split(' ')[1].split(':')[0] + ':00'

    const matchesDate = !selectedHour.value || intentionMassDate === selectedHour.value
    const matchesChurch = !selectedChurch.value || intention.church.id === selectedChurch.value
    return matchesDate && matchesChurch
  })
})

function selectIntentionsFilter (hour: string, churchId: number | null): void {
  selectedHour.value = hour
  selectedChurch.value = churchId
}

async function fetchData (): Promise<void> {
  try {
    const [churchesResponse, intentionsResponse] = await Promise.all([
      api.get<ApiResponse<Church[]>>('/churches'),
      api.get<ApiResponse<IntentionGroup>>(`/intentions?date=${date.value}`)
    ])

    churches.value = churchesResponse.data.data

    const rawIntentions = intentionsResponse.data.data
    const intentionsArray: Intention[] = []

    for (const dayKey in rawIntentions) {
      const dayIntentions = rawIntentions[dayKey]
      dayIntentions.forEach((intention: Intention) => {
        intentionsArray.push({
          ...intention,
          mass_date: dayKey
        })
      })
    }

    intentions.value = intentionsArray
  } catch (error) {
    toast.error('Erro ao buscar dados')
  }
}

onMounted(() => {
  fetchData()
})
</script>
