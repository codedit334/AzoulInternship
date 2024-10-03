<template>
  <div class="teachers-list-container">
    <h1>Teachers List</h1>
    <ul class="teachers-list">
      <li v-for="teacher in teachers" :key="teacher.id" class="teacher-item">
        {{ teacher.name }} ({{ teacher.email }})
      </li>
    </ul>
    <button @click="goToMyStudents" class="my-students-button">Go to My Students</button>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  name: 'TeachersIndex',
  props: {
    teachers: Array,
  },
  methods: {
    goToMyStudents() {
      // Navigate to the my-students page
      Inertia.get('/teachers/my-students');
    },
  },
};
</script>

<style scoped>
.teachers-list-container {
  max-width: 600px;
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

.teachers-list {
  list-style-type: none;
  padding: 0;
}

.teacher-item {
  padding: 10px;
  border-bottom: 1px solid #ddd;
  transition: background-color 0.3s;
}

.teacher-item:last-child {
  border-bottom: none;
}

.teacher-item:hover {
  background-color: #f1f1f1;
}

.my-students-button {
  display: block;
  width: 100%;
  margin-top: 20px;
  padding: 10px 15px;
  background-color: #3498db; /* Change this to your preferred color */
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.2s;
}

.my-students-button:hover {
  background-color: #2980b9; /* Darker shade for hover effect */
  transform: translateY(-2px); /* Slight lift effect */
}
</style>
