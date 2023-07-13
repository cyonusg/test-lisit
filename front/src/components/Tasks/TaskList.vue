<template>
    <div class="p-4">
      <h2 class="text-3xl mb-4">Listar Tareas</h2>
      <table class="min-w-full divide-y divide-gray-200">
        <thead>
          <tr>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Estado</th>
            <th class="px-6 py-3 bg-gray-50"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task, index in tasks" :key="task.id">
            <td class="px-6 py-4 whitespace-no-wrap">{{ task.title }}</td>
            <td class="px-6 py-4 whitespace-no-wrap">{{ task.completed ? 'Completada' : 'Pendiente' }}</td>
            <td class="px-6 py-4 whitespace-no-wrap">
              <button @click="deleteTask(task.id)" class="text-red-500 hover:text-red-700 pr-2">Eliminar</button>
              <button @click="completeTask(index, task.id)" class="text-blue-500 hover:text-blue-700">Marcar como completada</button>
            </td>
          </tr>
        </tbody>
      </table>
      <div>
        <button
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
          @click="createTask"
        >
          Crear Nueva Tarea
        </button>
      </div>
    </div>
  </template>
  
  <script>
  import service from "@/services/api";

  export default {
    data() {
      return {
        tasks: [
          { id: 1, nombre: 'Tarea 1', completada: false },
          { id: 2, nombre: 'Tarea 2', completada: true },
          { id: 3, nombre: 'Tarea 3', completada: false }
        ]
      };
    },
    mounted() {
      this.updateHeaders();
      this.fetchTasks();
    },
    methods: {
      fetchTasks() {
        service.interceptors.request.use(
              config => {
                config.headers['Authorization'] = `Bearer ${this.$store.state.token}`;
                    return config;
                },
                error => {
                    return Promise.reject(error);
                }
            );

        service
          .get('tasks').then((response) => {
            this.tasks = response.data.tasks;
          })
          .catch((error) => {
            console.error(error);
          });
      },
      deleteTask(taskId) {
        service.delete(`tasks/${taskId}`)
        .then(() => {
          this.fetchTasks();
        })
        .catch((error) => {
          console.error(error);
        });
    },
    completeTask(i, taskId) {
        this.tasks[i].completed = true;
        service.put(`tasks/${taskId}`, this.tasks[i])
        .then(() => {
          this.fetchTasks();
        })
        .catch((error) => {
          console.error(error);
        });
    },
    createTask() {
      this.$router.push('create-task');
    },
    updateHeaders() {
      service.interceptors.request.use(
        config => {
          config.headers['Authorization'] = `Bearer ${this.$store.state.token}`;
          return config;
        },
        error => {
          return Promise.reject(error);
        }
      );
    }
    }
  };
  </script>
  