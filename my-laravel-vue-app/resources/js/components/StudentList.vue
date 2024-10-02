<template>
    <div>
        <h1>Students</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="student in students" :key="student.id">
                    <td>{{ student.name }}</td>
                    <td>{{ student.email }}</td>
                    <td>
                        <button @click="deleteStudent(student.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <form @submit.prevent="addStudent">
            <input v-model="newStudent.name" placeholder="Name" required />
            <input v-model="newStudent.email" type="email" placeholder="Email" required />
            <input v-model="newStudent.password" type="password" placeholder="Password" required />
            <button type="submit">Add Student</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';

export default {
    setup() {
        const students = ref([]);
        const newStudent = ref({ name: '', email: '', password: '' });

        const fetchStudents = async () => {
            const response = await axios.get('/api/students');
            students.value = response.data;
        };

        const addStudent = async () => {
            await axios.post('/api/students', newStudent.value);
            newStudent.value = { name: '', email: '', password: '' };
            fetchStudents();
        };

        const deleteStudent = async (id) => {
            await axios.delete(`/api/students/${id}`);
            fetchStudents();
        };

        fetchStudents(); // Fetch students on component mount

        return {
            students,
            newStudent,
            addStudent,
            deleteStudent,
        };
    },
};
</script>
