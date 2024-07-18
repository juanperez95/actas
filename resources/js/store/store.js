import Vuex from 'vuex';
import axios from 'axios';
import Swal from 'sweetalert2';


const store = new Vuex.Store({
    state:{
        componentes_vuex:[],
        lista_gestores:[],
        usuario_session:[],
        lista_operaciones:[],
        datos_form:[],
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
        // Cerrar la sesion despues de un tiempo estimado de inactividad
        cerrarSesionAuto(state, lista){
            let tiempo = null;
            function start(){
                tiempo = setTimeout(()=>{
                    axios.get('/Actas_de_responsabilidad/Login/DestroyAuto')
                    .then(res=>{
                        if(res.data){
                            localStorage.setItem('cache_acta',JSON.stringify([lista]));
                            window.location.href = "/Actas";
                            history.replaceState(null, '', '/Actas');                                    
                        }
                    })
                    .catch(err=>{
                        // console.log(err);
                    });
                },(60000*10)); // La sesion se cierra en 10 minutos
            }
            function reset(){
                clearInterval(tiempo);
                start();
                // console.log('inicia nuevamente!')
            };

            document.addEventListener('mousemove',reset);


        },
        // Validar que hay datos en el local storage
        validateActas(state, tipo){
            let datos = null;

            if(localStorage.length !== 0){
                datos = localStorage.getItem('cache_acta');
                if(datos[0].tipo_formulario == tipo) {
                    this.notificaciones();
                }else{
                    console.log("no!")
                }
            }
        },
        notificaciones(state){
            Swal.fire({
                title: "¿Completar acta?",
                text: "Hay un acta pendiente por completar!",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si"
                }).then((result) => {
                if (result.isConfirmed) {
                    state.datos_form = datos;
                }else{
                    localStorage.clear();
                }
            });
        }
    }
});

export default store;