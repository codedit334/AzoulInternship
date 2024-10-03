<template>
  <div class="teacher-container">
    <h1 class="title">My Teacher</h1>
    <div v-if="teacher" class="teacher-info">
      <p><strong>Name:</strong> {{ teacher.name }}</p>
      <p><strong>Email:</strong> {{ teacher.email }}</p>
    </div>

    <h2 class="subtitle">Students with the Same Teacher</h2>
    <ul class="students-list">
      <template v-if="similarStudents.length">
        <li v-for="student in similarStudents" :key="student.id" class="student-item">
          {{ student.name }} ({{ student.email }})
        </li>
      </template>
      <template v-else>
        <li class="student-item no-data">No students assigned to this teacher.</li>
      </template>
    </ul>

    <h2 class="subtitle">All Students</h2>
    <ul class="students-list">
      <template v-if="allStudents.length">
        <li v-for="student in allStudents" :key="student.id" class="student-item">
          {{ student.name }} ({{ student.email }})
        </li>
      </template>
      <template v-else>
        <li class="student-item no-data">No students available.</li>
      </template>
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
.teacher-container {
  max-width: 800px;
  margin: 20px auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.title {
  text-align: center;
  color: #333;
}

.teacher-info {
  margin-bottom: 20px;
  padding: 10px;
  background-color: #e9ecef; /* Light background for teacher info */
  border-radius: 5px;
}

.subtitle {
  margin-top: 20px;
  color: #3498db; /* Change this to your preferred color */
}

.students-list {
  list-style-type: none;
  padding: 0;
}

.student-item {
  padding: 10px;
  border-bottom: 1px solid #ddd;
  transition: background-color 0.3s;
}

.student-item:last-child {
  border-bottom: none;
}

.student-item:hover {
  background-color: #f1f1f1;
}

.no-data {
  color: #777; /* Grey color for no data message */
  padding: 10px;
  text-align: center;
}
</style>
