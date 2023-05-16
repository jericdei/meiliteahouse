<script setup lang="ts">
import Image from 'primevue/image'
import Avatar from 'primevue/avatar'
import Menu from 'primevue/menu'
import InvestSidebarMenuItem from '../Components/InvestSidebarMenuItem.vue'
import { onBeforeMount, onUpdated, ref } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import { capitalizeFirst } from '../Helpers/string'

const props = defineProps<{
    user: {
        name: string
        initials: string
        role: string
    }
}>()

const page = usePage()

const activeSidebarLink = ref<String>()

const menu = ref()
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
])

const sidebarMenu = ref()
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
])

onBeforeMount(() => (activeSidebarLink.value = page.url))
onUpdated(() => (activeSidebarLink.value = page.url))
</script>

<template>
    <main>
        <header
            class="flex items-center justify-between bg-primary text-slate-50 p-3 lg:p-4 lg:px-10"
        >
            <div class="lg:hidden">
                <Button
                    icon="pi pi-bars"
                    text
                    rounded
                    icon-class="text-slate-50"
                    @click="sidebarMenu.toggle($event)"
                />
                <Menu :model="sidebarItems" popup ref="sidebarMenu" />
            </div>

            <div class="flex items-center gap-3">
                <Image
                    src="/images/logo.png"
                    alt="Mei Li Tea House Logo"
                    width="40"
                />

                <h2 class="text-md hidden lg:block text-center font-bold">
                    Mei Li Tea House Invest
                </h2>
            </div>

            <div class="flex items-center gap-5">
                <Link :href="route('site.home')">
                    <Button
                        class="hidden lg:block"
                        label="Back to Site Home"
                        icon="pi pi-replay"
                        severity="secondary"
                    />

                    <Button
                        class="block lg:hidden"
                        icon="pi pi-replay"
                        severity="secondary"
                    />
                </Link>

                <Avatar
                    class="cursor-pointer bg-warning"
                    :label="props.user.initials"
                    size="large"
                    shape="circle"
                    @click="menu.toggle($event)"
                />

                <Menu ref="menu" :model="items" popup>
                    <template #start>
                        <div class="flex gap-3 p-5">
                            <div>
                                <Avatar
                                    class="cursor-pointer bg-warning text-slate-50"
                                    :label="props.user.initials"
                                    size="small"
                                    shape="circle"
                                />
                            </div>

                            <div>
                                <p class="font-bold text-sm">
                                    {{ props.user.name }}
                                </p>

                                <p class="text-xs">
                                    {{ capitalizeFirst(props.user.role) }}
                                </p>
                            </div>
                        </div>
                    </template>
                </Menu>
            </div>
        </header>

        <section id="main">
            <aside
                class="w-1/6 px-2 py-5 border-r-2 border-r-primary hidden lg:block"
            >
                <nav>
                    <ul class="flex flex-col gap-5">
                        <li>
                            <InvestSidebarMenuItem
                                :href="route('invest.dashboard')"
                                label="Dashboard"
                                icon="pi-chart-bar"
                                :is-active="
                                    activeSidebarLink.startsWith(
                                        '/invest/dashboard'
                                    )
                                "
                            />
                        </li>
                        <li>
                            <InvestSidebarMenuItem
                                :href="route('invest.submissions.index')"
                                label="Submissions"
                                icon="pi-list"
                                :is-active="
                                    activeSidebarLink.startsWith(
                                        '/invest/submissions'
                                    )
                                "
                            />
                        </li>
                        <li>
                            <InvestSidebarMenuItem
                                :href="route('invest.users.index')"
                                label="Users"
                                icon="pi-users"
                                :is-active="
                                    activeSidebarLink.startsWith(
                                        '/invest/users'
                                    )
                                "
                            />
                        </li>
                        <li>
                            <InvestSidebarMenuItem
                                :href="route('invest.investors.index')"
                                label="Investors"
                                icon="pi-id-card"
                                :is-active="
                                    activeSidebarLink.startsWith(
                                        '/invest/investors'
                                    )
                                "
                            />
                        </li>
                        <li>
                            <InvestSidebarMenuItem
                                :href="route('invest.investments.index')"
                                label="Investments"
                                icon="pi-money-bill"
                                :is-active="
                                    activeSidebarLink.startsWith(
                                        '/invest/investments'
                                    )
                                "
                            />
                        </li>
                        <li>
                            <InvestSidebarMenuItem
                                :href="route('invest.withdrawals.index')"
                                label="Withdrawals"
                                icon="pi-credit-card"
                                :is-active="
                                    activeSidebarLink.startsWith(
                                        '/invest/withdrawals'
                                    )
                                "
                            />
                        </li>
                    </ul>
                </nav>
            </aside>

            <article id="content" class="p-10">
                <slot />
            </article>
        </section>
    </main>
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
