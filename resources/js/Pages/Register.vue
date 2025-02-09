<template>
    <div>
        <h2>Register</h2>
        <form @submit.prevent="register" class="filters">
            <input type="text" v-model="name" placeholder="Name" required>
            <input type="email" v-model="email" placeholder="Email" required>
            <input type="password" v-model="password" placeholder="Password" required>
            <input type="password" v-model="password_confirmation" placeholder="Confirm Password" required>
            
            <!-- Role Dropdown -->
            <select v-model="role" required>
                <option value="" disabled>Select a role</option>
                <option v-for="role in roles" :key="role.id" :value="role.name">
                    {{ role.name }}
                </option>
            </select>

            <button type="submit">Register</button>
        </form>
        <p v-if="errorMessage" style="color: red;">{{ errorMessage }}</p>
        <p v-if="successMessage" style="color: green;">{{ successMessage }}</p>

        <!-- Include the Users component -->
        <Users />
    </div>
</template>

<script>
import axios from 'axios';
import Users from '@/Components/Users.vue';

export default {
    components: {
      Users,
    },
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            role: '',
            roles: [],
            errorMessage: '',
            successMessage: ''
        };
    },
    methods: {
        async fetchRoles() {
            try {
                const response = await axios.get('/api/roles');
                this.roles = response.data;
            } catch (error) {
                this.errorMessage = 'Failed to fetch roles. Please try again.';
            }
        },
        async register() {
            try {
                const response = await axios.post('/api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                    role: this.role, // Include the selected role
                });

                // Store token in localStorage
                localStorage.setItem('authToken', response.data.token);

                // Success message
                this.successMessage = "Registration successful! Redirecting...";
                
                // Redirect user after successful registration
                setTimeout(() => {
                    this.$router.push('/');
                }, 2000);

            } catch (error) {
                this.errorMessage = error.response?.data?.message || 'Registration failed. Please try again.';
            }
        },
    },
    mounted() {
        this.fetchRoles();
    },
};
</script>