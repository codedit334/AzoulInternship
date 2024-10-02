<template>
  <div>
    <h1>My Teacher</h1>
    <div v-if="teacher">
      <p>Name: {{ teacher.name }}</p>
      <p>Email: {{ teacher.email }}</p>
    </div>

    <h2>Students with the Same Teacher</h2>
    <ul>
      <li v-for="student in similarStudents" :key="student.id">
        {{ student.name }} ({{ student.email }})
      </li>
    </ul>

    <h2>All Students</h2>
    <ul>
      <li v-for="student in allStudents" :key="student.id">
        {{ student.name }} ({{ student.email }})
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'StudentIndex',
  props: {
    teacher: Object,
    similarStudents: Array,
    allStudents: Array,
  },
};
</script>

<style scoped>
/* Add your styles here */
</style>
