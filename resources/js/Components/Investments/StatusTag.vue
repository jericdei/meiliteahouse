<script setup lang="ts">
import Tag, { TagProps } from 'primevue/tag'
import { computed } from 'vue'

const props = defineProps<{
    status: string
}>()

const severity = computed<TagProps['severity']>(() => {
    switch (props.status.toLowerCase()) {
        case 'pending':
            return 'warning'
        case 'declined':
            return 'error'
        case 'approved':
            return 'success'
    }
})
</script>

<template>
    <Tag
        class="px-4 text-lg"
        rounded
        :value="props.status"
        :severity="severity"
    />
</template>
