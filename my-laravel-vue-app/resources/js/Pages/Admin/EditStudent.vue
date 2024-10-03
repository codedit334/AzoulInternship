<template>
  <div class="edit-student-form">
    <h1 class="form-title">Edit Student</h1>
    <form @submit.prevent="submit" class="form">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" v-model="form.name" required class="form-input">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" v-model="form.email" required class="form-input">
      </div>
      <div class="form-group">
        <label for="password">Password (Leave blank to keep unchanged)</label>
        <input type="password" id="password" v-model="form.password" class="form-input">
      </div>
      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" v-model="form.password_confirmation" class="form-input">
      </div>
      <div class="form-group">
        <label for="teacher_id">Assign Teacher</label>
        <select id="teacher_id" v-model="form.teacher_id" required class="form-select">
          <option value="" disabled>Select a teacher</option>
          <option v-for="teacher in teachers" :key="teacher.id" :value="teacher.id">
            {{ teacher.name }}
          </option>
        </select>
      </div>
      <div class="form-group">
        <label for="level">Level</label>
        <input type="number" id="level" v-model="form.level" min="1" max="6" required class="form-input">
      </div>
      <div class="form-group">
        <label for="sex">Sex</label>
        <select id="sex" v-model="form.sex" required class="form-select">
          <option value="" disabled>Select sex</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" id="address" v-model="form.address" required class="form-input">
      </div>
      <div class="form-group">
        <label for="city">City</label>
        <input type="text" id="city" v-model="form.city" required class="form-input">
      </div>
      <button type="submit" class="submit-button">Update Student</button>
    </form>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    student: Object, // The student data passed from the backend
    teachers: Array, // Pass the teachers data from the backend
  },
  data() {
    return {
      form: {
        name: this.student.name,
        email: this.student.email,
        password: '',
        password_confirmation: '',
        teacher_id: this.student.teacher_id,
        level: this.student.level,
        sex: this.student.sex,
        address: this.student.address,
        city: this.student.city,
      },
    };
  },
  methods: {
    submit() {
      Inertia.put(`/admin/students/${this.student.id}`, this.form);
    },
  },
};
</script>

<style scoped>
.edit-student-form {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.form-title {
  text-align: center;
  color: #333;
  margin-bottom: 20px;
}

.form {
  display: flex;
  flex-direction: column;
}

.form-group {
  margin-bottom: 15px;
}

.form-input, .form-select {
  width: 100%; /* Make input fields take full width of the container */
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 14px;
}

.form-input:focus, .form-select:focus {
  border-color: #2ecc71;
  outline: none;
}

.submit-button {
  background-color: #2ecc71;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 10px 15px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.submit-button:hover {
  background-color: #27ae60;
}
</style>
