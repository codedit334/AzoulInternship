<template>
  <div>
    <h1>Create Student</h1>
    <form @submit.prevent="submit">
      <div>
        <label>Name:</label>
        <input type="text" v-model="form.name" required />
      </div>
      <div>
        <label>Email:</label>
        <input type="email" v-model="form.email" required />
      </div>
      <button type="submit">Create</button>
    </form>
  </div>
</template>

<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default {
  name: 'CreateStudent',
  setup() {
    const form = ref({
      name: '',
      email: '',
    });

    const submit = () => {
      Inertia.post('/teachers/store-student', form.value);
    };

    return {
      form,
      submit,
    };
  },
};
</script>