<template>
  <div class="detailed-dashboard">
    <h2>Detailed Dashboard</h2>

    <!-- Button Group for Views -->
    <div class="button-group">
      <button @click="setView('invoices')" :class="{ active: currentView === 'invoices' }">Invoices</button>
      <button @click="setView('salesTable')" :class="{ active: currentView === 'salesTable' }">Sales Data</button>
      <button @click="setView('domains')" :class="{ active: currentView === 'domains' }">Domains</button>
    </div>

    <!-- Dynamic Content Container -->
    <div class="content-container">
      <div v-if="currentView === 'invoices'">
        <InvoiceChart :data="invoiceData" />
      </div>
      <div v-if="currentView === 'salesTable'">
        <SalesTable :salesData="salesData" />
      </div>
      <div v-if="currentView === 'domains'">
        <DomainChart :data="domainData" />
      </div>
    </div>
  </div>
</template>

<script>
import InvoiceChart from './InvoiceChart.vue';
import SalesTable from './SalesTable.vue';
import DomainChart from './DomainChart.vue';
import axios from 'axios';

export default {
  name: "DashboardComponent",
  components: { InvoiceChart, SalesTable, DomainChart },
  data() {
    return {
      currentView: 'invoices',
      invoiceData: [],
      salesData: [],
      domainData: []
    };
  },
  mounted() {
    this.loadDetailedDashboardCSS();
    this.fetchInvoiceData();
  },
  beforeUnmount() {
    this.removeDetailedDashboardCSS();
  },
  methods: {
    async fetchInvoiceData() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/invoices-per-month');
        this.invoiceData = response.data;
      } catch (error) {
        console.error("Error fetching invoice data", error);
      }
    },
    async fetchSalesData() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/sales-data');
        this.salesData = response.data;
      } catch (error) {
        console.error("Error fetching sales data", error);
      }
    },
    async fetchDomainData() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/domain-invoices');
        this.domainData = response.data;
      } catch (error) {
        console.error("Error fetching domain data", error);
      }
    },
    setView(view) {
      this.currentView = view;
      if (view === 'salesTable' && this.salesData.length === 0) {
        this.fetchSalesData();
      }
      if (view === 'domains' && this.domainData.length === 0) {
        this.fetchDomainData();
      }
    },
    loadDetailedDashboardCSS() {
      if (!document.getElementById("detailed-dashboard-css")) {
        const link = document.createElement("link");
        link.rel = "stylesheet";
        link.href = "/css/detailed_dashboard.css";
        link.id = "detailed-dashboard-css";
        document.head.appendChild(link);
      }
    },
    removeDetailedDashboardCSS() {
      const link = document.getElementById("detailed-dashboard-css");
      if (link) {
        document.head.removeChild(link);
      }
    }
  }
};
</script>