<template>
    <div>
      <h2>Add New Client</h2>
      <form @submit.prevent="submitClient">
        <div>
          <label>Person of Contact Name:</label>
          <input type="text" v-model="form.person_of_contact_name" placeholder="Enter contact name" />
        </div>
        <div>
          <label>Business Name:</label>
          <input type="text" v-model="form.business_name" placeholder="Enter business name" />
        </div>
        <div>
          <label>Business Phone:</label>
          <input type="text" v-model="form.business_phone" placeholder="Enter business phone" />
        </div>
        <div>
          <label>Person of Contact Phone:</label>
          <input type="text" v-model="form.person_of_contact_phone" placeholder="Enter contact phone" />
        </div>
        <div>
          <label>Additional Details:</label>
          <textarea v-model="form.additional_details" placeholder="Any additional details"></textarea>
        </div>
        <button type="submit">Add Client</button>
      </form>
      <p v-if="error" class="error">{{ error }}</p>
      <p v-if="success" class="success">{{ success }}</p>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        form: {
          person_of_contact_name: '',
          business_name: '',
          business_phone: '',
          person_of_contact_phone: '',
          additional_details: '',
        },
        error: '',
        success: ''
      }
    },
    methods: {
      async submitClient() {
        this.error = '';
        this.success = '';
        try {
          const response = await axios.post('/api/clients', this.form, {
            headers: {
              'Content-Type': 'application/json',
              // If authentication is required, include the token:
              Authorization: `Bearer ${localStorage.getItem('authToken')}`
            }
          });
          this.success = 'Client created successfully!';
          // Optionally, clear the form:
          this.form = {
            person_of_contact_name: '',
            business_name: '',
            business_phone: '',
            person_of_contact_phone: '',
            additional_details: ''
          };
        } catch (err) {
          this.error = err.response?.data?.message || 'Error creating client.';
        }
      }
    }
  }
  </script>
  