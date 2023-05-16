import './bootstrap'
import '../css/app.css'
import '/public/css/themes/light.css'
import 'primeicons/primeicons.css'
import 'primevue/resources/primevue.min.css'

import type { DefineComponent } from 'vue'

import { createSSRApp, h } from 'vue'
import { Head, Link, createInertiaApp } from '@inertiajs/vue3'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'

import PrimeVue from 'primevue/config'
import Button from 'primevue/button'

import Site from './Layouts/Site.vue'
import Invest from './Layouts/Invest.vue'

const appName =
    window.document.getElementsByTagName('title')[0]?.innerText ||
    'Mei Li Tea House'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name: string) => {
        const pages = import.meta.glob<DefineComponent>('./Pages/**/*.vue', {
            eager: true,
        })

        let page = pages[`./Pages/${name}.vue`]

        if (name.startsWith('Investments/')) {
            page.default.layout = Invest
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
            .use(ZiggyVue, (window as any).Ziggy)
            .use(PrimeVue, { ripple: true })
            .mount(el)
    },
    progress: {
        color: '#890202',
    },
})
