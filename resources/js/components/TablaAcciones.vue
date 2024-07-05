<template>
    <div>
        <br>
        <div class="container m-2 p-4" style="display: flex; justify-content:space-between; gap:50px; align-items:center;">
            <select name="" id="" class="form-select" @click="mostrarGestores(); llenarCampos()" v-model.number="g_seleccionado">
                <option value="0">Seleccione un gestor</option>
                <option :value="g.id" v-for="g in gestor" :key="g.id">{{g.nombre_gestor.toUpperCase()}}</option>
            </select>
            <div><span :class="[cargar]"></span></div>
            <!-- <input type="text" name="" list="camps" class="form-control" placeholder="Buscar campaña" @click="mostrarCamps();llenarCamposCamps();" v-model.number="cam_escogida" @keyup.enter="llenarCamposCamps();"> -->

            <select class="form-select" @click="mostrarCamps();llenarCamposCamps();" v-model.number="cam_escogida">
                <option value="">Seleccione una campaña</option>
                <option :value="cam.id" v-for="cam in camapaña" :key="cam.id" >{{cam.nombre_camp.toUpperCase()}}</option>
            </select>
        </div>

        <div class="container m-3 p-4">
            <!-- Tabla de gestor con sus datos -->
            <table class="table" v-if="g_seleccionado !== 0">
                <thead>
                    <h4>Gestores</h4>
                    <tr>
                        <th scope="row">Nombre gestor</th>
                        <th scope="row">Correo</th>
                        <th scope="row">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="g_found in campos_gestor" :key="g_found.id">
                        <td scope="row"><input type="text" class="form-control" :disabled="[boton_activado]" :value="g_found.nombre_gestor"></td>
                        <td scope="row"><input type="text" class="form-control" :disabled="[boton_activado]" :value="g_found.correo"></td>
                        <td scope="row">
                            <button class="btn btn-primary mt-2 m-2"><i class="fa-solid fa-user-pen"></i> Editar</button>
                            <button class="btn btn-danger mt-2 m-2" @click="eliminarGestor"><i class="fa-solid fa-user-xmark"></i>   Eliminar</button>
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
                        <td scope="row"><input type="text" class="form-control" :disabled="[boton_activado]" v-model="nombre_camp"></td>
                        <td scope="row"><input type="text" class="form-control" :disabled="[boton_activado]" :value="camp.id"></td>
                        <td scope="row">
                            <button class="btn btn-primary mt-2 m-2" @click="editarCamp"><i class="fa-solid fa-user-pen"></i> Editar</button>
                            <button class="btn btn-danger mt-2 m-2" @click="eliminarCam"><i class="fa-solid fa-user-xmark"></i>   Eliminar</button>
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
            cargar:'',
            nombre_camp:'',
            // Habilitar campos de editar
            boton_activado:true,
        }
    },
    methods: {
        // Mostrar gestores
        mostrarGestores: async function(){
            this.cargar = 'spinner-border spinner-border';
            this.control_tabla = 1;
            await axios.get('/Actas_de_responsabilidad/Gestores')
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
            this.cargar = 'spinner-border spinner-border';
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
            this.boton_activado = false;
            // axios.put(`/Actas_de_responsabilidad/Campanas/Update/${this.cam_escogida}`,{nombre_camp:this.nombre_camp})
        },
        editarGestor(){
            // axios.put(`/Actas_de_responsabilidad/Campanas/Update/${this.cam_escogida}`,{nombre_camp:this.nombre_camp})
        }
    },
}
</script>