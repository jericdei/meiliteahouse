<script setup lang="ts">
import { FranchisingFormProps } from '@/types/franchising'

const props = defineProps<{
    submissions: FranchisingFormProps
}>()
</script>

<template>
    <div>
        <Head title="Franchising Forms" />

        <pre>{{ props.submissions }}</pre>
    </div>
</template>
