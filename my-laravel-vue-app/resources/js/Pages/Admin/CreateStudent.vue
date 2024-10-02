<template>
  <div>
    <h1>Create Student</h1>
    <form @submit.prevent="submit">
      <div>
        <label>Name</label>
        <input type="text" v-model="form.name" required>
      </div>
      <div>
        <label>Email</label>
        <input type="email" v-model="form.email" required>
      </div>
      <div>
        <label>Password</label>
        <input type="password" v-model="form.password" required>
      </div>
      <div>
        <label>Confirm Password</label>
        <input type="password" v-model="form.password_confirmation" required>
      </div>
      <div>
        <label>Assign Teacher</label>
        <select v-model="form.teacher_id" required>
          <option v-for="teacher in teachers" :key="teacher.id" :value="teacher.id">
            {{ teacher.name }}
          </option>
        </select>
      </div>
      <button type="submit">Create Student</button>
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
