<template>
    <div>
      <h3>Sales Data</h3>
  
      <!-- Filters -->
      <div class="filters">
        <select v-model="filters.clientStatus">
          <option value="">Select Client Status</option>
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
  
        <select v-model="filters.employees">
          <option value="">Select Employees</option>
          <option value="small">1-10</option>
          <option value="medium">11-50</option>
          <option value="large">51+</option>
        </select>
  
        <select v-model="filters.domain">
          <option value="">Select Domain</option>
          <option value="IT">IT</option>
          <option value="Finance">Finance</option>
        </select>
  
        <input type="date" v-model="filters.startDate">
        <input type="date" v-model="filters.endDate">
  
        <button @click="applyFilters">Apply Filters</button>
      </div>
  
      <!-- Sales Table -->
      <table v-if="filteredSales.length">
        <thead>
          <tr>
            <th>Vanzator</th>
            <th>Interactiuni</th>
            <th>Ciclu Vanzare</th>
            <th>Facturat</th>
            <th>Clienti Contactati</th>
            <th>Nr. Vanzari</th>
            <th>Evolutie</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="sale in filteredSales" :key="sale.id">
            <td>{{ sale.vanzator }}</td>
            <td>{{ sale.interactiuni }}</td>
            <td>{{ sale.ciclu_vanzare }}</td>
            <td>{{ sale.facturat }}</td>
            <td>{{ sale.clienti_contactati }}</td>
            <td>{{ sale.nr_vanzari }}</td>
            <td>{{ sale.evolutie }}</td>
          </tr>
        </tbody>
      </table>
      <p v-else>No sales data available.</p>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      salesData: {
        type: Array,
        default: () => [] // ✅ Ensure default value is an array
      }
    },
    data() {
      return {
        filters: {
          clientStatus: "",
          employees: "",
          domain: "",
          startDate: "",
          endDate: ""
        }
      };
    },
    computed: {
      filteredSales() {
        if (!Array.isArray(this.salesData)) {
          console.warn("Sales Data is not an array:", this.salesData);
          return [];
        }
  
        return this.salesData.filter(sale => {
          return (!this.filters.clientStatus || sale.client_status === this.filters.clientStatus);
        });
      }
    },
    methods: {
      applyFilters() {
        console.log("Filters applied:", this.filters);
      }
    }
  };
  </script>
  