
require('./bootstrap');

window.Vue = require('vue');


import '../sass/app.scss';
import App from './components/App'


const app = new Vue({
    el: '#app',
    render: h => h(App),
    components: {App}
});
