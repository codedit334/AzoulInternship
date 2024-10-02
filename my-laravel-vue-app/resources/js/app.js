import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import { createRouter, createWebHistory } from 'vue-router';
import StudentList from './components/StudentList.vue';
import TeacherList from './components/TeacherList.vue';
import App from './components/App.vue';
import router from './router';

const app = createApp(App);

app.use(router);
app.component('student-list', StudentList); // Register StudentList component
app.component('teacher-list', TeacherList); // Register TeacherList component

app.mount('#app');

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
