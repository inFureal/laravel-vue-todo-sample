require('./bootstrap');
import Vue from 'vue'
import Root from './Root'

document.addEventListener('DOMContentLoaded', () => {

    if (document.getElementById('app'))
        window.Vue = new Vue({
            el: '#app',
            render: (el) => el(Root)
        })

})