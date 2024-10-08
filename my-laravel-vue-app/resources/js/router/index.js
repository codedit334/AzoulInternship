import { createRouter, createWebHistory } from 'vue-router';
import StudentList from '../components/StudentList.vue';
import TeacherList from '../components/TeacherList.vue';
import Login from '../components/Login.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        // component: Login,
    },
    {
        path: '/admin',
        name: 'Admin',
        // component: StudentList,
        // meta: { requiresAuth: true }, // Protect this route
    },
    {
        path: '/teachers',
        name: 'TeacherList',
        component: TeacherList,
        meta: { requiresAuth: true }, // Protect this route
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Route guard to check authentication
router.beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem('user'); // Check if user is authenticated
    if (to.meta.requiresAuth && !isAuthenticated) {
        next({ name: 'Login' });
    } else {
        next();
    }
});

export default router;
