<template>
  <div>
    <h1>Admin Dashboard</h1>

    <h2>Teachers</h2>
    <ul>
      <li v-for="teacher in teachers" :key="teacher.id">
        {{ teacher.name }} ({{ teacher.email }})
        <button @click="deleteUser(teacher.id)">Delete</button>
      </li>
    </ul>
    <button @click="goToCreateTeacher">Add Teacher</button>

    <h2>Students</h2>
    <ul>
      <li v-for="student in students" :key="student.id">
        {{ student.name }} ({{ student.email }})
        <button @click="deleteUser(student.id)">Delete</button>
      </li>
    </ul>
    <button @click="goToCreateStudent">Add Student</button>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  name: 'AdminIndex',
  props: {
    teachers: Array,
    students: Array,
  },
  methods: {
    deleteUser(id) {
      if (confirm('Are you sure you want to delete this user?')) {
        Inertia.delete(`/admin/users/${id}`);
      }
    },
    goToCreateTeacher() {
      Inertia.get('/admin/create-teacher');
    },
    goToCreateStudent() {
      Inertia.get('/admin/create-student');
    },
  },
};
</script>

<style scoped>
/* Add your styles here */
</style>
