<script setup lang="ts">
import UserMenu from '@/Components/UserMenu.vue'
import { router, usePage } from '@inertiajs/vue3'
import { useClipboard, useWindowScroll } from '@vueuse/core'
import ConfirmDialog from 'primevue/confirmdialog'
import Divider from 'primevue/divider'
import DynamicDialog from 'primevue/dynamicdialog'
import Image from 'primevue/image'
import Menu from 'primevue/menu'
import Toast from 'primevue/toast'
import { useToast } from 'primevue/usetoast'
import { computed, ref, watch } from 'vue'

const { y } = useWindowScroll()
const toast = useToast()
const page = usePage()
const { copy } = useClipboard()

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
        visible: false,
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
        command: () => router.get(route('site.investments.index')),
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

const copyContact = (type: string) => {
    copy(type === 'Email Address' ? 'meiliteahouse@gmail.com' : '0286404767')

    toast.add({
        severity: 'success',
        summary: 'Success',
        detail: `${type} copied successfully!`,
        group: 'br',
        life: 3000,
    })
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
            <div class="relative flex justify-center items-center w-full">
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
                    :href="route('system.invest.dashboard')"
                >
                    <Button
                        size="small"
                        label="Dashboard"
                        icon="pi pi-chart-bar"
                    />
                </Link>

                <UserMenu
                    class="absolute left-0"
                    v-else-if="$page.props.user.role === 'admin'"
                />

                <div
                    class="flex items-center gap-3 lg:mx-auto lg:justify-center"
                >
                    <p
                        class="hidden text-2xl sm:block lg:text-3xl text-secondary font-chinese"
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

                    <h2 class="hidden text-lg font-bold sm:block lg:text-2xl">
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
                        class="hidden"
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

        <footer
            class="bg-slate-300 flex flex-col items-center lg:flex-row justify-around gap-32 lg:gap-8 px-8 lg:px-16 py-12"
        >
            <div>
                <h5 class="text-3xl">Social Media</h5>

                <div class="flex justify-center items-center gap-4 mt-4">
                    <a
                        href="https://www.facebook.com/meiliteahouseph"
                        target="_blank"
                    >
                        <Button
                            icon="ri-facebook-fill text-slate-50 text-4xl"
                            rounded
                        />
                    </a>

                    <a
                        href="https://www.instagram.com/meiliteahouseph"
                        target="_blank"
                    >
                        <Button
                            icon="ri-instagram-line text-slate-50 text-4xl"
                            rounded
                        />
                    </a>

                    <a href="#">
                        <Button
                            icon="ri-tiktok-fill text-slate-50 text-4xl"
                            rounded
                        />
                    </a>
                </div>
            </div>

            <Divider class="hidden lg:block" layout="vertical" />

            <div class="text-center">
                <h5 class="text-3xl">Office Address</h5>

                <p class="mt-4 text-xl">
                    1559 Pasaje de Rosario Unit 5 Paco Manila, Manila,
                    Philippines
                </p>
            </div>

            <Divider class="hidden lg:block" layout="vertical" />

            <div>
                <h5 class="text-3xl">Contact</h5>

                <div class="flex justify-center items-center gap-4 mt-4">
                    <Button
                        v-tooltip.top="'Click to copy email address'"
                        icon="ri-mail-fill text-slate-50 text-4xl"
                        rounded
                        @click="copyContact('Email Address')"
                    />

                    <Button
                        v-tooltip.top="'Click to copy contact number'"
                        icon="ri-phone-fill text-slate-50 text-4xl"
                        rounded
                        @click="copyContact('Contact Number')"
                    />
                </div>
            </div>
        </footer>
    </main>
</template>

<style scoped>
.p-divider.p-divider-vertical::before {
    @apply border-2 border-slate-900;
}

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
