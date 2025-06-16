<script setup lang="ts">
import { RouterView } from 'vue-router'
import { Toaster } from 'vue-sonner';
import "vue-sonner/style.css"
</script>

<template>
  <RouterView />
  <Toaster richColors position="top-center" theme="dark" />
</template>
