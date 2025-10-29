import '../css/app.css';
import './bootstrap';

import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {createApp, h} from 'vue';
import {ZiggyVue} from '../../vendor/tightenco/ziggy';
import getI18n from "@/Configs/I18n.js";

let appName = '';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({el, App, props, plugin}) {
        const app = createApp({render: () => h(App, props)});
        const i18n = getI18n(props.initialPage.props.locale);

        switch (props.initialPage.props.locale) {
            case "ar":
                appName = props.initialPage.props.app_name;
                break;
            case "ku":
                appName = props.initialPage.props.app_name;
                break;
        }
        app.use(plugin);
        app.use(ZiggyVue);
        app.use(i18n);
        app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
