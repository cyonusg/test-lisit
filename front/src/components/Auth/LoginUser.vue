<template>
  <div class="flex items-center justify-center h-screen">
    <div class="w-full max-w-md">
      <h2 class="text-3xl mb-4">Inicio de sesión</h2>
      <form @submit.prevent="login" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
          <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo electrónico</label>
          <input v-model="email" type="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        </div>
        <div class="mb-6">
          <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
          <input v-model="password" type="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        </div>
        <div class="flex items-center justify-between">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Iniciar sesión</button>
          <a href="#" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">¿Olvidaste tu contraseña?</a>
        </div>
      </form>
      <p class="text-center text-gray-500 text-xs">&copy; 2023 Nombre de la empresa. Todos los derechos reservados.</p>
    </div>
  </div>
</template>

<script>
import service from "@/services/api";


export default {
  data() {
    return {
      email: '',
      password: '',
      error: '',
    };
  },
  methods: {
    async login() {
      try {
        const response = await service.post('login', {
          email: this.email,
          password: this.password,
        });
        const token = response.data.access_token;
        this.$store.commit('setToken', token);
        this.$store.commit('setAuthenticated', true);
        this.$router.push('/list-task');
      } catch (error) {
        if (error.response) {
          this.error = error.response.data.message;
        } else if (error.request) {
          console.error(error.request);
        } else {
          console.error('Error', error.message);
        }
      }
    },
  },
};

</script>
