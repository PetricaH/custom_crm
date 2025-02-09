<template>
  <div class="dashboard">
    <h2>Stats Overview</h2>

    <div class="card-grid">
      <div class="card">
        <h3>Total Clients</h3>
        <p>{{ totalClients }}</p>
      </div>

      <div class="card">
        <h3>Total Sales</h3>
        <p>€{{ totalSales }}</p>
      </div>

      <div class="card">
        <h3>Pending Invoices</h3>
        <p>{{ pendingInvoices }}</p>
      </div>

      <div class="card">
        <h3>Completed Transactions</h3>
        <p>{{ completedTransactions }}</p>
      </div>

      <div class="card">
        <h3>Interactions</h3>
        <p>{{ totalInteractions }}</p>
      </div>

      <div class="card">
        <h3>Total Revenue</h3>
        <p>€{{ totalRevenue }}</p>
      </div>

      <div class="card">
        <h3>Avg. Sales Cycle Duration</h3>
        <p>{{ averageSalesCycle }} days</p>
      </div>

      <div class="card">
        <h3>Sales by Agent</h3>
        <ul>
          <li v-for="agent in salesByAgent" :key="agent.id">
            {{ agent.name }}: €{{ agent.sales }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      totalClients: 0,
      totalSales: 0,
      pendingInvoices: 0,
      completedTransactions: 0,
      totalInteractions: 0,
      totalRevenue: 0,
      averageSalesCycle: 0,
      salesByAgent: []
    };
  },
  mounted() {
    this.loadDashboardCSS();
    this.fetchSummaryData();
  },
  beforeUnmount() {
    this.removeDashboardCSS();
  },
  methods: {
    async fetchSummaryData() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/dashboard-summary");
        const data = response.data;

        this.totalClients = data.totalClients;
        this.totalSales = data.totalSales;
        this.pendingInvoices = data.pendingInvoices;
        this.completedTransactions = data.completedTransactions;
        this.totalInteractions = data.totalInteractions;
        this.totalRevenue = data.totalRevenue;
        this.averageSalesCycle = data.averageSalesCycle;
        this.salesByAgent = data.salesByAgent;
      } catch (error) {
        console.error("Error fetching summary data:", error);
      }
    },
    loadDashboardCSS() {
      if (!document.getElementById("dashboard-css")) {
        const link = document.createElement("link");
        link.rel = "stylesheet";
        link.href = "/css/dashboard.css";
        link.id = "dashboard-css";
        document.head.appendChild(link);
      }
    },
    removeDashboardCSS() {
      const link = document.getElementById("dashboard-css");
      if (link) {
        document.head.removeChild(link);
      }
    }
  }
};
</script>


