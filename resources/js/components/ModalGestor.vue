<template>
    <div>
        <button type="button" class="btn morado_boton" data-bs-toggle="modal" data-bs-target="#example-modal" data-bs-whatever="@mdo"><span class="fas fa-user"/>     Registrar gestor</button>

        <div class="modal fade" id="example-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de gestores</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">N° Documento:</label>
                        <input type="number" class="form-control" id="recipient-name" v-model="datos_gestor.cedula">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nombre gestor:</label>
                        <input type="text" class="form-control" id="recipient-name" v-model="datos_gestor.nombre">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Correo del gestor:</label>
                        <input type="email" class="form-control" id="message-text" v-model="datos_gestor.correo">
                    </div>
                    <!-- Roles de los gestores -->
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Asignar rol:</label>
                        <select class="form-control" id="message-text" v-model="datos_gestor.rol" @keyup.enter="registrarGestor">
                            <option value="gestor">Gestor</option>
                            <option value="administrador">Administrador</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn morado_boton" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn morado_boton" @click="registrarGestor"><span :class="[cargar]"></span>    Registrar</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    data(){
        return{
            // Datos de un gestor para validar la base de datos
            datos_gestor:{
                cedula:'',
                nombre:''.toLowerCase(),
                correo:''.toLowerCase(),
                rol:''.toLowerCase(),
            },
            // Spinner de carga de datos
            cargar:'fas fa-user',
        }
    },
    methods: {
        // Registrar a gestor en la base de datos
        registrarGestor: async function(){
            this.cargar = 'spinner-border spinner-border-sm';
            // Validar campos
            if(this.validarGestor()){
                await axios.post('/Actas_de_responsabilidad/Gestores/Registro',this.datos_gestor)
                .then((gestor)=>{
                    if(gestor.data){
                        this.notificaciones(3);
                    }else{
                        this.notificaciones(1);
                        // Limpiar los datos del formulario
                        this.datos_gestor.nombre = '';
                        this.datos_gestor.correo = '';
                        this.datos_gestor.cedula = '';
                        this.datos_gestor.rol = '';
                    }
                })
                .catch((error)=>{
                    this.notificaciones(2);    
                    console.log(error);           
                });
            }else{
                this.notificaciones(4);
            }
            this.cargar = 'fas fa-user';
        },
        // Notificaciones de swwetalert2
        notificaciones(opcion){
            switch (opcion) {
                case 1:
                    Swal.fire({
                        icon:'success',
                        title:'¡Exitoso!',
                        text:`El gestor ${this.datos_gestor.nombre.toUpperCase()} ha sido registrado correctamente`,
                    });
                    break;
            
                case 2:
                    Swal.fire({
                        icon:'error',
                        title:'¡Ups!',
                        text:`No fue posible registrar a el gestor`,
                    });
                    break;
                case 3:
                    Swal.fire({
                        icon:'info',
                        title:'¡Ups!',
                        text:`¡Ya existe este gestor!`,
                    });
                    break;
                case 4:
                    Swal.fire({
                        icon:'warning',
                        title:'¡Ups!',
                        text:`¡llene todos los campos!`,
                    });
                    break;
            }
        },
        // Validar campos del modal
        validarGestor(){
            if(this.datos_gestor.nombre != '' || this.datos_gestor.correo != '' || this.datos_gestor.cedula != '' || this.datos_gestor.rol != ''){
                return true;
            }
            return false;
        }
    },

}
</script>

<style scoped>
.morado_boton{
    border-color: #982993;
    border:none;
    color: #982993;
    transition: transform 0.1s ease-in;
}
.morado_boton:hover{
    background-color: white;
    color: #915c8e;
    transform: scale(1.10);
}
.morado_boton:active{
    background-color: white;
    color: #915c8e;
}
</style>