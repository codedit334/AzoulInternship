<template>
  <div class="edit-teacher-form">
    <h1 class="form-title">Edit Teacher</h1>
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
        <label for="address">Address</label>
        <input type="text" id="address" v-model="form.address" required class="form-input">
      </div>
      <div class="form-group">
        <label for="city">City</label>
        <input type="text" id="city" v-model="form.city" required class="form-input">
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
        <label for="subject">Subject</label>
        <input type="text" id="subject" v-model="form.subject" class="form-input">
      </div>
      <div class="form-group">
        <label for="level">Level</label>
        <input type="number" id="level" v-model="form.level" min="1" max="6" required class="form-input">
      </div>
      <button type="submit" class="submit-button">Update Teacher</button>
    </form>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    teacher: Object,
  },
  data() {
    return {
      form: {
        name: this.teacher.name,
        email: this.teacher.email,
        password: '',
        password_confirmation: '',
        address: this.teacher.address,
        city: this.teacher.city,
        sex: this.teacher.sex,
        subject: this.teacher.subject,
        level: this.teacher.lvl,
      },
    };
  },
  methods: {
    submit() {
      Inertia.put(`/admin/teachers/${this.teacher.id}`, this.form, {
        onSuccess: () => {
          // Redirect to the admin index page after successful update
          Inertia.get('/admin/index');
        },
      });
    },
  },
};
</script>

<style scoped>
.edit-teacher-form {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.form-title {
  text-align: center;
  color: #333;
}

.form-group {
  margin-bottom: 15px;
}

.form-input,
.form-select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.submit-button {
  background-color: #2ecc71;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 10px 15px;
  cursor: pointer;
  width: 100%;
  transition: background-color 0.3s;
}

.submit-button:hover {
  background-color: #27ae60;
}
</style>
