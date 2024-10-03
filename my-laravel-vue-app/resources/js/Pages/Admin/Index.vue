<template>
  <div class="admin-dashboard">
    <h1 class="title">Admin Dashboard</h1>

    <div class="section">
      <h2 class="section-title">Teachers</h2>
      <ul class="user-list">
        <li v-for="teacher in teachers" :key="teacher.id" class="user-item">
          <span>{{ teacher.name }} ({{ teacher.email }})</span>
          <div>
            <button class="edit-button" @click="goToEditTeacher(teacher.id)">Edit</button>
            <button class="delete-button" @click="deleteUser(teacher.id)">Delete</button>
          </div>
        </li>
      </ul>
      <button class="add-button" @click="goToCreateTeacher">Add Teacher</button>
    </div>

    <div class="section">
      <h2 class="section-title">Students</h2>
      <ul class="user-list">
        <li v-for="student in students" :key="student.id" class="user-item">
          <span>{{ student.name }} ({{ student.email }})</span>
          <div>
            <button class="edit-button" @click="goToEditStudent(student.id)">Edit</button>
            <button class="delete-button" @click="deleteUser(student.id)">Delete</button>
          </div>
        </li>
      </ul>
      <button class="add-button" @click="goToCreateStudent">Add Student</button>
    </div>
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
    goToEditTeacher(id) {
      Inertia.get(`/admin/edit-teacher/${id}`); // Route to the edit teacher page
    },
    goToEditStudent(id) {
      Inertia.get(`/admin/edit-student/${id}`); // Route to the edit student page
    },
  },
};
</script>


<style scoped>
.admin-dashboard {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.title {
  text-align: center;
  color: #333;
}

.section {
  margin-top: 20px;
}

.section-title {
  font-size: 1.5rem;
  margin-bottom: 10px;
  color: #555;
}

.user-list {
  list-style: none;
  padding: 0;
}

.user-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 4px;
  margin-bottom: 8px;
}

.delete-button {
  background-color: #e74c3c;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 5px 10px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.delete-button:hover {
  background-color: #c0392b;
}

.add-button {
  background-color: #2ecc71;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 10px 15px;
  cursor: pointer;
  margin-top: 10px;
  display: block;
  width: 100%;
  text-align: center;
  transition: background-color 0.3s;
}

.add-button:hover {
  background-color: #27ae60;
}

.edit-button {
  background-color: #3498db; /* Blue color */
  color: white;
  border: none;
  border-radius: 4px;
  padding: 5px 10px;
  cursor: pointer;
  transition: background-color 0.3s;
  margin-right: 5px; /* Add some space between buttons */
}

.edit-button:hover {
  background-color: #2980b9; /* Darker blue on hover */
}
</style>
