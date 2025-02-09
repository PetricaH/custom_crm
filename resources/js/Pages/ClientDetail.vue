<!-- resources/js/views/ClientDetail.vue -->
<template>
  <div class="client-detail">
    <h2>Client Details</h2>
    <div v-if="loading" class="loading">Loading client information…</div>
    <div v-else-if="error" class="error">{{ error }}</div>
    <div v-else>
      <p><strong>Name:</strong> {{ client.name }}</p>
      <p v-if="client.contact_info && client.contact_info.email">
        <strong>Email:</strong> {{ client.contact_info.email }}
      </p>
      <p><strong>Additional Details:</strong> {{ client.additional_details }}</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';

export default {
  name: 'ClientDetail',
  setup() {
    const route = useRoute();
    const client = ref({});
    const loading = ref(true);
    const error = ref(null);
    const clientId = route.params.id;

    onMounted(async () => {
      try {
        const { data } = await axios.get(`/api/clients/${clientId}`);
        client.value = data;
      } catch (err) {
        error.value = 'Failed to load client details.';
        console.error(err);
      } finally {
        loading.value = false;
      }
    });

    return { client, loading, error };
  },
};
</script>


