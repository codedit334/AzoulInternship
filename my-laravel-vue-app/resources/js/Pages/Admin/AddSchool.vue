<template>
  <div class="create-school-form">
    <h1 class="form-title">Create School</h1>
    <form @submit.prevent="submit" class="form">
      <!-- School Name -->
      <div class="form-group">
        <label for="name">School Name</label>
        <input type="text" id="name" v-model="form.name" required class="form-input">
      </div>

      <button type="submit" class="submit-button">Create School</button>
    </form>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  data() {
    return {
      form: {
        name: '', // Only capture the school name in the form
      },
    };
  },
  methods: {
    submit() {
      Inertia.post('/admin/store-school', this.form); // Submit only the school name to the server
    },
  },
};
</script>

<style scoped>
.create-school-form {
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
