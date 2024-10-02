<template>
  <div>
    <h1>My Students</h1>

    <!-- Assigned Students Section -->
    <h2>Assigned Students</h2>
    <ul v-if="assignedStudents.length">
      <li v-for="student in assignedStudents" :key="student.id">
        {{ student.name }} ({{ student.email }})
        <button @click="unassignStudent(student.id)">Unassign</button>
        <button @click="deleteStudent(student.id)">Delete</button>
      </li>
    </ul>
    <p v-else>No assigned students.</p>

    <!-- Unassigned Students Section -->
    <h2>Unassigned Students</h2>
    <ul v-if="unassignedStudents.length">
      <li v-for="student in unassignedStudents" :key="student.id">
        {{ student.name }} ({{ student.email }})
        <button @click="assignStudent(student.id)">Assign to Me</button>
        <button @click="deleteStudent(student.id)">Delete</button>
      </li>
    </ul>
    <p v-else>No unassigned students.</p>

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
    // Method to delete a student
    deleteStudent(id) {
      if (confirm("Are you sure you want to delete this student?")) {
        Inertia.delete(`/teachers/students/${id}`);
      }
    },
    // Method to assign an unassigned student to the current teacher
    assignStudent(id) {
      if (confirm("Do you want to assign this student to yourself?")) {
        Inertia.post(`/teachers/assign-student/${id}`);
      }
    },
    // Method to unassign a student from the current teacher
    unassignStudent(id) {
      if (confirm("Do you want to unassign this student?")) {
        Inertia.post(`/teachers/unassign-student/${id}`);
      }
    },
    // Navigate to the create student page
    goToCreateStudent() {
      Inertia.get('/teachers/create-student');
    },
  },
};
</script>
