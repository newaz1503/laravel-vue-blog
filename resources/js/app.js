require('./bootstrap');
import { createApp } from 'vue';
const app = createApp({});
//vue-router
import routes from './routes';
import { createRouter, createWebHashHistory } from 'vue-router';

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});
app.use(router);

//v-form
import Form from 'vform';
window.Form = Form;
const form = new Form({});
const errors = form.errors;
import {
    Button,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess
} from 'vform/src/components/bootstrap5';
app.component(Button.name, Button);
app.component(HasError.name, HasError);
app.component(AlertError.name, AlertError);
app.component(AlertErrors.name, AlertErrors);
app.component(AlertSuccess.name, AlertSuccess);

//sweet alert 2
import Swal from 'sweetalert2';
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.Toast = Toast;

//vue-x
import { createStore } from 'vuex';
import storeData from './store';

const store = createStore(
    storeData
);
app.use(store);

// moment
import moment from 'moment';
app.use(moment);

//markdown editor
import 'v-markdown-editor/dist/v-markdown-editor.css';
import Editor from 'v-markdown-editor'

// global register
app.use(Editor);

app.mount('#app');
