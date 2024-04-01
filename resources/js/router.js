import {createRouter, createWebHistory} from 'vue-router';
import RegistrationComponent from "./components/RegistrationComponent.vue";
import IndexComponent from "./components/IndexComponent.vue";




export default createRouter({
    history:createWebHistory(),

    routes:[
        {
            path:'/registration',
            component: RegistrationComponent,
            name: "registration",
        },
        {
            path:'/index',
            component: IndexComponent,
            name: "index",
        }
    ]

})
