<script setup lang="ts">
import Tag from 'primevue/tag'
import type { Status } from '@/types/common'
import { computed } from 'vue'
import { capitalizeFirst } from '@/Helpers/string'

const props = defineProps<{
    status: Status
}>()

const severity = computed(() => {
    switch (props.status) {
        case 'approved':
            return 'success'
        case 'declined':
            return 'danger'
        case 'pending':
            return 'warning'
    }
})
</script>

<template>
    <Tag :severity="severity" :value="capitalizeFirst(props.status)" />
</template>
