import { createRouter, createWebHistory } from 'vue-router';
import login from '../components/Auth/LoginUser.vue';
import register from '../components/Auth/RegisterUser.vue';
import createTask from '../components/Tasks/CreateTask.vue';
import listTasks from '../components/Tasks/TaskList.vue';
import store from "../store/index";
const routes = [
  {
    path: '/login',
    name: 'login',
    component: login 
  },
  {
    path: '/register',
    name: 'register',
    component: register
  },
  {
    path: '/create-task',
    name: 'createTask',
    component: createTask,
    meta: { requiresAuth: true },
  },
  {
    path: '/list-task',
    name: 'listTasks',
    component: listTasks,
    meta: { requiresAuth: true },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.isAuthenticated) {
    next('/login');
  } else {
    next();
  }
});

export default router;
