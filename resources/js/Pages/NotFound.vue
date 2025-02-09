<!-- resources/js/views/NotFound.vue -->
<template>
    <div class="not-found">
      <h1>404 - Not Found</h1>
      <p>The page you requested does not exist.</p>
      <router-link to="/" class="btn">Return to Dashboard</router-link>
    </div>
  </template>
  
  <script>
  export default {
    name: 'NotFound',
  };
  </script>
  
  <style scoped>
  .not-found {
    text-align: center;
    padding: 50px;
  }
  .btn {
    display: inline-block;
    padding: 8px 12px;
    background-color: #007bff;
    color: #fff;
    border-radius: 4px;
    text-decoration: none;
  }
  .btn:hover {
    opacity: 0.9;
  }
  </style>
  