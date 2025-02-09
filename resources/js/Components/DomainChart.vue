<template>
    <div class="chart-container">
      <h3>Invoiced Amount by Domain</h3>
      <div class="filters">
        <label>Start Date:</label>
        <input type="date" v-model="filters.startDate">
        
        <label>End Date:</label>
        <input type="date" v-model="filters.endDate">
        
        <label>Sales Agent:</label>
        <select v-model="filters.salesAgent">
          <option value="">All Sales Agents</option>
          <option v-for="agent in salesAgents" :key="agent.id" :value="agent.id">
            {{ agent.name }}
          </option>
        </select>
  
        <button @click="fetchDomainData">Apply Filters</button>
      </div>
      
      <canvas ref="domainChart"></canvas>
    </div>
  </template>
  
  <script>
  import Chart from "chart.js/auto";
  import axios from "axios";
  
  export default {
    data() {
      return {
        domainData: [],
        salesAgents: [],
        filters: {
          startDate: "",
          endDate: "",
          salesAgent: ""
        },
        chartInstance: null
      };
    },
    mounted() {
      this.fetchSalesAgents();
      this.fetchDomainData();
    },
    methods: {
      async fetchDomainData() {
        try {
          const params = {};
          if (this.filters.startDate) params.start_date = this.filters.startDate;
          if (this.filters.endDate) params.end_date = this.filters.endDate;
          if (this.filters.salesAgent) params.sales_agent = this.filters.salesAgent;
  
          const response = await axios.get("http://127.0.0.1:8000/api/domain-invoices", { params });
          this.domainData = response.data;
          this.renderChart();
        } catch (error) {
          console.error("Error fetching domain invoice data", error);
        }
      },
      async fetchSalesAgents() {
        try {
          const response = await axios.get("http://127.0.0.1:8000/api/sales-agents");
          this.salesAgents = response.data;
        } catch (error) {
          console.error("Error fetching sales agents", error);
        }
      },
      renderChart() {
        if (this.chartInstance) {
          this.chartInstance.destroy();
        }
  
        const ctx = this.$refs.domainChart.getContext("2d");
        this.chartInstance = new Chart(ctx, {
          type: "bar",
          data: {
            labels: this.domainData.map(item => item.domain),
            datasets: [
              {
                label: "Invoiced Amount (€)",
                data: this.domainData.map(item => item.amount),
                backgroundColor: "blue"
              }
            ]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { display: true }
            }
          }
        });
      }
    },
    watch: {
      domainData: "renderChart"
    }
  };
  </script>
  
    