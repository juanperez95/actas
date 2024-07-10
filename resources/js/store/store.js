import Vuex from 'vuex';
import axios from 'axios';

const store = new Vuex.Store({
    state:{
        componentes_vuex:[],
        lista_gestores:['a'],
        usuario_session:[],
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
        // Saber que usuario inicio sesion para escogerlo en el formulario
        getSession(state){
            axios.get('/Actas_de_responsabilidad/Gestores/Session')
            .then(res=>{               
                state.usuario_session[0] = res.data;
            }).catch(error=>{
                
            })
        }
    }
});

export default store;