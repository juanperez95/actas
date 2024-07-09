<template>
    <div>
        <br>
        <div class="m-2 p-4 input-group mb-3" style="display: flex; justify-content:space-between; gap:50px; align-items:center;">
            <select name="" id="" class="form-select" @click="mostrarGestores(); llenarCampos()" v-model.number="g_seleccionado">
                <option value="0">Seleccione un gestor</option>
                <option :value="g.id" v-for="g in gestor" :key="g.id">{{g.nombre_gestor.toUpperCase()}}</option>
            </select>
            <!-- <input type="text" name="" list="camps" class="form-control" placeholder="Buscar campaña" @click="mostrarCamps();llenarCamposCamps();" v-model.number="cam_escogida" @keyup.enter="llenarCamposCamps();"> -->
            
            <select class="form-select" @click="mostrarCamps();llenarCamposCamps();" v-model="cam_escogida">
                <option value="">Seleccione una campaña</option>
                <option :value="cam.id" v-for="cam in camapaña" :key="cam.id" >{{cam.nombre_camp.toUpperCase()}}</option>
            </select>
            <!-- Parte de componente -->
            <select class="form-select" @click="mostrarComponente();llenarCamposComponente()" v-model="componente_escogido">
                <option value="">Seleccione un componente</option>
                <option :value="componente.id" v-for="componente in componentes_vuex" :key="componente.id" >{{componente.nombre_componente}}</option>
            </select>
        </div>
        
        <div class="m-3 p-4 input-group mb-3">
            <!-- <div class="text-center"><span :class="[cargar]"></span></div> -->
            <!-- Tabla de gestor con sus datos -->
            <table class="table" v-if="g_seleccionado !== 0">
                <thead>
                    <h4>Gestores</h4>
                    <tr>
                        <th scope="row">N° Documento</th>
                        <th scope="row">Nombre gestor</th>
                        <th scope="row">Correo</th>
                        <th scope="row">Rol</th>
                        <th scope="row">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="g_found in campos_gestor" :key="g_found.id">
                        <td scope="row"><input type="text" class="form-control"  v-model="datos_gestor.cedula"></td>
                        <td scope="row"><input type="text" class="form-control"  v-model="datos_gestor.nombre_gestor"></td>
                        <td scope="row"><input type="text" class="form-control"  v-model="datos_gestor.correo"></td>
                        <td scope="row">
                            <input type="radio" class="form-check-input p-2 m-1" value="administrador" v-model="datos_gestor.rol" name="roles" :checked="datos_gestor.boolean_rol_admin">
                            <label for="" class="form-check-label">Admin</label><br>
                            <input type="radio" class="form-check-input p-2 m-1" value="gestor" v-model="datos_gestor.rol" name="roles" :checked="datos_gestor.boolean_rol">
                            <label for="" class="form-check-label">Gestor</label>
                        </td>
                        <td scope="row">
                            <button class="btn btn-outline-primary mt-2 m-2" @click="editarGestor"><span :class="[carga_update]"></span> Editar</button>
                            <button class="btn btn-outline-primary mt-2 m-2" @click="resetPassword"><i class="fa-solid fa-key"></i> Restablecer contraseña</button>
                            <button class="btn btn-outline-danger mt-2 m-2" @click="eliminarGestor"><i class="fa-solid fa-eraser"></i>   Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Tabla de campaña con sus datos -->
            <table class="table" v-if="cam_escogida !== ''">
                <thead>
                    <h4>Campañas</h4>
                    <tr>
                        <th scope="row">Nombre Campaña</th>
                        <th scope="row">Codigo Campaña</th>
                        <th scope="row">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="camp in campos_cam" :key="camp.id">
                        <td scope="row"><input type="text" class="form-control" v-model="datos_camapaña.nombre_camp"></td>
                        <td scope="row"><input type="text" class="form-control" disabled :value="camp.id"></td>
                        <td scope="row">
                            <button class="btn btn-outline-primary mt-2 m-2" @click="editarCamp"><span :class="[carga_update]"></span> Editar</button>
                            <button class="btn btn-outline-danger mt-2 m-2" @click="eliminarCam"><i class="fa-solid fa-eraser"></i>   Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Tabla de componentes -->
            <table class="table" v-if="componente_escogido !== ''">
                <thead>
                    <h4>Campañas</h4>
                    <tr>
                        <th scope="row">Nombre Componente</th>
                        <th scope="row">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="compo in campos_componente" :key="compo.id">
                        <td scope="row"><input type="text" class="form-control" v-model="datos_componente.nombre_componente"></td>
                        <td scope="row">
                            <button class="btn btn-outline-primary mt-2 m-2" @click="editarComponente"><span :class="[carga_update]"></span> Editar</button>
                            <button class="btn btn-outline-danger mt-2 m-2" @click="eliminarComponente"><i class="fa-solid fa-eraser"></i>   Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
