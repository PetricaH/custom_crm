<!-- resources/js/Components/SalesAgentCards.vue -->
<template>
    <div>
      <h2>Sales Agents Dashboard</h2>
      <div class="cards-container">
        <div v-for="agent in salesAgents" :key="agent.id" class="card">
          <h3>{{ agent.name }}</h3>
          <p>Email: {{ agent.email }}</p>
          <p>Total Invoices: {{ agent.total_invoices }}</p>
          <p>Total Invoice Amount: €{{ agent.total_invoice_amount }}</p>
          <p>Total Sales: €{{ agent.total_sales }}</p>
          <p>Average Sales Cycle (days): {{ agent.avg_sales_cycle ? agent.avg_sales_cycle.toFixed(1) : 'N/A' }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "SalesAgentCards",
    data() {
      return {
        salesAgents: []
      };
    },
    mounted() {
      this.fetchSalesAgentStats();
    },
    methods: {
      async fetchSalesAgentStats() {
        try {
          const response = await axios.get("/api/sales-agents-stats");
          this.salesAgents = response.data;
        } catch (error) {
          console.error("Error fetching sales agents statistics:", error);
        }
      }
    }
  };
  </script>
  
  <style scoped>

  .cards-container {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
  }
  
  .card {
    flex: 1 1 300px;
    border-radius: 20px;
    padding: 1rem;
    background-color: var(--cards-backround-color);
  }
  </style>
  