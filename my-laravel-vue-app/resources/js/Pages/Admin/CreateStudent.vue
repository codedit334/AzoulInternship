<template>
  <div>
    <h1>Create Student</h1>
    <form @submit.prevent="createStudent">
      <div>
        <label>Name</label>
        <input v-model="name" type="text" required />
      </div>
      <div>
        <label>Email</label>
        <input v-model="email" type="email" required />
      </div>
      <button type="submit">Create Student</button>
    </form>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  name: 'CreateStudent',
  data() {
    return {
      name: '',
      email: '',
    };
  },
  methods: {
    createStudent() {
      Inertia.post('/admin/store-student', { name: this.name, email: this.email });
    },
  },
};
</script>

<style scoped>
/* Add your styles here */
</style>
