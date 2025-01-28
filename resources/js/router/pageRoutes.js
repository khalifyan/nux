import MainPage from "../pages/MainPage.vue";
import LuckyPage from "../pages/LuckyPage.vue";

export const pageRoutes = [
    {
        path: '/',
        name: 'main',
        component: MainPage
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'lucky',
        component: LuckyPage
    }
]
