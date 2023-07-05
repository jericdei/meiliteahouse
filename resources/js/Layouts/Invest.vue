<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
import ConfirmDialog from 'primevue/confirmdialog'
import DynamicDialog from 'primevue/dynamicdialog'
import Toast from 'primevue/toast'
import { useToast } from 'primevue/usetoast'
import { computed, watch } from 'vue'
import Sidebar from './Partials/Sidebar.vue'

const toast = useToast()
const page = usePage()

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
        label: 'Dashboard',
        investor: true,
        route: route('system.invest.dashboard'),
        icon: 'pi pi-chart-bar',
        component:
            page.props.user.role === 'admin'
                ? 'System/Investments/Dashboard'
                : 'System/Investments/InvestorDashboard',
    },
    {
        label: 'Submissions',
        route: route('system.invest.submissions.index'),
        icon: 'pi pi-list',
        component: 'System/Investments/Submissions/Index',
    },
    {
        label: 'Users',
        route: route('system.invest.users.index'),
        icon: 'pi pi-users',
        component: 'System/Investments/Users/Index',
    },
    {
        label: 'Investors',
        route: route('system.invest.investors.index'),
        icon: 'pi pi-id-card',
        component: 'System/Investments/Investors/Index',
    },
    {
        label:
            page.props.user.role === 'admin' ? 'Investments' : 'My Investments',
        investor: true,
        route: route('system.invest.investments.index'),
        icon: 'pi pi-money-bill',
        component: 'System/Investments/Investments/Index',
    },
    {
        label:
            page.props.user.role === 'admin' ? 'Withdrawals' : 'My Withdrawals',
        investor: true,
        route: route('system.invest.withdrawals.index'),
        icon: 'pi pi-credit-card',
        component: 'System/Investments/Withdrawals/Index',
    },
]

const sidebarLinks = computed(() =>
    page.props.user.role === 'admin'
        ? links
        : links.filter((item: any) => item.investor)
)
</script>

<template>
    <Toast position="bottom-right" group="br" />
    <DynamicDialog />
    <ConfirmDialog />

    <div class="flex">
        <Sidebar :links="sidebarLinks" />

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
