import { createSSRApp, h, DefineComponent } from 'vue'
import { renderToString } from '@vue/server-renderer'
import { Head, Link, createInertiaApp } from '@inertiajs/vue3'
import createServer from '@inertiajs/vue3/server'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'

import PrimeVue from 'primevue/config'
import Button from 'primevue/button'

import Site from './Layouts/Site.vue'
import Invest from './Layouts/Invest.vue'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'

const appName =
    window.document.getElementsByTagName('title')[0]?.innerText ||
    'Mei Li Tea House'

createServer(
    (page) =>
        createInertiaApp({
            page,
            render: renderToString,
            title: (title) => `${title} - ${appName}`,
            resolve: async (name) => {
                const page = await resolvePageComponent(
                    `./Pages/${name}.vue`,
                    import.meta.glob<DefineComponent>('./Pages/**/*.vue')
                )

                if (name.startsWith('Investments/')) {
                    page.default.layout = Invest
                } else if (name.startsWith('Site/')) {
                    page.default.layout = Site
                } else {
                    page.default.layout = undefined
                }

                return page
            },
            setup({ App, props, plugin }) {
                return createSSRApp({ render: () => h(App, props) })
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
                    .use(ZiggyVue, {
                        // @ts-expect-error
                        ...page.props.ziggy,
                        // @ts-expect-error
                        location: new URL(page.props.ziggy.location),
                    })
                    .use(PrimeVue, { ripple: true })
            },
        }),
    13711
)
