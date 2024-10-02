import { createRouter, createWebHistory } from 'vue-router';
import StudentList from '../components/StudentList.vue';
import TeacherList from '../components/TeacherList.vue';

const routes = [
    {
        path: '/students',
        name: 'StudentList',
        component: StudentList,
    },
    {
        path: '/teachers',
        name: 'TeacherList',
        component: TeacherList,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
