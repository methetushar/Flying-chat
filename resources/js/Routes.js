import Vue from  'vue'
import VueRouter from 'vue-router'

import LoginComponent from "./components/LoginComponent";
import HomeComponent from "./components/HomeComponent";
import RegisterComponent from "./components/RegisterComponent";
Vue.use(VueRouter);

const routes = [
        { path: '/', component:HomeComponent,name: 'HomeComponent'},
        { path: '/login',component: LoginComponent,name: 'LoginComponent'},
        { path: '/register',component: RegisterComponent,name: 'RegisterComponent'}

];
export  default new VueRouter(
        {
            routes,
            mode:'history',
            base: __dirname,
        }
)
