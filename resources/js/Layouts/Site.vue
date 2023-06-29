<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3'
import { useWindowScroll } from '@vueuse/core'
import ConfirmDialog from 'primevue/confirmdialog'
import DynamicDialog from 'primevue/dynamicdialog'
import Image from 'primevue/image'
import Menu from 'primevue/menu'
import Toast from 'primevue/toast'
import { useToast } from 'primevue/usetoast'
import { computed, ref, watch } from 'vue'

const { y } = useWindowScroll()
const toast = useToast()
const page = usePage()

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
        command: () => window.open(route('site.franchise'), '_blank'),
    },
    {
        label: 'Invest',
        icon: 'pi pi-dollar',
        class: 'mlth-menu-item',
        command: () => router.get(route('site.investments.index')),
    },
    {
        label: page.props.user ? 'Dashboard' : 'Login',
        icon: page.props.user ? 'pi pi-chart-bar' : 'pi pi-sign-in',
        class: 'mlth-menu-item',
        command: () =>
            router.get(
                route(page.props.user ? 'admin.invest.dashboard' : 'auth.login')
            ),
    },
])

const dashboardMenu = ref()
const dashboardMenuItems = ref([
    {
        label: 'Investments',
        icon: 'pi pi-money-bill',
        command: () => router.get(route('admin.invest.dashboard')),
    },
    {
        label: 'Franchise',
        icon: 'pi pi-building',
        command: () => router.get(route('admin.franchise.submissions.index')),
    },
])

const isMenuShown = ref(false)

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

const handleMenuToggle = (event: Event) => {
    if (window.innerWidth >= 1024) {
        isMenuShown.value = !isMenuShown.value
    } else {
        menu.value.toggle(event)
    }
}
</script>

<template>
    <main>
        <Toast position="bottom-right" group="br" />
        <DynamicDialog />
        <ConfirmDialog />

        <header
            class="sticky top-0 z-10 flex flex-col items-center justify-between p-3 transition-all bg-slate-100"
        >
            <div class="relative flex w-full">
                <Link
                    v-if="!$page.props.user"
                    class="absolute left-0 hidden lg:block"
                    :href="route('auth.login')"
                >
                    <Button size="small" label="Login" icon="pi pi-sign-in" />
                </Link>

                <Link
                    v-else-if="$page.props.user.role === 'investor'"
                    class="absolute left-0 hidden lg:block"
                    :href="'#'"
                >
                    <Button
                        size="small"
                        label="Dashboard"
                        icon="pi pi-chart-bar"
                    />
                </Link>

                <div v-else class="absolute left-0 hidden lg:block">
                    <Button
                        size="small"
                        label="Dashboard"
                        icon="pi pi-chart-bar"
                        @click="dashboardMenu.toggle($event)"
                    />

                    <Menu
                        :model="dashboardMenuItems"
                        popup
                        ref="dashboardMenu"
                    />
                </div>

                <div
                    class="flex items-center gap-3 lg:mx-auto lg:justify-center"
                >
                    <p
                        class="hidden text-2xl lg:block lg:text-3xl text-secondary font-chinese"
                    >
                        梅丽茶馆
                    </p>

                    <Image
                        class="rounded-full shadow-2xl shadow-neutral-900"
                        imageClass="rounded-full"
                        src="/images/logos/logo-2023.jpg"
                        alt="Mei Li Tea House Logo"
                        width="50"
                    />

                    <h2 class="hidden text-lg font-bold lg:block lg:text-2xl">
                        MEI LI TEA HOUSE
                    </h2>
                </div>

                <div class="absolute right-0">
                    <Button
                        iconClass="text-2xl"
                        icon="pi pi-bars"
                        text
                        rounded
                        @click="handleMenuToggle($event)"
                    />

                    <Menu :model="items" popup ref="menu" />
                </div>
            </div>

            <nav
                :class="{ hidden: !isMenuShown }"
                class="items-center gap-10 pt-8 transition-all text-primary font-heading"
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
                    <li :class="{ active: $page.url.startsWith('/stores') }">
                        <Link :href="route('site.stores')">Stores</Link>
                    </li>
                    <li
                        :class="{
                            active: $page.url.startsWith('/franchise'),
                        }"
                    >
                        <a :href="route('site.franchise')" target="_blank"
                            >Franchise</a
                        >
                    </li>
                    <li :class="{ active: $page.url.startsWith('/invest') }">
                        <Link :href="route('site.investments.index')"
                            >Invest</Link
                        >
                    </li>
                </ul>
            </nav>
        </header>

        <section id="content">
            <slot />
        </section>

        <footer class="p-2 mt-auto mb-0 bg-slate-300">
            <p class="text-center">
                Mei Li Tea House &copy; {{ new Date().getFullYear() }}
            </p>
        </footer>
    </main>
</template>

<style scoped>
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

main {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: auto 1fr auto;
    grid-template-areas:
        'header'
        'content'
        'footer';
}

header {
    grid-area: header;
}

section#content {
    grid-area: content;
}

footer {
    grid-area: footer;
}
</style>
