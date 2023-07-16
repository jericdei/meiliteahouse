<script setup lang="ts">
import { ref } from 'vue'
import { useConfirm } from 'primevue/useconfirm'
import { router } from '@inertiajs/vue3'
import SidebarLink from './SidebarLink.vue'
import UserAvatar from '@/Components/UserAvatar.vue'

interface SidebarLink {
    label: string
    route: string
    icon: string
    component: string
}

const props = defineProps<{
    links: SidebarLink[]
}>()

const confirm = useConfirm()
const isSidebarActive = ref(false)

const handleLogout = () => {
    confirm.require({
        header: 'Confirm Logout',
        message: 'Are you sure you want to log out?',
        accept: () => router.post(route('auth.logout')),
    })
}
</script>

<template>
    <aside
        class="sticky top-0 h-screen w-24 bg-primary transition-all"
        :class="{ 'w-64': isSidebarActive }"
    >
        <div class="relative flex h-full flex-col justify-between">
            <nav class="flex w-full flex-col items-center p-0 text-slate-50">
                <SidebarLink
                    v-for="link in props.links"
                    :isActiveLink="$page.component === link.component"
                    :href="link.route"
                    :label="link.label"
                    :isSidebarActive="isSidebarActive"
                    :icon="link.icon"
                />
            </nav>

            <Button
                class="sidebar-btn transition-all"
                severity="secondary"
                :icon="
                    isSidebarActive
                        ? 'pi pi-chevron-left'
                        : 'pi pi-chevron-right'
                "
                rounded
                @click="isSidebarActive = !isSidebarActive"
            />

            <div class="text-slate-50">
                <div class="flex items-center gap-5 px-8">
                    <UserAvatar />

                    <div v-if="isSidebarActive">
                        <p class="font-heading">
                            {{ $page.props.user.firstName }}
                        </p>
                        <small>{{ $page.props.user.email }}</small>
                    </div>
                </div>

                <Link
                    :href="route('site.home')"
                    class="mt-8 flex w-full cursor-pointer gap-5 px-8 py-3 font-heading transition-all hover:bg-slate-50/[0.1]"
                >
                    <i class="pi pi-replay text-3xl"></i>

                    <span v-if="isSidebarActive">Back to Site Home</span>
                </Link>

                <div
                    class="mt-8 flex w-full cursor-pointer gap-5 px-8 py-3 font-heading transition-all hover:bg-slate-50/[0.1]"
                    @click="handleLogout()"
                >
                    <i class="pi pi-sign-out text-3xl"></i>

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
