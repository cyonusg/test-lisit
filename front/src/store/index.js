import { createStore } from 'vuex';

const store = createStore({
  state: {
    token: null,
    isAuthenticated: false,
  },
  mutations: {
    setToken(state, token) {
      state.token = token;
    },
    setAuthenticated(state, isAuthenticated) {
      state.isAuthenticated = isAuthenticated;
    },
    setRole(state, role) {
      state.role = role;
    },
  },
  actions: {},
  getters: {},
});

export default store;



