<template>
  <div class="create-teacher-form">
    <h1 class="form-title">Create Teacher</h1>
    <form @submit.prevent="submit" class="form">
      <!-- Name -->
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" v-model="form.name" required class="form-input">
      </div>

      <!-- Email -->
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" v-model="form.email" required class="form-input">
      </div>

      <!-- Password -->
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" v-model="form.password" required class="form-input">
      </div>

      <!-- Confirm Password -->
      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" v-model="form.password_confirmation" required class="form-input">
      </div>

      <!-- Address -->
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" id="address" v-model="form.address" required class="form-input">
      </div>

      <!-- City -->
      <div class="form-group">
        <label for="city">City</label>
        <input type="text" id="city" v-model="form.city" required class="form-input">
      </div>

      <!-- Sex -->
      <div class="form-group">
        <label for="sex">Sex</label>
        <select id="sex" v-model="form.sex" required class="form-input">
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>

      <!-- Subject (only for teachers) -->
      <div class="form-group" v-if="isTeacher">
        <label for="subject">Subject</label>
        <input type="text" id="subject" v-model="form.subject" class="form-input">
      </div>

      <!-- Level -->
      <div class="form-group">
        <label for="level">Level</label>
        <input type="number" id="level" v-model="form.level" min="1" max="6" required class="form-input">
      </div>

      <!-- Assign Students (Multiple) -->
      <div class="form-group">
        <label for="student_ids">Assign Students</label>
        <select id="student_ids" v-model="form.student_ids" multiple class="form-select">
          <option value="" disabled>Select Students</option>
          <option v-for="student in students" :key="student.id" :value="student.id">
            {{ student.name }}
          </option>
        </select>
      </div>

      <!-- Assign Schools (Multiple) -->
      <div class="form-group">
        <label for="school_ids">Assign Schools</label>
        <select id="school_ids" v-model="form.school_ids" multiple class="form-select">
          <option value="" disabled>Select Schools</option>
          <option v-for="school in schools" :key="school.id" :value="school.id">
            {{ school.name }}
          </option>
        </select>
      </div>

      <button type="submit" class="submit-button">Create Teacher</button>
    </form>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    students: Array,  // Students data from backend
    schools: Array,   // Schools data from backend
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        address: '',
        city: '',
        sex: 'male',    // Default value for sex
        subject: '',    // Subject field for teachers
        level: 1,       // Default level value
        student_ids: [], // For assigning multiple students
        school_ids: [],  // For assigning multiple schools
      },
    };
  },
  computed: {
    isTeacher() {
      return true;  // Replace with actual role-check logic if needed
    },
  },
  methods: {
    submit() {
      Inertia.post('/admin/store-teacher', this.form);
    },
  },
};
</script>

<style scoped>
.create-teacher-form {
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

.form-input,
.form-select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 14px;
}

.form-input:focus,
.form-select:focus {
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
