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
            class="flex flex-col items-center justify-between p-3 sticky top-0 z-10 bg-slate-100 transition-all"
        >
            <div class="flex w-full">
                <Link class="ml-0 mr-auto" :href="route('auth.login')">
                    <Button :label="$page.props.user ? 'Dashboard' : 'Login'" />
                </Link>

                <div class="mx-auto flex justify-center items-center gap-3">
                    <p
                        class="hidden lg:block text-2xl lg:text-3xl text-secondary"
                    >
                        梅丽茶馆
                    </p>

                    <Image
                        class="shadow-2xl shadow-neutral-900 rounded-full"
                        src="/images/logos/logo.png"
                        alt="Mei Li Tea House Logo"
                        width="50"
                    />

                    <h2 class="hidden lg:block text-lg lg:text-2xl font-bold">
                        MEI LI TEA HOUSE
                    </h2>
                </div>

                <div class="mr-0 ml-auto">
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
                v-if="isMenuShown"
                class="items-center gap-10 text-primary font-heading pt-8 transition-all"
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
                        <Link :href="route('site.franchise')">Franchise</Link>
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

        <footer class="mb-0 mt-auto bg-slate-300 p-2">
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
