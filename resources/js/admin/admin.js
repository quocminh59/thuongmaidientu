import Index from './Index.vue';
import router from './routes';
import VueRouter from 'vue-router';
import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import simplebar from 'simplebar-vue';
import 'simplebar/dist/simplebar.min.css';
import JwPagination from 'jw-vue-pagination';
import Notification from './plugin-components/Notification.vue'
import Breadcrumb from './plugin-components/Breadcrumb.vue'
import Spinner from './plugin-components/Spinner.vue'
import InputTag from './plugin-components/InputTag.vue'

Vue.use(VueRouter);
Vue.use(VueAxios, axios)

Vue.component('simplebar',simplebar);
Vue.component('jw-pagination', JwPagination);
Vue.component('notification', Notification);
Vue.component('breadcrumb', Breadcrumb);
Vue.component('spinner', Spinner);
Vue.component('input-tag', InputTag)



const app = new Vue({
    el: '#app',
    router,
    components: {
        'index' : Index,
    }
});

