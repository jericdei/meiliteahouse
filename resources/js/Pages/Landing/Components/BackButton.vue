<script setup lang="ts">
import { ref } from 'vue'

const showLabel = ref(false)
</script>

<template>
    <Link :href="route('site.home')" class="fixed bottom-5 left-5 z-50">
        <Button
            severity="secondary"
            :label="showLabel ? 'Back to site' : ''"
            icon="pi pi-arrow-left"
            @mouseover="showLabel = true"
            @mouseleave="showLabel = false"
        />
    </Link>
</template>
