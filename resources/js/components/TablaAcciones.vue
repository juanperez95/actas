<template>
    <div>

        <br>
        <div class="flex gap-4">
            <select name="" id="" :class="inputs" @click="mostrarGestores(); llenarCampos();" 
                v-model.number="g_seleccionado">
                <option value="0">Seleccione un gestor</option>
                <option :value="g.id" v-for="g in lista_gestores" :key="g.id">{{ g.nombre_gestor.toUpperCase() }}</option>
            </select>
            <!-- <input type="text" name="" list="camps" :class="inputs" placeholder="Buscar campaña" @click="mostrarCamps();llenarCamposCamps();" v-model.number="cam_escogida" @keyup.enter="llenarCamposCamps();"> -->

            <select :class="inputs" @click="mostrarCamps(); llenarCamposCamps();" v-model="cam_escogida">
                <option value="">Seleccione una campaña</option>
                <option :value="cam.id" v-for="cam in lista_operaciones" :key="cam.id">{{ cam.nombre_camp.toUpperCase() }}
                </option>
            </select>
            <!-- Parte de componente -->
            <select :class="inputs" @click="mostrarComponente(); llenarCamposComponente()"
                v-model="componente_escogido">
                <option value="">Seleccione un componente</option>
                <option :value="componente.id" v-for="componente in componentes_vuex" :key="componente.id">
                    {{ componente.nombre_componente }}</option>
            </select>
        </div>


        <div class="m-3 p-4 input-group mb-3">
            <!-- <div class="text-center"><span :class="[cargar]"></span></div> -->
            <!-- Tabla de gestor con sus datos -->
            <table :class="tabla" v-if="g_seleccionado !== 0">



                <thead>
                    <tr class="cabeceras_tabla">
                        <th :class="tabla" scope="row">N° Documento</th>
                        <th :class="tabla" scope="row">Nombre gestor</th>
                        <th :class="tabla" scope="row">Correo</th>
                        <th :class="tabla" scope="row">Rol</th>
                        <th :class="tabla" scope="row">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="g_found in campos_gestor" :key="g_found.id">
                        <td :class="tabla" scope="row"><input type="text" :class="inputs"
                                v-model="datos_gestor.cedula"></td>
                        <td :class="tabla" scope="row"><input type="text" :class="inputs"
                                v-model="datos_gestor.nombre_gestor"></td>
                        <td :class="tabla" scope="row"><input type="text" :class="inputs"
                                v-model="datos_gestor.correo"></td>
                        <td :class="tabla" scope="row">
                            <input type="radio"  value="administrador"
                                v-model="datos_gestor.rol" name="roles" :checked="datos_gestor.boolean_rol_admin">
                            <label for="" class="form-check-label">Admin</label><br>
                            <input type="radio"  value="gestor"
                                v-model="datos_gestor.rol" name="roles" :checked="datos_gestor.boolean_rol">
                            <label for="" class="form-check-label">Gestor</label>
                        </td>
                        <td :class="tabla" scope="row">
                            <button :class="botones" @click="editarGestor"><span
                                    :class="[carga_update]"></span> Editar</button>
                            <button :class="botones" @click="resetPassword"><i
                                    class="fa-solid fa-key"></i> Borrar contraseña</button>
                                    <!-- Mostrar interfaz de usuario activo -->
                            <button v-if="datos_gestor.usuario_activo" :class="botones" @click="eliminarGestor">
                                <i class="fa-solid fa-toggle-on"></i>
                                 Inhabilitar</button>
                                <button v-if="!datos_gestor.usuario_activo" :class="botones" @click="activarGestor">                              
                                <i class="fa-solid fa-toggle-off"></i> Habilitar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Tabla de historial -->
            <table :class="tabla" v-if="g_seleccionado !== 0">
                <thead>
                    <tr class="cabeceras_tabla">
                        <th :class="tabla">Ultimas actas generadas del gestor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <div class="buscador_fechas">
                            <input type="text" :class="inputs" placeholder="Numero caso" v-model="buscar_caso"
                                @input="buscarCasos">
                            <input type="date" name="" id="" :class="inputs" v-model="fechas.fecha_inicio"
                                required>
                            <input type="date" name="" id="" :class="inputs" v-model="fechas.fecha_fin" required>
                            <button :class="botones" @click="buscarCasosAvanzado">Buscar fechas</button>
                            <!-- Buscar actas por gestor -->
                            <select name="" id="" :class="inputs" @click="mostrarGestores(); filtroActasGestor()"
                                v-model.number="gestor">
                                <option value="">Seleccione un gestor</option>
                                <option :value="g.id" v-for="g in lista_gestores" :key="g.id">
                                    {{ g.nombre_gestor.toUpperCase() }}</option>
                            </select>
                            <!-- Filtrar actas por campaña -->
                            <select :class="inputs" @click="mostrarCamps(); filtroActasCam();" v-model="cam_f">
                                <option value="">Seleccione una campaña</option>
                                <option :value="cam.id" v-for="cam in lista_operaciones" :key="cam.id">
                                    {{ cam.nombre_camp.toUpperCase() }}</option>
                            </select>


                        </div>
                        <div class="p-2 cartas">
                            <div class="card" v-for="acta in actas" :key="acta.id">
                                <div class="card-body colorCartas">
                                    <h5 class="card-title"><b><span><i class="fa-regular fa-file"></i></span>
                                            {{ acta.tipo_acta ? acta.tipo_acta.toUpperCase() : '' }}</b><br>N° Caso:
                                        {{ acta.numero_caso }}</h5>

                                    <p class="card-text"><b>Fecha creacion: {{ acta.fecha_creacion }}</b></p>
                                    <button type="button" class="btn boton_morado_pdf"
                                        @click="downloadPdfAgain(acta.id)"><span><i
                                                class="fa-solid fa-file-pdf"></i></span> Descargar PDF</button>
                                </div>
                            </div>
                        </div>
                    </tr>
                </tbody>
            </table>
            <!-- Tabla de campaña con sus datos -->
            <table class="table" v-if="cam_escogida !== ''">
                <thead>
                    <h4>Campañas</h4>
                    <tr class="cabeceras_tabla">
                        <th :class="tabla" scope="row">Nombre Campaña</th>
                        <th :class="tabla" scope="row">Codigo Campaña</th>
                        <th :class="tabla" scope="row">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="camp in campos_cam" :key="camp.id">
                        <td :class="tabla" scope="row"><input type="text" :class="inputs"
                                v-model="datos_camapaña.nombre_camp"></td>
                        <td :class="tabla" scope="row"><input type="text" :class="inputs" disabled
                                :value="camp.id"></td>
                        <td :class="tabla" scope="row">
                            <button :class="botones" @click="editarCamp"><span
                                    :class="[carga_update]"></span> Editar</button>
                            <button :class="botones" @click="eliminarCam"><i
                                    class="fa-solid fa-eraser"></i> Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Tabla de componentes -->
            <table class="table" v-if="componente_escogido !== ''">
                <thead>
                    <h4>Componentes</h4>
                    <tr class="cabeceras_tabla">
                        <th :class="tabla" scope="row">Nombre Componente</th>
                        <th :class="tabla" scope="row">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="compo in campos_componente" :key="compo.id">
                        <td :class="tabla" scope="row"><input type="text" :class="inputs"
                                v-model="datos_componente.nombre_componente"></td>
                        <td :class="tabla" scope="row">
                            <button :class="botones" @click="editarComponente"><span
                                    :class="[carga_update]"></span> Editar</button>
                            <button :class="botones" @click="eliminarComponente"><i
                                    class="fa-solid fa-eraser"></i> Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a href="" download="" id="tryPdf"></a>
        </div>
    </div>
