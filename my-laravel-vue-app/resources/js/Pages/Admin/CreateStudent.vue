<template>
  <div class="create-student-form">
    <h1 class="form-title">Create Student</h1>
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
        <label for="password">Password</label>
        <input type="password" id="password" v-model="form.password" required class="form-input">
      </div>
      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" v-model="form.password_confirmation" required class="form-input">
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
      <button type="submit" class="submit-button">Create Student</button>
    </form>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    teachers: Array, // Pass the teachers data from the backend
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        teacher_id: '',
      },
    };
  },
  methods: {
    submit() {
      Inertia.post('/admin/store-student', this.form);
    },
  },
};
</script>

<style scoped>
.create-student-form {
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

.label {
  font-weight: bold;
  margin-bottom: 5px;
  color: #555;
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
