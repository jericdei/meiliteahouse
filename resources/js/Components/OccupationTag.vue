<script setup lang="ts">
import Tag from 'primevue/tag'
import { computed } from 'vue'
import { capitalizeFirst } from '@/Helpers/string'
import { Occupation } from '@/types/submission'

const props = defineProps<{
    occupation: Occupation['type']
}>()

const severity = computed(() => {
    switch (props.occupation) {
        case 'student':
            return 'success'
        case 'working':
            return 'info'
    }
})
</script>

<template>
    <Tag :severity="severity" :value="capitalizeFirst(props.occupation)" />
</template>
