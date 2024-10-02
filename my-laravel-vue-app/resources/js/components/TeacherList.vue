<template>
    <div>
        <h1>Teachers</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="teacher in teachers" :key="teacher.id">
                    <td>{{ teacher.name }}</td>
                    <td>{{ teacher.email }}</td>
                    <td>
                        <button @click="deleteTeacher(teacher.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';

export default {
    setup() {
        const teachers = ref([]);

        const fetchTeachers = async () => {
            const response = await axios.get('/api/teachers'); // Assuming you have an API endpoint
            teachers.value = response.data;
        };

        const deleteTeacher = async (id) => {
            await axios.delete(`/api/teachers/${id}`);
            fetchTeachers();
        };

        fetchTeachers(); // Fetch teachers on component mount

        return {
            teachers,
            deleteTeacher,
        };
    },
};
</script>
