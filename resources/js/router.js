import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from '/resources/js/Pages/Dashboard.vue';
import Login from './components/Login.vue';
import Register from './Pages/Register.vue';
import ClientDetail from '/resources/js/Pages/ClientDetail.vue';
import NotFound from '/resources/js/Pages/NotFound.vue';
import Clients from '/resources/js/Pages/Clients.vue';
import DashboardComponent from '/resources/js/Components/DashboardComponent.vue';
import SalesAgentCards from './Pages/SalesAgentCards.vue';


const routes = [
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    {
        path: '/',
        name: 'Dashboard',
        component: Dashboard,
        meta: { title: 'Dashboard', requiresAuth: true},
      },
      { path: '/dashboard-details', 
        component: DashboardComponent, requiresAuth: true },
      {
        path: '/client/:id',
        name: 'ClientDetail',
        component: ClientDetail,
        meta: { title: 'Client Detail', requiresAuth: true },
      },
      {
        path: '/clients',
        name: 'Clients',
        component: Clients,
        meta: { title: 'Clients', requiresAuth: true},
      },
      {
        path: '/sales-agents',
        name: 'Sales Agents',
        component: SalesAgentCards,
        meta: { title: 'Sales Agents', requiresAuth: true },
      },
      {
        path: '/:catchAll(.*)',
        name: 'NotFound',
        component: NotFound,
        meta: { title: '404 - Not Found' },
      },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem('authToken');
    if (to.meta.requiresAuth && !isAuthenticated) {
        next('/login');
    } else {
        next();
    }
});

router.afterEach((to) => {
  document.title = to.meta.title || 'My CRM Application';
});

export default router;