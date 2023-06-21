<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
import Avatar from 'primevue/avatar'
import { computed } from 'vue'

const page = usePage()

const initials = computed(() => {
    return page.props.user.initials
})
</script>

<template>
    <Avatar
        v-if="$page.props.user.photo"
        :image="$page.props.user.photo"
        class="bg-white aspect-square"
        shape="circle"
    />

    <Avatar
        v-else
        class="bg-secondary text-slate-50"
        shape="circle"
        :label="initials"
    />
</template>

<style scoped></style>
