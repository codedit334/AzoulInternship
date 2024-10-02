<template>
  <div>
    <h1>My Students</h1>
    <ul>
      <li v-for="student in students" :key="student.id">
        {{ student.name }} ({{ student.email }})
        <button @click="deleteStudent(student.id)">Delete</button>
      </li>
    </ul>
    <button @click="goToCreateStudent">Add Student</button>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  name: 'MyStudents',
  props: {
    students: Array,
  },
  methods: {
    deleteStudent(id) {
      if (confirm("Are you sure you want to delete this student?")) {
        Inertia.delete(`/teachers/students/${id}`);
      }
    },
    goToCreateStudent() {
      Inertia.get('/teachers/create-student'); // Navigate to the create student page
    },
  },
};
</script>