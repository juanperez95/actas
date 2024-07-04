import { createApp } from 'vue';
import FormularioGestor from './components/FormularioGestor.vue';
import FormularioOperacion from './components/FormularioOperacion.vue';
import ModalGestor from './components/ModalGestor.vue';
import 'bootstrap';

const app = createApp({
    data(){
        return {
            seleccion_operacion : 0,
        }
    }
});

app.component('form-gestor', FormularioGestor);
app.component('form-operacion', FormularioOperacion);
// Modales para gestores y campañas
app.component('modal-gestor', ModalGestor);

app.mount('#app');
