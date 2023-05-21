<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3'
import Image from 'primevue/image'
import Menu from 'primevue/menu'
import { ref, watch } from 'vue'
import { useWindowScroll } from '@vueuse/core'
import { computed } from 'vue'
import { useToast } from 'primevue/usetoast'
import Toast from 'primevue/toast'
import DynamicDialog from 'primevue/dynamicdialog'
import ConfirmDialog from 'primevue/confirmdialog'

const { y } = useWindowScroll()
const toast = useToast()

const activeBorderColor = computed(() => {
    return y.value > 0 ? 'var(--tw-slate-50)' : 'var(--primary-color)'
})

const menu = ref()

const items = ref([
    {
        label: 'Home',
        icon: 'pi pi-home',
        class: 'mlth-menu-item',
        command: () => router.get(route('site.home')),
    },
    {
        label: 'Products',
        icon: 'pi pi-shopping-cart',
        class: 'mlth-menu-item',
        command: () => router.get(route('site.products')),
    },
    {
        label: 'About',
        icon: 'pi pi-question-circle',
        class: 'mlth-menu-item',
        command: () => router.get(route('site.about')),
    },
    {
        label: 'Stores',
        icon: 'pi pi-map-marker',
        class: 'mlth-menu-item',
        command: () => router.get(route('site.stores')),
    },
    {
        label: 'Franchise',
        icon: 'pi pi-money-bill',
        class: 'mlth-menu-item',
        command: () => router.get(route('site.franchise')),
    },
    {
        label: 'Invest',
        icon: 'pi pi-dollar',
        class: 'mlth-menu-item',
        command: () => router.get(route('site.invest')),
    },
])

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
    (errors) => {
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
    <main
        class="bg-[url('/images/bg-body.svg')] bg-fixed bg-cover bg-no-repeat"
    >
        <Toast position="bottom-right" group="br" />
        <DynamicDialog />
        <ConfirmDialog />
        <header
            class="flex items-center justify-between bg-primary lg:bg-opacity-0 text-slate-50 p-3 lg:p-5 lg:px-10 sticky top-0 transition-all z-10"
            :class="y > 0 && 'lg:bg-opacity-100 lg:py-3'"
        >
            <div class="flex items-center gap-3">
                <Image
                    src="/images/logo.png"
                    alt="Mei Li Tea House Logo"
                    width="50"
                />

                <h2 class="text-xl font-bold">Mei Li Tea House</h2>
            </div>

            <div>
                <div class="lg:hidden">
                    <Button
                        icon="pi pi-bars"
                        text
                        rounded
                        icon-class="text-slate-50"
                        @click="menu.toggle($event)"
                    />
                    <Menu :model="items" popup ref="menu" />
                </div>

                <nav
                    class="hidden lg:flex items-center gap-10 text-primary font-heading"
                    :class="{ 'text-slate-50': y > 0 }"
                >
                    <ul class="flex gap-8 font-bold">
                        <li :class="{ active: $page.url === '/' }">
                            <Link :href="route('site.home')">Home</Link>
                        </li>
                        <li :class="{ active: $page.url.startsWith('/about') }">
                            <Link :href="route('site.about')">About</Link>
                        </li>
                        <li
                            :class="{
                                active: $page.url.startsWith('/products'),
                            }"
                        >
                            <Link :href="route('site.products')">Products</Link>
                        </li>
                        <li
                            :class="{ active: $page.url.startsWith('/stores') }"
                        >
                            <Link :href="route('site.stores')">Stores</Link>
                        </li>
                        <li
                            :class="{
                                active: $page.url.startsWith('/franchise'),
                            }"
                        >
                            <Link :href="route('site.franchise')"
                                >Franchise</Link
                            >
                        </li>
                        <li
                            :class="{ active: $page.url.startsWith('/invest') }"
                        >
                            <Link :href="route('site.investments.index')"
                                >Invest</Link
                            >
                        </li>
                    </ul>

                    <Link :href="route('auth.login')">
                        <Button
                            :label="$page.props.user ? 'Dashboard' : 'Login'"
                            :severity="y > 0 ? 'secondary' : 'primary'"
                        />
                    </Link>
                </nav>
            </div>
        </header>

        <section id="content">
            <slot />
        </section>

        <footer>
            <p>This is the Footer</p>
        </footer>
    </main>
</template>

<style>
.p-icon {
    @apply text-white;
}

nav ul li {
    @apply cursor-pointer;
}

.active {
    @apply pb-2 border-b-4 border-spacing-y-10;
    border-color: v-bind('activeBorderColor');
}
</style>
