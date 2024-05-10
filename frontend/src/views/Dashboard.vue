<template>
  <div class="task-list">
    <h2>Lista de Tarefas</h2>
    <table>
      <thead>
        <tr>
          <th class="task-id">ID</th>
          <th class="task-title">TITLE</th>
          <th class="task-description">DESCRIPTION</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="responseData && responseData.length">
          <td :colspan="3" v-if="isLoading">Carregando...</td>
        </tr>
        <tr v-else-if="responseData && responseData.data && responseData.data.length" v-for="task in responseData.data" :key="task.id">
          <td>{{ task.id }}</td>
          <td>{{ task.title }}</td>
          <td>{{ task.description }}</td>
        </tr>
        <tr v-else-if="errorMessage">
          <td :colspan="3">{{ errorMessage }}</td>
        </tr>
        <tr v-else>
          <td :colspan="3">Nenhuma tarefa encontrada.</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import http from '@/services/http.js'
import { ref, onMounted } from 'vue';

export default {
  setup() {
    const responseData = ref([]);
    const errorMessage = ref(null);
    const isLoading = ref(false);

    function isAuthenticated() {
      const token = localStorage.getItem('token');
      return token !== null && token !== undefined;
    }

    async function fetchData() {
      if (isAuthenticated()) {
        const token = localStorage.getItem('token');
        const headers = { Authorization: `Bearer ${token}` };

        try {
          isLoading.value = true;
          const response = await http.get('/tasks', { headers });
          responseData.value = response.data;
        } catch (error) {
          errorMessage.value = error.message;
        } finally {
          isLoading.value = false;
        }
      } else {
        errorMessage.value = 'Usuário não autenticado. Faça login para acessar esta página.';
      }
    }

    onMounted(fetchData);

    return { responseData, errorMessage, isLoading };
  }
}
</script>

<style scoped>
.task-id, .task-title, .task-description {
  color: #1bc738;
}
.task-list {
  max-width: 800px;
  margin: 0 auto;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #1bc738;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #1f1e1e;
}

tr:nth-child(even) {
  background-color: #f5f5f5;
}

tr:hover {
  background-color: #00ff2a;
}

.error-message {
  color: red;
}
</style>
