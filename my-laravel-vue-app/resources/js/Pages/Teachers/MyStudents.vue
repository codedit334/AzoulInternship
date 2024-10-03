<template>
  <div class="my-students-container">
    <h1>My Students</h1>

    <!-- Assigned Students Section -->
    <h2>Assigned Students</h2>
    <ul v-if="assignedStudents.length" class="students-list">
      <li v-for="student in assignedStudents" :key="student.id" class="student-item">
        {{ student.name }} ({{ student.email }})
        <div class="buttons">
          <button @click="unassignStudent(student.id)" class="unassign-button">Unassign</button>
          <button @click="deleteStudent(student.id)" class="delete-button">Delete</button>
        </div>
      </li>
    </ul>
    <p v-else class="no-students-message">No assigned students.</p>

    <!-- Unassigned Students Section -->
    <h2>Unassigned Students</h2>
    <ul v-if="unassignedStudents.length" class="students-list">
      <li v-for="student in unassignedStudents" :key="student.id" class="student-item">
        {{ student.name }} ({{ student.email }})
        <div class="buttons">
          <button @click="assignStudent(student.id)" class="assign-button">Assign to Me</button>
          <button @click="deleteStudent(student.id)" class="delete-button">Delete</button>
        </div>
      </li>
    </ul>
    <p v-else class="no-students-message">No unassigned students.</p>

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

<style scoped>
.my-students-container {
  max-width: 800px;
  margin: 20px auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  color: #333;
}

h2 {
  margin-top: 20px;
  color: #3498db; /* Change this to your preferred color */
}

.students-list {
  list-style-type: none;
  padding: 0;
}

.student-item {
  padding: 10px;
  border-bottom: 1px solid #ddd;
  display: flex;
  justify-content: space-between;
  align-items: center;
  transition: background-color 0.3s;
}

.student-item:last-child {
  border-bottom: none;
}

.student-item:hover {
  background-color: #f1f1f1;
}

.buttons {
  display: flex;
  gap: 10px; /* Space between buttons */
}

.assign-button,
.unassign-button,
.delete-button {
  padding: 5px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.assign-button {
  background-color: #28a745; /* Green */
  color: white;
}

.assign-button:hover {
  background-color: #218838; /* Darker green */
}

.unassign-button {
  background-color: #ffc107; /* Yellow */
  color: white;
}

.unassign-button:hover {
  background-color: #e0a800; /* Darker yellow */
}

.delete-button {
  background-color: #dc3545; /* Red */
  color: white;
}

.delete-button:hover {
  background-color: #c82333; /* Darker red */
}

.no-students-message {
  text-align: center;
  color: #666;
  margin-top: 10px;
}
</style>
