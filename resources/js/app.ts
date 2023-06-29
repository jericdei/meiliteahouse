import './bootstrap'
import '../css/app.css'
import '/public/css/themes/light.css'
import 'primeicons/primeicons.css'
import 'primevue/resources/primevue.min.css'

import { Head, Link, createInertiaApp } from '@inertiajs/vue3'
import { createSSRApp, h } from 'vue'

import Button from 'primevue/button'
import ConfirmationService from 'primevue/confirmationservice'
import type { DefineComponent } from 'vue'
import DialogService from 'primevue/dialogservice'
import Franchise from './Layouts/Franchise.vue'
import Image from 'primevue/image'
import Invest from './Layouts/Invest.vue'
import PrimeVue from 'primevue/config'
import Site from './Layouts/Site.vue'
import ToastService from 'primevue/toastservice'
import Tooltip from 'primevue/tooltip'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'

const appName =
    window.document.getElementsByTagName('title')[0]?.innerText ||
    'Mei Li Tea House'

createInertiaApp({
    title: title => `${title} - ${appName}`,
    resolve: async name => {
        const page = await resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./Pages/**/*.vue')
        )

        if (name.startsWith('Admin/Investments/')) {
            page.default.layout = Invest
        } else if (name.startsWith('Admin/Franchise/')) {
            page.default.layout = Franchise
        } else if (name.startsWith('Site/')) {
            page.default.layout = Site
        } else {
            page.default.layout = undefined
        }

        return page
    },
    setup({ el, App, props, plugin }) {
        createSSRApp({ render: () => h(App, props) })
            .use(plugin)
            .component('Head', Head)
            .component('Link', Link)
            .component('router-link', {
                props: ['to', 'custom'],
                template: `
                    <Link :href="to">
                    <slot />
                    </Link>`,
            })
            .component('Button', Button)
            .component('Image', Image)
            .use(ToastService)
            .use(ConfirmationService)
            .use(DialogService)
            .use(ZiggyVue, Ziggy)
            .directive('tooltip', Tooltip)
            .use(PrimeVue, { ripple: true })
            .mount(el)
    },
    progress: {
        color: '#890202',
    },
})
