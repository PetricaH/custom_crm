<template>
    <div>
      <h3>Monthly Invoices</h3>
      <canvas ref="invoiceChart"></canvas>
    </div>
  </template>
  
  <script>
  import Chart from "chart.js/auto";
  
  export default {
    props: {
      data: {
        type: Array,
        default: () => [] // Ensure default value is an array
      }
    },
    watch: {
      data(newData) {
        if (Array.isArray(newData) && newData.length > 0) {
          this.renderChart();
        }
      }
    },
    methods: {
      renderChart() {
        if (!Array.isArray(this.data) || this.data.length === 0) {
          console.warn("No data available for Invoice Chart");
          return;
        }
  
        const ctx = this.$refs.invoiceChart.getContext("2d");
  
        // Destroy the old chart if it exists
        if (this.chartInstance) {
          this.chartInstance.destroy();
        }
  
        this.chartInstance = new Chart(ctx, {
          type: "bar",
          data: {
            labels: this.data.map(item => item.month || "Unknown"),
            datasets: [
              {
                label: "Paid Invoices",
                data: this.data.map(item => item.paid || 0),
                backgroundColor: "green"
              },
              {
                label: "Unpaid Invoices",
                data: this.data.map(item => item.unpaid || 0),
                backgroundColor: "red"
              }
            ]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false
          }
        });
      }
    }
  };
  </script>
  