</template>

<style scoped>
.buscador_fechas {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 10px;
}

.morado_check {
    background-color: #982993;
    color: #915c8e;
}

.morado_check:active {
    border-color: #982993;

}

.cartas {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 10px;
}

.cabeceras_tabla th {
    background-color: #4117db;
    color: aliceblue;
}

.morado_boton {
    border-color: #982993;
    border: none;
    color: #982993;
    transition: transform 0.1s ease-in;
}

.morado_boton:hover {
    background-color: #F8FAFC;
    color: #915c8e;
    transform: scale(0.90);
}

.morado_boton:active {
    background-color: #F8FAFC;
    color: #915c8e;
}

.bordes_input_tabla {
    border-style: none;
    background-color: #F8FAFC;
    transition: box-shadow 0.5s ease-in;
    box-shadow: 0px 0px 0px #982993;
    cursor: pointer;
}

.bordes_input_tabla:focus {
    box-shadow: 0px 0px 0px #982993;
}

.boton_morado_pdf {
    border-color: blueviolet;
    color: blueviolet;
    transition: background-color 0.1s ease-in;
}

.boton_morado_pdf:hover {
    background-color: #982993;
    color: #fff;
    transition: background-color 0.2s ease-in;
}

.colorCartas {
    color: blueviolet;
    box-shadow: 0px 0px 3px #915c8e;
}
</style>


<script>
import axios from 'axios';
import Swal from 'sweetalert2';


// Acceder a funciones y datos de manera global
import { mapMutations, mapState } from 'vuex';


