<script setup lang="ts">
import { ref } from 'vue'
import { useConfirm } from 'primevue/useconfirm'
import { router } from '@inertiajs/vue3'
import SidebarLink from './SidebarLink.vue'
import UserAvatar from '@/Components/UserAvatar.vue'

const confirm = useConfirm()

const isSidebarActive = ref(false)

const handleLogout = () => {
    confirm.require({
        header: 'Confirm Logout',
        message: 'Are you sure you want to log out?',
        accept: () => router.post(route('auth.logout')),
    })
}

const sidebarLinks = [
    {
        label: 'Dashboard',
        route: route('admin.invest.dashboard'),
        icon: 'pi pi-chart-bar',
        component: 'Admin/Investments/Dashboard',
    },
    {
        label: 'Submissions',
        route: route('admin.invest.submissions.index'),
        icon: 'pi pi-list',
        component: 'Admin/Investments/Submissions/Index',
    },
    {
        label: 'Users',
        route: route('admin.invest.users.index'),
        icon: 'pi pi-users',
        component: 'Admin/Investments/Users/Index',
    },
    {
        label: 'Investors',
        route: route('admin.invest.investors.index'),
        icon: 'pi pi-id-card',
        component: 'Admin/Investments/Investors/Index',
    },
    {
        label: 'Investments',
        route: route('admin.invest.investments.index'),
        icon: 'pi pi-money-bill',
        component: 'Admin/Investments/Investment/Index',
    },
    {
        label: 'Withdrawals',
        route: route('admin.invest.withdrawals.index'),
        icon: 'pi pi-credit-card',
        component: 'Admin/Investments/Withdrawals/Index',
    },
]
</script>

<template>
    <aside
        class="sticky top-0 w-24 h-screen transition-all bg-primary"
        :class="{ 'w-64': isSidebarActive }"
    >
        <div class="relative flex flex-col justify-between h-full">
            <nav
                class="flex flex-col items-center w-full p-0 pt-8 text-slate-50"
            >
                <SidebarLink
                    v-for="link in sidebarLinks"
                    :isActiveLink="$page.component === link.component"
                    :href="link.route"
                    :label="link.label"
                    :isSidebarActive="isSidebarActive"
                    :icon="link.icon"
                />
            </nav>

            <Button
                class="transition-all sidebar-btn"
                severity="secondary"
                :icon="
                    isSidebarActive
                        ? 'pi pi-chevron-left'
                        : 'pi pi-chevron-right'
                "
                rounded
                @click="isSidebarActive = !isSidebarActive"
            />

            <div class="pb-8 text-slate-50">
                <div class="flex items-center gap-5 px-8">
                    <UserAvatar />

                    <div v-if="isSidebarActive">
                        <p class="font-heading">
                            {{ $page.props.user.firstName }}
                        </p>
                        <small>{{ $page.props.user.email }}</small>
                    </div>
                </div>

                <div
                    class="flex px-8 gap-5 mt-8 py-3 w-full cursor-pointer font-heading transition-all hover:bg-slate-50/[0.1]"
                    @click="handleLogout()"
                >
                    <i class="text-3xl pi pi-sign-out"></i>

                    <span v-if="isSidebarActive">Logout</span>
                </div>
            </div>
        </div>
    </aside>
</template>

<style scoped>
.sidebar-btn {
    position: absolute;
    top: 50%;
    bottom: 50%;
    right: -1.5rem;
}
</style>