// Acceder a funciones y datos de manera global
import { mapMutations, mapState } from 'vuex';


export default {
    data() {
        return {
            gestor:[],
            camapaña:[],
            // ID del gestor escogido en la lista desplegable
            g_seleccionado:0,
            // ID de la campaña escogida
            cam_escogida:'',
            control_tabla:0,
            campos_gestor:[],
            campos_cam:[],
            campos_componente:[],
            cargar:'',
            componente_escogido:'',
            datos_gestor:{
                nombre_gestor:'',
                cedula:'',
                rol:'',
                correo:'',
                boolean_rol:false,
                boolean_rol_admin:true,
            },
            datos_camapaña:{
                nombre_camp:''
            },
            datos_componente:{
                nombre_componente:''
            },
            // Cargas al editar
            carga_update:'fa-solid fa-pen'
        }
    },
    computed:{
        ...mapState(['componentes_vuex']),
    },
    methods: {
        ...mapMutations(['mostrarComponentes']),
        // Mostrar gestores
        mostrarGestores: async function(){
            this.cargar = 'spinner-grow spinner-grow-sm';
            this.control_tabla = 1;
            await axios.get('/Actas_de_responsabilidad/Gestores/Admin')
            .then((gestor)=>{
                this.gestor = gestor.data;
            })
            .catch((error)=>{
                console.log(error);
            });
            this.cargar = '';
        },
        // Mostrar lasw campañas disponibles
        mostrarCamps: async function(){
            this.cargar = 'spinner-grow spinner-grow-sm';
            await axios.get('/Actas_de_responsabilidad/Campanas')
            .then((cam)=>{
                this.camapaña = cam.data;
            })
            .catch((error)=>{
                console.log(error);
            })
            this.cargar = '';
        },
        llenarCampos: async function(){
            await axios.post('/Actas_de_responsabilidad/Gestores/BuscarGestor',{id:this.g_seleccionado})
            .then((gestor)=>{
                this.campos_gestor[0] = (gestor.data);
                // Llenar variables para poder editar al gestor
                this.datos_gestor.nombre_gestor = this.campos_gestor[0].nombre_gestor;
                this.datos_gestor.cedula = this.campos_gestor[0].cedula;
                this.datos_gestor.correo = this.campos_gestor[0].correo;
                this.datos_gestor.rol = this.campos_gestor[0].rol;
                // Invertir el checkradio para saber que rol tiene el usuario
                if(this.datos_gestor.rol == 'gestor'){
                    this.datos_gestor.boolean_rol = true;
                    this.datos_gestor.boolean_rol_admin = false;                
                }else{
                    this.datos_gestor.boolean_rol = false;
                    this.datos_gestor.boolean_rol_admin = true;                

                }
            })
            .catch((error)=>{
                console.log(error);
            });
        },
        llenarCamposCamps: async function(){
            await axios.post('/Actas_de_responsabilidad/Campanas/BuscarCamp',{id:this.cam_escogida})
            .then((cam)=>{
                this.campos_cam[0] = (cam.data);
                this.nombre_camp = this.campos_cam[0].nombre_camp;
                // Llenar campo de nombre
                this.datos_camapaña.nombre_camp = this.nombre_camp;
            })
            .catch((error)=>{
                console.log(error);
            });
        },
        // Eliminar gestor
        eliminarGestor(){
            this.notificacion(1);
        },
        // Eliminar campaña
        eliminarCam(){
            this.notificacion(2);
        },
        eliminarComponente(){
            this.notificacion(3);
        },
        // Notificaciones de sweet
        notificacion(opcion){
            Swal.fire({
            title: "¿Esta seguro?",
            text: "¡Desea continuar la siguiente accion!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si"
            }).then((result) => {
            if (result.isConfirmed) {
                if(opcion === 1){
                    axios.delete(`/Actas_de_responsabilidad/Gestores/Destroy/${this.g_seleccionado}`)
                    .then((res)=>{
                        this.g_seleccionado = 0;
                    });              
                }

                if(opcion === 2){
                    axios.delete(`/Actas_de_responsabilidad/Campanas/Destroy/${this.cam_escogida}`)
                    .then((res)=>{
                        this.cam_escogida = '';
                    });    
                }

                if(opcion === 3){
                    axios.delete(`/Actas_de_responsabilidad/Componentes/Destroy/${this.componente_escogido}`)
                    .then((res)=>{
                        this.componente_escogido = '';
                    });    
                }

                Swal.fire({
                title: "¡Borrado!",
                text: "¡La accion se ejecuto exitosamente!",
                icon: "success"
                });
            }
            });
        },
        // Editar campos de campaña
        editarCamp(){       
            this.carga_update = 'spinner-border spinner-border-sm';
            axios.put(`/Actas_de_responsabilidad/Campanas/Update/${this.cam_escogida}`,this.datos_camapaña)
            .then((res)=>{
                Swal.fire({
                    icon:'success',
                    text:'¡Actulizacion exitosa!'
                });
            })
            this.carga_update = 'fa-solid fa-pen';
        },
        editarGestor(){
            this.carga_update = 'spinner-border spinner-border-sm';
            axios.put(`/Actas_de_responsabilidad/Gestores/Update/${this.g_seleccionado}`,this.datos_gestor)
            .then((res)=>{
                if(res.data){
                    Swal.fire({
                        icon:'success',
                        text:'¡Actulizacion exitosa!'
                    });
                }
            });
            this.carga_update = 'fa-solid fa-pen';
        },
        editarComponente(){
            axios.put(`/Actas_de_responsabilidad/Componentes/Update/${this.componente_escogido}`,this.datos_componente)
            .then(res=>{
                if(res.data){
                    Swal.fire({
                        icon:'success',
                        text:'¡Actualizacion exitosa!'
                    });
                }else{
                    Swal.fire({
                        icon:'info',
                        text:`¡Ya existe el componente ${this.datos_componente.nombre_componente}!`
                    });

                }
            })
            .catch(error=>{
                // console.log(error);
            })
        },
        mostrarComponente: async function(){
            this.mostrarComponentes();
        },
        llenarCamposComponente: async function(){
            await axios.post(`/Actas_de_responsabilidad/Componentes/Buscar_com/${this.componente_escogido}`)
            .then(respuesta=>{
                this.campos_componente[0] = respuesta.data;
                this.datos_componente.nombre_componente = this.campos_componente[0].nombre_componente;
            })
            .catch(error=>{
                // console.log(error);
            });
        },
        // Restablecer la contraseña de un usuario
        resetPassword(){
            axios.post(`/Actas_de_responsabilidad/Gestores/ResetPass/${this.g_seleccionado}`)
            .then(res=>{
                if(res.data){
                    Swal.fire('','¡Restablecimiento de contraseña exitoso!','success');
                }
            }).catch(error=>{
                console.log(error);
            });
        }
    },
}
</script>