<script setup lang="ts">
import Toast, { ToastMessageOptions } from 'primevue/toast'
import DynamicDialog from 'primevue/dynamicdialog'
import ConfirmDialog from 'primevue/confirmdialog'
import Sidebar from './Invest/Sidebar.vue'
import { router, usePage } from '@inertiajs/vue3'
import { useToast } from 'primevue/usetoast'
import { onUnmounted, watch } from 'vue'

const toast = useToast()
const page = usePage()

interface FlashMessage {
    severity: ToastMessageOptions['severity']
    life: number
    summary: string
    detail: string
}

let event = router.on('finish', () => {
    if (page.props.flash) {
        let flash: FlashMessage = page.props.flash as FlashMessage

        toast.add({
            severity: flash.severity,
            life: flash.life ?? 3000,
            summary: flash.summary,
            detail: flash.detail,
            group: 'br',
            closable: true,
        })
    }
})

onUnmounted(() => event())

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
