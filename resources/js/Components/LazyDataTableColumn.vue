<script setup lang="ts">
import Skeleton from 'primevue/skeleton'

const props = defineProps<{
    value: any
    isLoading: Boolean
}>()
</script>

<template>
    <Skeleton v-if="props.isLoading" />

    <span v-else>
        <slot name="content" :value="props.value">
            {{ props.value }}
        </slot>
    </span>
</template>
