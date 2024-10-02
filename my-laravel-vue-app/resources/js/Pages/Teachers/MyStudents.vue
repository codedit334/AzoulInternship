<template>
  <div>
    <h1>My Students</h1>
    <ul>
      <li v-for="student in assignedStudents" :key="student.id">
        {{ student.name }} ({{ student.email }})
        <button @click="deleteStudent(student.id)">Delete</button>
      </li>
    </ul>

    <h2>Unassigned Students</h2>
    <ul>
      <li v-for="student in unassignedStudents" :key="student.id">
        {{ student.name }} ({{ student.email }})
        <button @click="assignStudent(student.id)">Assign to Me</button>
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
    assignedStudents: Array,
    unassignedStudents: Array,
  },
  methods: {
    deleteStudent(id) {
      if (confirm("Are you sure you want to delete this student?")) {
        Inertia.delete(`/teachers/students/${id}`);
      }
    },
    assignStudent(id) {
      if (confirm("Do you want to assign this student to yourself?")) {
        Inertia.post(`/teachers/assign-student/${id}`);
      }
    },
    goToCreateStudent() {
      Inertia.get('/teachers/create-student');
    },
  },
};
</script>
