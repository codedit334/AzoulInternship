<template>
  <div>
    <h1>Create Teacher</h1>
    <form @submit.prevent="createTeacher">
      <div>
        <label>Name</label>
        <input v-model="name" type="text" required />
      </div>
      <div>
        <label>Email</label>
        <input v-model="email" type="email" required />
      </div>
      <button type="submit">Create Teacher</button>
    </form>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  name: 'CreateTeacher',
  data() {
    return {
      name: '',
      email: '',
    };
  },
  methods: {
    createTeacher() {
      Inertia.post('/admin/store-teacher', { name: this.name, email: this.email });
    },
  },
};
</script>

<style scoped>
/* Add your styles here */
</style>
