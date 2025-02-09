<!-- resources/js/components/ClientCard.vue -->
<template>
    <div class="client-card">
      <h3>{{ client.name }}</h3>
      <p>{{ client.shortDescription }}</p>
      <router-link :to="`/client/${client.id}`" class="btn">View Details</router-link>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ClientCard',
    props: {
      client: {
        type: Object,
        required: true,
      },
    },
  };
  </script>
  