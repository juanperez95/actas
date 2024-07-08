import { createApp } from 'vue';
import FormularioGestor from './components/FormularioGestor.vue';
import FormularioOperacion from './components/FormularioOperacion.vue';
import ModalGestor from './components/ModalGestor.vue';
import ModalCamp from './components/ModalCamp.vue';
import TablaAcciones from './components/TablaAcciones.vue';
import ModelComponentes from './components/ModelComponentes.vue';
import 'bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';


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
app.component('modal-camp', ModalCamp);
app.component('modal-componente', ModelComponentes);
app.component('tabla-acciones', TablaAcciones);



app.mount('#app');
