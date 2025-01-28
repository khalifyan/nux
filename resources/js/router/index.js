import {createRouter, createWebHistory} from 'vue-router';
import {pageRoutes} from "./pageRoutes.js";

const routerHistory = createWebHistory()
const router = createRouter({
    history: routerHistory,
    routes: [
        ...pageRoutes,
    ]
})

export default router
