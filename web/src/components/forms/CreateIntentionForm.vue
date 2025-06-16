<script setup lang="ts">
import { ref } from 'vue'
import { Clock, Church as ChurchIcon, X, Plus, Send, Loader2, Pointer, CalendarIcon } from 'lucide-vue-next'
import { type CalendarDate, today } from '@internationalized/date'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover'
import { Calendar as DatePicker } from '@/components/ui/calendar'
import { Dialog, DialogContent, DialogTrigger, DialogHeader, DialogTitle, DialogDescription } from '@/components/ui/dialog'
import api from '@/services/api'
import { toast } from 'vue-sonner'
import { useAuthStore } from '@/stores/authStore'
import router from '@/router'
import type { Church } from '@/types/models'
import type { IntentionForm } from '@/types/forms'

const props = defineProps<{
  churches: Church[]
}>()

const form = ref<IntentionForm>({
  mass_date: '',
  mass_hour: '',
  church_id: null,
  contents: []
})

const calendarValue = ref<CalendarDate | undefined>(undefined)
const timezone = 'America/Sao_Paulo'

const formatDate = (date: any) => {
  const [year, month, day] = date.toString().split('-')
  return `${day}-${month}-${year}`
}

const hours = [
  '07:00', '08:30', '09:00', '10:00',
  '18:00', '19:00'
]

const isLoading = ref(false)
const newIntention = ref('')
const intentions = ref<string[]>([])

const addIntention = () => {
  if (!newIntention.value.trim()) return
  intentions.value.push(newIntention.value.trim())
  newIntention.value = ''
}

const removeIntention = (index: number) => {
  intentions.value.splice(index, 1)
}

const handleSubmit = async () => {
  if (!form.value.mass_date || !form.value.mass_hour || !form.value.church_id || !intentions.value.length) {
    toast.error('Preencha todos os campos!')
    return
  }

  try {
    isLoading.value = true
    const response = await api.post('/intentions', {
      ...form.value,
      contents: intentions.value
    })

    if (response.status === 200) {
      toast.success('Sua intenção foi registrada!', {
        description: 'Agora aguarde o dia da missa para que sua intenção seja ofertada.'
      })
      form.value = {
        mass_date: '',
        mass_hour: '',
        church_id: null,
        contents: []
      }
      intentions.value = []
      calendarValue.value = undefined
      
      if (useAuthStore().user?.role === 'admin') {
        router.push({ name: 'intentions' })
      }
    }
  } catch (error) {
    toast.error('Erro ao criar intenção!')
  } finally {
    isLoading.value = false
  }
}
</script>

<template>
  <div class="flex-1 flex flex-col gap-6 items-center justify-center">
    <form @submit.prevent="handleSubmit" class="grid w-full max-w-6xl lg:grid-cols-2 gap-3">
      
      <div class="space-y-2">
        <Label for="mass_date">Data da missa</Label>
        <Popover>
          <PopoverTrigger as-child>
            <Button variant="outline" class="w-full justify-start font-normal ps-3">
              <span>
                {{ calendarValue ? formatDate(calendarValue) : 'Selecionar data' }}
              </span>
              <CalendarIcon class="ms-auto h-4 w-4 opacity-50" />
            </Button>
          </PopoverTrigger>
          <PopoverContent class="w-auto p-0">
            <DatePicker
              :model-value="calendarValue as any"
              :min-value="today(timezone)"
              calendar-label="Data da missa"
              initial-focus
              locale="pt-BR"
              @update:model-value="(v) => {
                if (v) {
                  calendarValue = v as CalendarDate
                  form.mass_date = formatDate(v)
                }
              }"
            />
          </PopoverContent>
        </Popover>
      </div>

      <div class="space-y-2">
        <Label for="mass_hour">Horário</Label>
        <Select v-model="form.mass_hour">
          <SelectTrigger class="w-full">
            <SelectValue placeholder="Escolher horário" />
          </SelectTrigger>
          <SelectContent>
            <SelectItem v-for="hour in hours" :key="hour" :value="hour">
              <div class="flex items-center gap-2">
                <Clock class="w-4 h-4" /> {{ hour }}
              </div>
            </SelectItem>
          </SelectContent>
        </Select>
      </div>

      <div class="space-y-2 lg:col-span-2">
        <Label for="church_id">Comunidade da missa</Label>
        <Select v-model="form.church_id">
          <SelectTrigger class="w-full">
            <SelectValue placeholder="Escolher comunidade" />
          </SelectTrigger>
          <SelectContent>
            <SelectItem v-for="church in churches" :key="church.id" :value="church.id">
              <div class="flex items-center gap-2">
                <ChurchIcon class="w-4 h-4" /> {{ church.name }}
              </div>
            </SelectItem>
          </SelectContent>
        </Select>
      </div>

      <div class="space-y-2 lg:col-span-2 border-t border-t-zinc-800 pt-2">
        <Dialog>
          <DialogTrigger as-child>
            <Button variant="ghost" class="w-full justify-start">
              <Pointer class="w-4 h-4 mr-1" />
              Clique para adicionar intenções! 
              <!-- <span v-if="intentions.length" class="text-zinc-400">({{ intentions.length }})</span> -->
            </Button>
          </DialogTrigger>

          <DialogContent>
            <DialogHeader>
              <DialogTitle>Adicionar intenções</DialogTitle>
              <DialogDescription>
                Digite e clique em "adicionar". Se tiver mais, repita o processo.
              </DialogDescription>
            </DialogHeader>

            <template v-if="intentions.length">
              <div class="flex flex-col gap-2">
                <div
                  v-for="(intention, index) in intentions"
                  :key="index"
                  class="flex justify-between items-center bg-zinc-800 rounded px-3 py-1.5 text-zinc-400"
                >
                  <span class="text-lg">{{ intention }}</span>
                  <Button variant="ghost" size="icon" type="button" @click="removeIntention(index)">
                    <X class="w-5 h-5" />
                  </Button>
                </div>
              </div>
            </template>

            <div class="flex items-center flex-col gap-2 p-4 md:p-5 rounded-b">
              <Input
                v-model="newIntention"
                placeholder="Digite sua intenção..."
                type="text"
              />
              <Button @click="addIntention" class="w-full lg:w-16" type="button">
                Adicionar
                <Plus class="h-4 w-4 lg:h-5 lg:w-5 ml-1" />
              </Button>
            </div>
          </DialogContent>
        </Dialog>
      </div>

      <Button type="submit" class="lg:col-span-2" :disabled="isLoading">
        <Loader2 v-if="isLoading" class="animate-spin size-5 mr-2" />
        <template v-else>
          Enviar <Send class="size-5 ml-2" />
        </template>
      </Button>
    </form>
  </div>
</template>
