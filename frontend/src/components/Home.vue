<template>
  <div class="container">
    <h2 class="title">Tarefas</h2>
    <ul class="tasks-list">
      <li v-for="task in tasks.data" :key="task.id" class="task-item">
        <h3 class="task-title">{{ task.title }}</h3>
        <p class="task-description">{{ task.description }}</p>
        <div class="task-icons">
          <span @click="editTask(task.id)">
            <i class="fas fa-edit"></i>
          </span>
          <span @click="deleteTask()">
            <i class="fas fa-trash-alt"></i>
          </span>
        </div>
      </li>
    </ul>
  </div>
</template>

<script lang="ts">

import axios from 'axios';
import Cookie from 'js-cookie';
import '@fortawesome/fontawesome-free/css/all.css';

export default {
  name: 'Home',
  data() {
    return {
      tasks: [] as any,
    }
  },
  created() {
    const token = Cookie.get('token');
    
    if (!token) {
      this.$router.push({ name: 'Login' });
    } else {
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
      
  
      axios.get('http://localhost:8000/api/tasks')
        .then(response => {
          this.tasks = response.data;
          console.log('Dados das tarefas:', response.data);
        })
        .catch(error => {
          console.error('Erro ao obter dados das tarefas:', error);
        });
    }
  },
  methods: {
    editTask(task: any) {

    },
    deleteTask(taskId: number) {

    }
  },
};
</script>

<style scoped>
.container {
  width: 100vw;
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.title {
  margin-bottom: 20px;
}

.tasks-list {
  list-style-type: none;
  padding: 0;
}

.task-item {
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  width: 300px;
}

.task-title {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 5px;
}

.task-description {
  font-size: 14px;
  color: #666;
}
.container {
  width: 100vw;
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.title {
  margin-bottom: 20px;
}

.tasks-list {
  list-style-type: none;
  padding: 0;
}

.task-item {
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  width: 300px;
  position: relative; /* Make the task item relative for absolute positioning */
}

.task-title {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 5px;
}

.task-description {
  font-size: 14px;
  color: #666;
}

.task-icons {
  position: absolute; 
  bottom: 5px; 
  right: 5px;
  display: flex; 
}

.task-icons i {
  margin-left: 5px;
  cursor: pointer;
}

</style>