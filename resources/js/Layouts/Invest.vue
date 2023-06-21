<script setup lang="ts">
import Toast from 'primevue/toast'
import DynamicDialog from 'primevue/dynamicdialog'
import ConfirmDialog from 'primevue/confirmdialog'
import Sidebar from './Invest/Sidebar.vue'
</script>

<template>
    <Toast position="bottom-right" group="br" />
    <DynamicDialog />
    <ConfirmDialog />

    <div class="flex">
        <Sidebar />

        <main class="flex-1 p-10">
            <slot />
        </main>
    </div>
</template>

<style scoped>
:deep(.p-menu.sidebar) {
    @apply border-none;
}

:deep(.p-menu ul) {
    @apply flex flex-col gap-5;
}

:deep(.p-menu ul li .p-menuitem-content) {
    @apply rounded-lg;
}

:deep(
        .p-menu
            .p-menuitem:not(.p-highlight):not(.p-disabled)
            > .p-menuitem-content:hover
    ),
:deep(.p-menu .p-menuitem-active),
:deep(
        .p-menu
            .p-menuitem:not(.p-highlight):not(.p-disabled).p-focus
            > .p-menuitem-content
    ) {
    @apply bg-primary;
}

:deep(
        .p-menu
            .p-menuitem:not(.p-highlight):not(.p-disabled)
            > .p-menuitem-content:hover
            .p-menuitem-link
            .p-menuitem-text
    ),
:deep(
        .p-menu
            .p-menuitem:not(.p-highlight):not(.p-disabled)
            > .p-menuitem-content:hover
            .p-menuitem-link
            .p-menuitem-icon
    ),
:deep(
        .p-menu
            .p-menuitem:not(.p-highlight):not(.p-disabled).p-focus
            > .p-menuitem-content
            .p-menuitem-link
            .p-menuitem-icon
    ),
:deep(
        .p-menu
            .p-menuitem:not(.p-highlight):not(.p-disabled).p-focus
            > .p-menuitem-content
            .p-menuitem-link
            .p-menuitem-text
    ),
:deep(
        .p-menu
            .p-menuitem-active
            > .p-menuitem-content
            .p-menuitem-link
            .p-menuitem-text
    ),
:deep(
        .p-menu
            .p-menuitem-active
            > .p-menuitem-content
            .p-menuitem-link
            .p-menuitem-icon
    ) {
    @apply text-slate-50;
}
</style>
