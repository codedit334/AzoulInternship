<template>
  <div class="admin-dashboard">
    <h1 class="title">Admin Dashboard</h1>

    <!-- Add School Button -->
    <button class="add-school-button" @click="goToAddSchool">Add School</button>

    <!-- Teachers Section -->
    <div class="section">
      <h2 class="section-title">Teachers</h2>
      <table class="user-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Schools</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="teacher in teachers" :key="teacher.id">
            <td>{{ teacher.name }}</td>
            <td>{{ teacher.email }}</td>
            <td>
              <ul>
                <li v-for="school in teacher.schools" :key="school.id">{{ school.name }}</li>
              </ul>
            </td>
            <td>
              <button class="edit-button" @click="goToEditTeacher(teacher.id)">Edit</button>
              <button class="delete-button" @click="deleteUser(teacher.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
      <button class="add-button" @click="goToCreateTeacher">Add Teacher</button>
    </div>

    <!-- Students Section -->
    <div class="section">
      <h2 class="section-title">Students</h2>
      <table class="user-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>School</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="student in students" :key="student.id">
            <td>{{ student.name }}</td>
            <td>{{ student.email }}</td>
<td>
              <ul>
                <li v-for="school in student.schools" :key="school.id">{{ school.name }}</li>
              </ul>
            </td>            <td>
              <button class="edit-button" @click="goToEditStudent(student.id)">Edit</button>
              <button class="delete-button" @click="deleteUser(student.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
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
      Inertia.get(`/admin/edit-teacher/${id}`);
    },
    goToEditStudent(id) {
      Inertia.get(`/admin/edit-student/${id}`);
    },
    goToAddSchool() {
      Inertia.get('/admin/add-school');
    },
  },
};
</script>

<style scoped>
.admin-dashboard {
  max-width: 1000px;
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

.add-school-button {
  background-color: #f39c12;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 10px 15px;
  cursor: pointer;
  transition: background-color 0.3s;
  display: block;
  margin: 0 auto 20px;
}

.add-school-button:hover {
  background-color: #e67e22;
}

.section {
  margin-top: 20px;
}

.section-title {
  font-size: 1.5rem;
  margin-bottom: 10px;
  color: #555;
}

.user-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

.user-table th,
.user-table td {
  padding: 10px;
  border: 1px solid #ddd;
}

.user-table th {
  background-color: #f0f0f0;
  text-align: left;
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
  background-color: #3498db;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 5px 10px;
  cursor: pointer;
  transition: background-color 0.3s;
  margin-right: 5px;
}

.edit-button:hover {
  background-color: #2980b9;
}
</style>
