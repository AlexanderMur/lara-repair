require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import 'toastr'

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });

if (el.dataset.page.success_message) {
    toastr.success(el.dataset.page.success_message)
}
if (el.dataset.page.status) {
    if (el.dataset.page.status === 'profile-information-updated') {
        toastr.success('Профиль обновлен')
    }
}
if (el.dataset.page.error_message) {
    toastr.error(el.dataset.page.success_message)
}
if (el.dataset.page.info_message) {
    toastr.info(el.dataset.page.success_message)
}
