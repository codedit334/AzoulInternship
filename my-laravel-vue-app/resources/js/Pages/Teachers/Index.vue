<template>
  <div>
    <h1>Teachers List</h1>
    <ul>
      <li v-for="teacher in teachers" :key="teacher.id">
        {{ teacher.name }} ({{ teacher.email }})
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'TeachersIndex',
  props: {
    teachers: Array,
  },
};
</script>