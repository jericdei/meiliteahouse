<script setup lang="ts">
import DynamicDialog from 'primevue/dynamicdialog'
import ConfirmDialog from 'primevue/confirmdialog'
import Sidebar from './Partials/Sidebar.vue'
import { usePage } from '@inertiajs/vue3'
import { useToast } from 'primevue/usetoast'
import { watch } from 'vue'
import Toast from 'primevue/toast'

const toast = useToast()

watch(
    () => usePage().props.flash,
    (flash: any) => {
        if (flash) {
            toast.add({
                severity: flash.severity,
                life: flash.life ?? 3000,
                summary: flash.summary,
                detail: flash.detail,
                group: 'br',
                closable: true,
            })
        }
    },
    { deep: true }
)

watch(
    () => usePage().props.errors,
    errors => {
        Object.values(errors).forEach((item: any) => {
            toast.add({
                severity: 'error',
                life: 3000,
                summary: 'Error!',
                detail: item,
                group: 'br',
                closable: true,
            })
        })
    }
)

const links = [
    {
        label: 'Submissions',
        route: route('system.franchise.submissions.index'),
        icon: 'pi pi-list',
        component: 'System/Franchise/Submissions/Index',
    },
]
</script>

<template>
    <Toast position="bottom-right" group="br" />
    <DynamicDialog />
    <ConfirmDialog />

    <div class="flex">
        <Sidebar :links="links" />

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
