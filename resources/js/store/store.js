import Vuex from 'vuex';
import axios from 'axios';
import Swal from 'sweetalert2';


const store = new Vuex.Store({
    state:{
        componentes_vuex:[],
        lista_gestores:[],
        usuario_session:[],
        lista_operaciones:[],
        // Datos form sirve para recoger los datos que se guardan en localStorage si desen recuperar formularios guardados.
        datos_form:[],
        name_gestor_session:'',
        // Variables para clases
        inputs:'mt-2 p-2 rounded-md bg-opacity-70 text-slate-900 transition duration-150 shadow-sm shadow-fuchsia-600/50 outline-none focus:shadow-xl focus:shadow-fuchsia-600/10 w-full',
        botones:'rounded-lg p-3 bg-fuchsia-700 bg-opacity-70 transition scale-1 duration-100 ease-in hover:bg-fuchsia-800 text-white m-1',
        color_label:'text-slate-900 p-1 mt-2',
        tabla:'outline-none border-none text-center',
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
        // Nombre del gestor con la sesion
        getNameGestor(state){
            axios.get('/Actas_de_responsabilidad/Gestores/Session')
            .then(res=>{               
                state.name_gestor_session = res.data.nombre_gestor;
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
                            window.location.href = "/Actas";
                            history.replaceState(null, '', '/Actas');                                    
                        }
                    })
                    .catch(err=>{
                        // console.log(err);
                    });
                },(60000*15)); // La sesion se cierra en 15 minutos
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
        },
        // Funcion para guardar formularios por parte del usuario
        saveForm(state, lista){
            var documento = lista.documento;
            let datos = lista.form;
            let mapeo = new Map();
            try{
                // Validar si en el localStorage tiene datos y buscar y reemplzaar los datos del usuario logueado.
                if(localStorage.length !== 0){
                    let local_storage = new Map(Object.entries(JSON.parse(localStorage.getItem('cache_actas'))));
                    console.log(local_storage.has(documento))
                    if(local_storage.has(documento)){
                        // Actualizar los datos de la coleccion
                        local_storage.set(documento,datos);

                        // Volver a llevar los datos al storage
                        local_storage.clear();
                        localStorage.setItem('cache_actas',JSON.stringify(Object.fromEntries(local_storage)));

                    }
                }else{
                    // Guardar datos si no encuentra al usuario en la cache crear una coleccion de datos
                    let datos_new = [mapeo.set(documento,datos)];
                    localStorage.setItem('cache_actas',JSON.stringify(Object.fromEntries(datos_new[0])));
                    
                }
            }catch(Exception){
                console.log(Exception);
            }
        }
    }
});

export default store;