export default {
    mounted() {
        this.cerrarSesionAuto(null);
    },
    data() {
        return {     
            // Filtro por medio de camapañas
            cam_f: '',
            // Buscar por medio del gestor
            gestor: '',
            // Buscar casos por medio del numero de caso
            buscar_caso: '',
            actas: [],
            // ID del gestor escogido en la lista desplegable
            g_seleccionado: 0,
            // ID de la campaña escogida
            cam_escogida: '',
            control_tabla: 0,
            campos_gestor: [],
            campos_cam: [],
            campos_componente: [],
            cargar: '',
            componente_escogido: '',
            // Datos de gestor
            datos_gestor: {
                nombre_gestor: '',
                cedula: '',
                rol: '',
                correo: '',
                boolean_rol: false,
                boolean_rol_admin: true,
                // Usuarios activos
                usuario_activo:true,      
            },
            datos_camapaña: {
                nombre_camp: ''
            },
            datos_componente: {
                nombre_componente: ''
            },
            // Filtrado por fechas
            fechas: {
                fecha_inicio: '',
                fecha_fin: '',
            },
            // Cargas al editar
            carga_update: 'fa-solid fa-pen'
        }
    },
    computed: {
        ...mapState(['componentes_vuex', 'lista_operaciones', 'lista_gestores','inputs','botones','color_label','tabla','datos_form']),
    },
    methods: {
        ...mapMutations(['mostrarComponentes', 'mostrarCamps', 'mostrarGestores', 'cerrarSesionAuto']),
        llenarCampos: async function () {
            await axios.post('/Actas_de_responsabilidad/Gestores/BuscarGestor', { id: this.g_seleccionado })
                .then((gestor) => {
                    this.campos_gestor[0] = (gestor.data);
                    // Llenar variables para poder editar al gestor
                    this.datos_gestor.nombre_gestor = this.campos_gestor[0].nombre_gestor;
                    this.datos_gestor.cedula = this.campos_gestor[0].cedula;
                    this.datos_gestor.correo = this.campos_gestor[0].correo;
                    this.datos_gestor.rol = this.campos_gestor[0].rol;
                    // Invertir el checkradio para saber que rol tiene el usuario
                    if (this.datos_gestor.rol == 'gestor') {
                        this.datos_gestor.boolean_rol = true;
                        this.datos_gestor.boolean_rol_admin = false;
                    } else {
                        this.datos_gestor.boolean_rol = false;
                        this.datos_gestor.boolean_rol_admin = true;

                    }

                    // Validar si el usuario esta activo
                    this.datos_gestor.usuario_activo = this.campos_gestor[0].usuario_activo;
                    this.mostrarHistorial();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        llenarCamposCamps: async function () {
            await axios.post('/Actas_de_responsabilidad/Campanas/BuscarCamp', { id: this.cam_escogida })
                .then((cam) => {
                    this.campos_cam[0] = (cam.data);
                    this.nombre_camp = this.campos_cam[0].nombre_camp;
                    // Llenar campo de nombre
                    this.datos_camapaña.nombre_camp = this.nombre_camp;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        // Eliminar gestor
        eliminarGestor() {
            this.notificacion(1);
        },
        // Eliminar campaña
        eliminarCam() {
            this.notificacion(2);
        },
        eliminarComponente() {
            this.notificacion(3);
        },
        // Activar a gestor
        activarGestor(){
            axios.get(`/Actas_de_responsabilidad/Gestores/Activar_usuario/${this.g_seleccionado}`)
            .then(res=>{
                if(res.data){
                    Swal.fire({
                        icon: 'success',
                        text: '¡Usuario activado!'
                    });
                    this.g_seleccionado = 0;
                }
            })
            .catch(err=>{
                // console.log(err);
            });
        },
        // Notificaciones de sweet
        notificacion(opcion) {
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
                    if (opcion === 1) {
                        axios.delete(`/Actas_de_responsabilidad/Gestores/Destroy/${this.g_seleccionado}`)
                            .then((res) => {
                                this.g_seleccionado = 0;
                            });
                    }

                    if (opcion === 2) {
                        axios.delete(`/Actas_de_responsabilidad/Campanas/Destroy/${this.cam_escogida}`)
                            .then((res) => {
                                this.cam_escogida = '';
                            });
                    }

                    if (opcion === 3) {
                        axios.delete(`/Actas_de_responsabilidad/Componentes/Destroy/${this.componente_escogido}`)
                            .then((res) => {
                                this.componente_escogido = '';
                            });
                    }

                    Swal.fire({
                        title: "¡Exitoso!",
                        text: "¡La accion se ejecuto satisfactoriamente!",
                        icon: "success"
                    });
                }
            });
        },
        // Editar campos de campaña
        editarCamp() {
            this.carga_update = 'spinner-border spinner-border-sm';
            axios.put(`/Actas_de_responsabilidad/Campanas/Update/${this.cam_escogida}`, this.datos_camapaña)
                .then((res) => {
                    Swal.fire({
                        icon: 'success',
                        text: '¡Actualizacion exitosa!'
                    });
                })
            this.carga_update = 'fa-solid fa-pen';
        },
        editarGestor() {
            this.carga_update = 'spinner-border spinner-border-sm';
            axios.put(`/Actas_de_responsabilidad/Gestores/Update/${this.g_seleccionado}`, this.datos_gestor)
                .then((res) => {
                    if (res.data) {
                        Swal.fire({
                            icon: 'success',
                            text: '¡Actualizacion exitosa!'
                        });
                    }
                });
            this.carga_update = 'fa-solid fa-pen';
        },
        editarComponente() {
            axios.put(`/Actas_de_responsabilidad/Componentes/Update/${this.componente_escogido}`, this.datos_componente)
                .then(res => {
                    if (res.data) {
                        Swal.fire({
                            icon: 'success',
                            text: '¡Actualizacion exitosa!'
                        });
                    } else {
                        Swal.fire({
                            icon: 'info',
                            text: `¡Ya existe el componente ${this.datos_componente.nombre_componente}!`
                        });

                    }
                })
                .catch(error => {
                    // console.log(error);
                })
        },
        mostrarComponente: async function () {
            this.mostrarComponentes();
        },
        llenarCamposComponente: async function () {
            await axios.post(`/Actas_de_responsabilidad/Componentes/Buscar_com/${this.componente_escogido}`)
                .then(respuesta => {
                    this.campos_componente[0] = respuesta.data;
                    this.datos_componente.nombre_componente = this.campos_componente[0].nombre_componente;
                })
                .catch(error => {
                    // console.log(error);
                });
        },
        // Restablecer la contraseña de un usuario
        resetPassword() {
            axios.post(`/Actas_de_responsabilidad/Gestores/ResetPass/${this.g_seleccionado}`)
                .then(res => {
                    if (res.data) {
                        Swal.fire('', '¡Restablecimiento de contraseña exitoso!', 'success');
                    }
                }).catch(error => {
                    console.log(error);
                });
        },

        // Mostrar las ultimas actas de un gestor
        mostrarHistorial() {
            axios.post(`/Actas_de_responsabilidad/Historial/${this.g_seleccionado}`)
                .then(res => {
                    this.actas = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },

        // Generar la descarga con los archivos que estan en el servidor
        downloadPdfAgain(id) {
            axios.post(`/Actas_de_responsabilidad/Historial/DownloadPDF/${id}`, {}, { responseType: 'blob' })
                .then(res => {
                    // Descargar el pdf desde laravel
                    var link = document.getElementById('tryPdf');
                    link.download = (new Date().getDate().toLocaleString() + '_' + (new Date().getMonth() + 1).toString() + '_' + (new Date().getFullYear()).toString() + '_' + new Date().getTime().toString()) + 'RECUPERADO' + '.pdf';
                    link.href = URL.createObjectURL(res.data);
                    link.click();
                    URL.revokeObjectURL(link.href);
                })
                .catch(err => {
                    console.log(err)
                });

        },
        // Buscar actas en la barra de busqueda
        buscarCasos: async function () {
            await axios.post(`/Actas_de_responsabilidad/Historial/BuscarCaso/${this.buscar_caso}`)
                .then(res => {
                    this.actas = res.data;
                })
                .catch(err => {

                });
        },
        // Buscar actas en la barra de busqueda por medio de fechas
        buscarCasosAvanzado() {
            axios.post(`/Actas_de_responsabilidad/Historial/BuscarCasoAvanzado/${this.fechas.fecha_inicio}/${this.fechas.fecha_fin}`)
                .then(res => {
                    this.actas = res.data;
                })
                .catch(err => {

                });
        },
        // Filtrar actas por gestor
        filtroActasGestor() {
            axios.get(`/Actas_de_responsabilidad/Gestores/Filtro/${this.gestor}`)
                .then(res => {
                    this.actas = res.data;
                    // console.log(res.data);
                })
                .catch(err => {
                    // console.log(err);
                });
        },
        // Filtrar actas por campaña
        filtroActasCam() {
            axios.get(`/Actas_de_responsabilidad/Campanas/Filtro/${this.cam_f}`)
                .then(res => {
                    this.actas = res.data;
                    // console.log(res.data);
                })
                .catch(err => {
                    // console.log(err);
                });
        }
    },
}
</script>