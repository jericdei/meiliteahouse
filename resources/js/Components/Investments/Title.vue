<script setup lang="ts">
const props = defineProps<{
  icon: string | null;
}>();
</script>

<template>
  <div class="flex items-center">
    <i v-if="props.icon" :class="props.icon" class="font-bold text-2xl mr-2" />

    <h1 class="font-bold text-2xl">
      <slot />
    </h1>
  </div>
</template>
