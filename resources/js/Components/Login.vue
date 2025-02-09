<template>
    <div>
      <h2>Login</h2>
      <form @submit.prevent="login">
        <input type="email" v-model="email" placeholder="Email" required>
        <input type="password" v-model="password" placeholder="Password" required>
        <button type="submit">Login</button>
      </form>
      <p v-if="errorMessage" style="color: red;">{{ errorMessage }}</p>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'Login',
    data() {
      return {
        email: '',
        password: '',
        errorMessage: '',
      };
    },
    async mounted() {
      // Check for an existing token and verify its validity
      await this.checkExistingToken();
    },
    methods: {
      async checkExistingToken() {
        const token = localStorage.getItem('authToken');
        if (token) {
          // Set axios header with the existing token
          axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
          try {
            // Validate the token by attempting to fetch the authenticated user
            await axios.get('http://127.0.0.1:8000/api/user');
            // Token is valid; redirect to the dashboard (or home)
            this.$router.push('/');
          } catch (error) {
            // If token validation fails, remove the invalid token
            localStorage.removeItem('authToken');
            delete axios.defaults.headers.common['Authorization'];
            console.log('Stored token was invalid. Please log in.');
          }
        }
      },
      async login() {
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/login', {
            email: this.email,
            password: this.password,
          });
  
          // Store token in localStorage
          localStorage.setItem('authToken', response.data.token);
  
          // Set the default Authorization header for future requests
          axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
  
          alert('Login successful!');
          // Redirect user after successful login (to dashboard or home page)
          this.$router.push('/');
        } catch (error) {
          this.errorMessage =
            error.response?.data?.message || 'Login failed. Please try again.';
        }
      },
    },
  };
  </script>
  