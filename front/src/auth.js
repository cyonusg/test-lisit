import { reactive } from 'vue';

const state = reactive({
  isAuthenticated: false,
});

const login = () => {
  state.isAuthenticated = true;
};

const logout = () => {
  state.isAuthenticated = false;
};

export { state, login, logout };
