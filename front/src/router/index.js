import {createRouter, createWebHistory} from 'vue-router';
import Categories from '../view/CategoryView.vue';
import Events from '../view/EventView.vue';
import MyEvent from '../view/MyEventView.vue';
import SignIn from '../authentication/SignIn.vue';
import SignUp from '../authentication/SignUp.vue';
const routes = [
    {
        path: '/myEvents',
        name: 'MyEvent',
        component: MyEvent
    },
    {
        path: '/category',
        name: 'Category',
        component: Categories
    },
    {
        path: '/events',
        name: 'Events',
        component: Events
    },
    {
        path: '/signIn',
        name: 'SignIn',
        component: SignIn
    },
    {
        path: '/',
        name: 'SignIn',
        component: SignIn
    },
    {
        path: '/signUp',
        name: 'SignUp',
        component: SignUp
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
});
export default router