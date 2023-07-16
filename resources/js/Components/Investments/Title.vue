<script setup lang="ts">
const props = defineProps<{
    icon: string | null
}>()
</script>

<template>
    <div class="flex items-center">
        <i
            v-if="props.icon"
            :class="props.icon"
            class="mr-2 text-2xl font-bold"
        />

        <h1 class="text-2xl font-bold">
            <slot />
        </h1>
    </div>
</template>
