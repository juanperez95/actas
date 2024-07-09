import Vuex from 'vuex';
import axios from 'axios';

const store = new Vuex.Store({
    state:{
        componentes_vuex:[],
        lista_gestores:['a'],
    },
    mutations:{
        // Mostrar componentes de manera global
        mostrarComponentes(state){
            axios.get('/Actas_de_responsabilidad/Componentes')
            .then(respuesta=>{
                state.componentes_vuex = respuesta.data;
            })
            .catch(error=>{
                console.log(error);
            });
        },
        // Mostrar gestores de manera global
        mostrarGestores(state){
            axios.get('/Actas_de_responsabilidad/Gestores')
            .then(gestores=>{
                state.lista_gestores = (gestores.data);
            })
            .catch(error=>{
                console.log(error);
            })
        },
    }
});

export default store;