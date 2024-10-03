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

      <button type="submit" class="submit-button">Create Teacher</button>
    </form>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        address: '',
        city: '',
        sex: 'male', // Default value for sex
        subject: '',  // This field will only be used if the role is teacher
        level: 1,     // Default level value
      },
    };
  },
  computed: {
    isTeacher() {
      // Assuming you determine the user's role from somewhere (e.g., in the form or via props)
      return true; // Replace this with actual logic to check if the role is teacher
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

.form-input {
  width: 100%; /* Make input fields take full width of the container */
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 14px;
}

.form-input:focus {
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
