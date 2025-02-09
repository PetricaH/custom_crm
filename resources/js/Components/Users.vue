<!-- resources/js/Components/UserTable.vue -->
<template>
    <div>
      <h2>All Users</h2>
      <table border="1" cellspacing="0" cellpadding="5">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>
              <!-- If using Spatie roles, adjust as necessary -->
              <span v-if="user.roles && user.roles.length">
                {{ user.roles[0].name }}
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: "Users",
    data() {
      return {
        users: []
      };
    },
    mounted() {
      this.fetchUsers();
    },
    methods: {
      async fetchUsers() {
        try {
          const response = await axios.get("http://127.0.0.1:8000/api/users");
          this.users = response.data;
        } catch (error) {
          console.error("Error fetching users:", error);
        }
      }
    }
  };
  </script>
  