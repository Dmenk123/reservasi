import Vue from 'vue';
import 'mdb-vue-ui-kit/css/mdb.min.css';
// import App from './components/App.vue'

 
// new Vue({
//   el: '#app',
//   components: { 
//       App
//   }
// });



import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './components/App'
import Home from './components/Home'
import Login from './components/Login'
import Register from './components/Register'

const router = new VueRouter({
  mode: 'history',
  routes: [
    { path: '/', name: 'home', component: Home },
    { path: '/login', name: 'login',  component: Login },
    { path: '/register', name: 'register', component: Register },
  ],
})

new Vue({
  el: '#app',
  components: { App },
  router,
});