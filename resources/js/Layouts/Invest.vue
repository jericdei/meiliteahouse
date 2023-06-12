<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3';
import Avatar from 'primevue/avatar';
import Image from 'primevue/image';
import Menu from 'primevue/menu';
import { onBeforeMount, onUpdated, ref } from 'vue';
import InvestSidebarMenuItem from '../Components/InvestSidebarMenuItem.vue';
import { capitalizeFirst } from '../Helpers/string';
import Toast from 'primevue/toast';
import DynamicDialog from 'primevue/dynamicdialog';
import ConfirmDialog from 'primevue/confirmdialog';
import Sidebar from './Invest/Sidebar.vue';

const props = defineProps<{
    user: {
        name: string;
        initials: string;
        role: string;
    };
}>();

const page = usePage();

const activeSidebarLink = ref<String>('');

const menu = ref();
const items = ref([
    {
        label: 'Profile',
        icon: 'pi pi-user',
        command: () => router.get(route('invest.profile')),
    },
    {
        label: 'Settings',
        icon: 'pi pi-sliders-h',
        command: () => router.get(route('invest.settings')),
    },
    {
        label: 'Logout',
        icon: 'pi pi-sign-out',
        command: () => router.post(route('auth.logout')),
    },
]);

const sidebarMenu = ref();
const sidebarItems = ref([
    {
        label: 'Dashboard',
        icon: 'pi pi-chart-bar',
        command: () => router.get(route('invest.dashboard')),
    },
    {
        label: 'Submissions',
        icon: 'pi pi-list',
        command: () => router.get(route('invest.submissions.index')),
    },
    {
        label: 'Users',
        icon: 'pi pi-users',
        command: () => router.get(route('invest.users.index')),
    },
    {
        label: 'Investors',
        icon: 'pi pi-id-card',
        command: () => router.get(route('invest.investors.index')),
    },
    {
        label: 'Investments',
        icon: 'pi pi-money-bill',
        command: () => router.get(route('invest.investments.index')),
    },
    {
        label: 'Withdrawals',
        icon: 'pi pi-credit-card',
        command: () => router.get(route('invest.withdrawals.index')),
    },
]);

onBeforeMount(() => (activeSidebarLink.value = page.url));
onUpdated(() => (activeSidebarLink.value = page.url));
</script>

<template>
    <div class="flex">
        <Toast position="bottom-right" group="br" />
        <DynamicDialog />
        <ConfirmDialog />
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

.p-dialog .p-dialog-header {
    @apply text-slate-50 bg-primary;
}
</style>
