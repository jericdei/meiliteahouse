import './bootstrap';
import '../css/app.css';
import '/public/css/themes/light.css';
import 'primeicons/primeicons.css';
import 'primevue/resources/primevue.min.css';

import { createSSRApp, h, DefineComponent } from 'vue';
import { renderToString } from '@vue/server-renderer';
import { Head, Link, createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

import PrimeVue from 'primevue/config';
import Button from 'primevue/button';
import Tooltip from 'primevue/tooltip';
import Image from 'primevue/image';
import ToastService from 'primevue/toastservice';
import ConfirmationService from 'primevue/confirmationservice';
import DialogService from 'primevue/dialogservice';

import Site from './Layouts/Site.vue';
import Invest from './Layouts/Invest.vue';

const appName =
    window.document.getElementsByTagName('title')[0]?.innerText ||
    'Mei Li Tea House';

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
                );

                if (name.startsWith('Investments/')) {
                    page.default.layout = Invest;
                } else if (name.startsWith('Site/')) {
                    page.default.layout = Site;
                } else {
                    page.default.layout = undefined;
                }

                return page;
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
                    .component('Image', Image)
                    .use(ToastService)
                    .use(ConfirmationService)
                    .use(DialogService)
                    .use(ZiggyVue, {
                        // @ts-expect-error
                        ...page.props.ziggy,
                        // @ts-expect-error
                        location: new URL(page.props.ziggy.location),
                    })
                    .directive('tooltip', Tooltip)
                    .use(PrimeVue, { ripple: true });
            },
        }),
    13711
);
