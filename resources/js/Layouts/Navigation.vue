<template>
  <nav class="site-nav">
    <div class="nav-container">
      <!-- Logo -->
      <div class="logo">CRM</div>

      <!-- Navigation Links -->
      <div class="nav-links" :class="{ 'nav-active': isMobileMenuOpen }">
        <router-link to="/" class="nav-link" @click="closeMenu">Dashboard</router-link>
        <router-link to="/sales-agents" class="nav-link" @click="closeMenu">Sales Agents</router-link>
        <router-link to="/clients" class="nav-link" @click="closeMenu">Clients</router-link>
        <router-link to="/dashboard-details" class="nav-link" @click="closeMenu">Detailed Dashboard</router-link>
        <router-link to="/register" class="nav-link" @click="closeMenu">Add New User</router-link>
        <router-link to="/login" class="nav-link" @click="closeMenu">Login</router-link>
      </div>

      <!-- Mobile Menu Button -->
      <div class="menu-toggle" @click="toggleMobileMenu">
        <span class="bar" :class="{ 'open': isMobileMenuOpen }"></span>
        <span class="bar" :class="{ 'open': isMobileMenuOpen }"></span>
        <span class="bar" :class="{ 'open': isMobileMenuOpen }"></span>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Navigation",
  data() {
    return {
      isMobileMenuOpen: false
    };
  },
  methods: {
    toggleMobileMenu() {
      this.isMobileMenuOpen = !this.isMobileMenuOpen;
    },
    closeMenu() {
      this.isMobileMenuOpen = false;
    }
  }
};
</script>

<style scoped>
/* Prevent horizontal scrolling */
html, body {
  overflow-x: hidden;
}

/* Modern Navbar Styling */
.site-nav {
  background: var(--cards-backround-color);
  color: white;
  padding: 15px 0;  /* Removed side padding */
  width: 100%;
  position: sticky;
  top: 0;
  z-index: 1000;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  box-sizing: border-box;
}

/* Navbar container */
.nav-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px; /* Padding inside container */
  width: 100%;
  box-sizing: border-box;
}

/* Logo */
.logo {
  font-size: 1.5rem;
  font-weight: bold;
  letter-spacing: 1px;
}

/* Navigation Links */
.nav-links {
  display: flex;
  gap: 20px;
}

.nav-link {
  color: white;
  text-decoration: none;
  font-size: 1rem;
  font-weight: 500;
  padding: 10px 15px;
  border-radius: 5px;
  transition: all 0.3s ease-in-out;
}

.nav-link:hover {
  background: rgba(255, 255, 255, 0.2);
}

/* Mobile Menu */
.menu-toggle {
  display: none;
  flex-direction: column;
  cursor: pointer;
}

.bar {
  background: white;
  height: 3px;
  width: 25px;
  margin: 5px 0;
  transition: all 0.3s ease-in-out;
}

/* Open State for Bars */
.open:nth-child(1) {
  transform: translateY(8px) rotate(45deg);
}
.open:nth-child(2) {
  opacity: 0;
}
.open:nth-child(3) {
  transform: translateY(-8px) rotate(-45deg);
}

/* Responsive for Mobile */
@media (max-width: 768px) {
  .menu-toggle {
    display: flex;
  }

  .nav-links {
    position: absolute;
    top: 60px;
    left: 0;
    width: 100%;
    background: #1e1e2f;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    padding: 15px 0;
    transform: translateY(-100%);
    transition: all 0.3s ease-in-out;
  }

  .nav-active {
    transform: translateY(0);
  }
}
</style>
