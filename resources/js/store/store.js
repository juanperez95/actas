import Vuex from 'vuex';
import axios from 'axios';

const store = new Vuex.Store({
    state:{
        componentes_vuex:[],
        lista_gestores:[],
        usuario_session:[],
        lista_operaciones:[],
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
        },
        // Mostrar campañas
        mostrarCamps(state){
            axios.get('/Actas_de_responsabilidad/Campanas')
            .then((cam)=>{
                state.lista_operaciones = cam.data;
            })
            .catch((error)=>{
                console.log(error);
            })
        },
        // Cerrar la sesion despues de un tiempo estimado
        cerrarSesionAuto(state){
            let tiempo = null;
            function start(){
                tiempo = setTimeout(()=>{
                    axios.get('/Actas_de_responsabilidad/Login/DestroyAuto')
                    .then(res=>{
                        if(res.data){
                            window.location.href = "/Actas";
                        }
                    })
                    .catch(err=>{
                        console.log(err);
                    });
                },30000);
            }
            function reset(){
                clearInterval(tiempo);
                start();
            };

            document.addEventListener('mousemove',reset);


        }
    }
});

export default store;