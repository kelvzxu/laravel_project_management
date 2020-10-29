require('./bootstrap');

import Vue from 'vue';
import Vuetify from 'vuetify';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';

Vue.mixin({ methods: { route } });
Vue.use(Vuetify);
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);

const opts = {}
const app = document.getElementById('app');

export default new Vuetify(opts)

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
