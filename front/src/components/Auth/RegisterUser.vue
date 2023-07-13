<template>
    <div class="flex items-center justify-center h-screen">
      <div class="w-full max-w-md">
        <h2 class="text-3xl mb-4">Registro de usuario</h2>
        <form @submit.prevent="register" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
          <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
            <input v-model="name" type="text" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
          </div>
          <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo electrónico</label>
            <input v-model="email" type="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
          </div>
          <div class="mb-6">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
            <input v-model="password" type="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
          </div>
          <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Registrarse</button>
          </div>
        </form>
        <p v-if="error"> {{ this.error }}</p>
        <p class="text-center text-gray-500 text-xs">&copy; 2023 Nombre de la empresa. Todos los derechos reservados.</p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        error: '',
      };
    },
    methods: {
      register() {
        this.error = ''
        const userData = {
          name: this.name,
          email: this.email,
          password: this.password
        };

        service.interceptors.request.use(
          config => {
            config.headers['Authorization'] = `Bearer ${this.$store.state.token}`
                return config;
            },
            error => {
                return Promise.reject(error)
            }
        );
          service
            .post('register', userData)
            .then(() => {
              this.$router.push('/list-task')
            })
            .catch((error) => {
              this.error = error.response.data.message
            })
      }
    }
  };
  </script>
  