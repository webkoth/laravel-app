window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue').default;

import store from './store';

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('article-component', require('./components/ArticleComponent.vue').default);
Vue.component('views-component', require('./components/ViewsComponent.vue').default);
Vue.component('likes-component', require('./components/LikesComponent.vue').default);
Vue.component('comments-component', require('./components/CommentsComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    store,
    el: '#app',
    created() {
        let url = window.location.pathname;
        let slug = url.substring(url.lastIndexOf('/')+1);

        console.log(url);
        console.log(slug);

        this.$store.commit('SET_SLUG', slug);
        this.$store.dispatch('article/getArticleData', slug);
        this.$store.dispatch('article/viewsIncrement', slug);
    }
});
