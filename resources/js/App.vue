<!-- resources/js/App.vue -->
<template>
    <div id="app">
      <Header />
      <Navigation />
      <main>
        <router-view />
      </main>
      <Footer />
    </div>
  </template>
  
  <script>
  import Header from '/resources/js/Layouts/Header.vue';
  import Navigation from '/resources/js/Layouts/Navigation.vue';
  import Footer from '/resources/js/Layouts/Footer.vue';
  
  export default {
    name: 'App',
    components: { Header, Navigation, Footer },
  };
  </script>
  
  <style scoped>
  /* Global layout styles */
  #app {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  main {
    flex: 1;
    padding: 20px;
  }
  </style>
  