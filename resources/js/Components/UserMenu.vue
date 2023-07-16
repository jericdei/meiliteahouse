<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import TieredMenu from 'primevue/tieredmenu'
import { ref } from 'vue'
import UserAvatar from './UserAvatar.vue'

const props = withDefaults(
    defineProps<{
        onlyLogout: boolean
    }>(),
    {
        onlyLogout: false,
    }
)

const menu = ref()
const items = ref([
    {
        label: 'Dashboard',
        icon: 'ri-dashboard-fill',
        visible: !props.onlyLogout,
        items: [
            {
                label: 'Investment',
                icon: 'ri-wallet-2-fill',
                command: () => router.get(route('system.invest.dashboard')),
            },
            {
                label: 'Franchising',
                icon: 'ri-store-3-fill',
                command: () =>
                    router.get(route('system.franchise.submissions.index')),
            },
        ],
    },
    {
        label: 'Logout',
        icon: 'ri-logout-box-line',
        command: () => router.post(route('auth.logout')),
    },
])
</script>

<template>
    <div class="flex items-center">
        <UserAvatar
            class="cursor-pointer p-5 text-xl"
            @click="menu.toggle($event)"
        />

        <TieredMenu ref="menu" :model="items" popup />
    </div>
</template>
