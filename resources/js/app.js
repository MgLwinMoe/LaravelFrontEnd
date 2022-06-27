require('./bootstrap');
// window.Vue = require('vue').default;

import Vue from 'vue'
import common from './common'

Vue.mixin(common)
import search from './components/search.vue'
import comment from './components/comment.vue'
import writecomment from './components/writecomment.vue'


const app = new Vue({
    el: '#app',
    components: {
        search,
        comment,
        writecomment
    }
                // comment
})
