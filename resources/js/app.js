require('./bootstrap')

import Vue from 'vue'

import { InertiaApp } from '@inertiajs/inertia-vue'
import { InertiaForm } from 'laravel-jetstream'
import PortalVue from 'portal-vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.mixin({ methods: { route } })
Vue.use(InertiaApp)
Vue.use(InertiaForm)
Vue.use(PortalVue)
Vue.use(Vuetify)

var moment = require('moment')
moment.locale('es')

const app = document.getElementById('app')

new Vue({
    moment: moment,
    vuetify: new Vuetify({
        theme: {
            themes: {
                light: {
                    primary: '#263238',
                    secondary: '#3AC2B4',
                    accent: '#00C2AE',
                    error: '#B00020',
                    info: '#2196F3',
                    success: '#4CAF50',
                    warning: '#FFC107',
                },
            },
        },
    }),
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app)
