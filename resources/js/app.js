
require('./bootstrap');

window.Vue = require('vue');
import router from  './Routes';

new Vue({
    el: '#app',
    router,
});
