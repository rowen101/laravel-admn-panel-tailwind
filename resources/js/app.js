import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp, router } from '@inertiajs/vue3';
import { createPinia } from 'pinia'
import { useDarkModeStore } from '@/Stores/darkMode.js'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
//swal alert

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const appName = import.meta.env.VITE_APP_NAME || 'SLI';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css'
const pinia = createPinia();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            app.use(plugin)
            app.use(ElementPlus)
            app.use(ZiggyVue, Ziggy)
            app.use(VueSweetalert2),
            window.Swal = app.config.globalProperties.$swal;
            app.mount(el)
    },
    progress: {
        color: '#0076ff',
    },
});

const darkModeStore = useDarkModeStore(pinia)

if (
   (!localStorage['darkMode'] && window.matchMedia('(prefers-color-scheme: dark)').matches) ||
   localStorage['darkMode'] === '1'
 ) {
   darkModeStore.set(true)
}

