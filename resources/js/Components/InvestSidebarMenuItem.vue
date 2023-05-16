<script setup lang="ts">
const props = defineProps<{
    href: string
    label: string
    icon: string
    isActive?: boolean
}>()
</script>

<template>
    <Link :href="props.href">
        <Button
            class="w-full text-left"
            :text="!props.isActive"
            :label="props.label"
            :icon="'pi ' + props.icon"
        />
    </Link>
</template>
