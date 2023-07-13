<template>
    <div class="p-4">
      <h2 class="text-3xl mb-4">Crear Tarea</h2>
      <form @submit.prevent="createTask" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
          <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre de la tarea</label>
          <input v-model="task.title" type="text" id="nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        </div>
        <div class="mb-4">
          <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Descripción de la tarea</label>
          <input v-model="task.description" type="text" id="nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        </div>
        <p v-if="error != ''"> {{ error }}</p>
        <div class="flex items-center justify-end">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Crear</button>
        </div>
      </form>
    </div>
  </template>
  
<script>
  import service from "@/services/api";

    export default {
      data() {
        return {
          task: {
            title: '',
            description: '',
            completed: false,
          },
          error: '',
        };
      },
      methods: {
        createTask() {
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
            .post('tasks', this.task)
            .then(() => {
              this.$router.push('/list-task')
            })
            .catch((error) => {
              this.error = error.response.data.message;
            });
        },
      },
    };
  </script>
  