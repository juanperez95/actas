import { createApp } from 'vue';
import FormularioGestor from './components/FormularioGestor.vue';
import FormularioOperacion from './components/FormularioOperacion.vue';

const app = createApp({
    data(){
        return {
            seleccion_operacion : 0,

        }
    }
});

app.component('form-gestor', FormularioGestor);
app.component('form-operacion', FormularioOperacion);

app.mount('#app');
