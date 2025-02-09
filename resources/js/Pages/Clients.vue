<!-- resources/js/components/ClientsTable.vue -->
<template>
    <div class="clients-table">
      <h2>Clients</h2>
      
      <!-- Filters -->
      <div class="filters">
        <input
          v-model="filters.client_code"
          type="text"
          placeholder="Filter by client code"
        />
        <select v-model="filters.salesAgent">
          <option value="" disabled>All Sales Agents</option>
          <option v-for="agent in salesAgents" :key="agent.id" :value="agent.id">
            {{ agent.name }}
          </option>
        </select>
        <button class="button" @click="fetchClients">Apply Filters</button>
      </div>
  
      <!-- Clients Table -->
      <table>
        <thead>
          <tr>
            <th>Client Code</th>
            <th>Business Name</th>
            <th>Contact Name</th>
            <th>Phone Number</th>
            <th>Added By</th>
            <th>Added At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="client in clients" :key="client.id">
            <td>{{ client.client_code }}</td>
            <td>{{ client.name }}</td>
            <td>
              <select v-model="client.salesperson_id" @change="updateSalesAgents(client)">
                <option value="">Unassigned</option>
                <option v-for="person in salespersons" :key="person.id" :value="person.id">
                  {{ person.name }}
                </option>
              </select>
            </td>
            <td>
              <!-- You can add additional action buttons here -->
              <button @click="editClient(client)" class="edit-button">Edit</button>
              <button @click="deleteClient(client)" class="bad-button">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
      
      <p v-if="error" class="error">{{ error }}</p>
      <p v-if="success" class="success">{{ success }}</p>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'ClientsTable',
    data() {
      return {
        clients: [],
        salesAgents: [],
        filters: {
          salesAgent: '',
          client_code: '',
          salesperson_id: '',
        },
        error: '',
        success: ''
      }
    },
    mounted() {
      this.loadClientsCSS();
      this.fetchClients();
      this.fetchSalesAgents();
    },
    beforeUnmount() {
      this.removeClientsCSS();
    },
    methods: {
      async fetchClients() {
        this.error = '';
        try {
          // Build query parameters based on filters
          let params = {};
          if (this.filters.client_code) {
            params.client_code = this.filters.client_code;
          }
          if (this.filters.salesperson_id) {
            params.salesperson_id = this.filters.salesperson_id;
          }
          const response = await axios.get('/api/clients', { params });
          this.clients = Array.isArray(response.data) ? response.data : [];
        } catch (err) {
          this.error = err.response?.data?.message || 'Error fetching clients.';
        }
      },
      async fetchSalesAgents() {
        try {
          const response = await axios.get("/api/sales-agents");
          this.salesAgents = response.data;
        } catch (error) {
          console.error("Error fetching sales agents", error);
        }
      },
      editClient(client) {
        // Implement additional edit functionality if needed
        console.log('Editing client:', client);
      },
      loadClientsCSS() {
        if (!document.getElementById("clients-table-css")) {
          const link = document.createElement("link");
          link.rel = "stylesheet";
          link.href = "/css/clients.css";
          link.id = "clients-table-css";
          document.head.appendChild(link);
        }
      },
      removeClientsCSS() {
        const link = document.getElementById("clients-table-css");
        if (link) {
          document.head.removeChild(link);
        }
      }
    }
  };
  </script>