<template>
    <div>
      <!-- Item de tarea -->
      <h3>{{ task.title }}</h3>
      <p>{{ task.description }}</p>
      <!-- Botones para eliminar y marcar como completada -->
    </div>
  </template>
  
  <script>
  export default {
    name: 'TaskItem',
    props: {
      task: {
        type: Object,
        required: true
      }
    },
    methods: {
      deleteTask() {
        // Lógica para eliminar la tarea
      },
      completeTask() {
        // Lógica para marcar la tarea como completada
      }
    }
  }
  </script>
  