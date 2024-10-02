<template>
  <div>
    <h1>Create Teacher</h1>
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
      <button type="submit">Create Teacher</button>
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
      },
    };
  },
  methods: {
    submit() {
      Inertia.post('/admin/store-teacher', this.form);
    },
  },
};
</script>
