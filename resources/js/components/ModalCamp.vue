<template>
    <div>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-cam" data-bs-whatever="@mdo"><i class="fa-brands fa-font-awesome"></i>   Registrar Campaña</button>

        <div class="modal fade" id="modal-cam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de campañas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nombre campaña:</label>
                        <input type="text" class="form-control" id="recipient-name" v-model="datos_cam.nombre_cam" @keyup.enter="registrarCamp">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" @click="registrarCamp"><span :class="[cargar]"></span>    Registrar Campaña</button>
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
    data() {
        return {
            datos_cam:{
                nombre_cam:''
            },
            cargar:'fa-brands fa-font-awesome'
        }
    },
    methods: {
        // Registrar campaña en la base de datos
        registrarCamp: async function(){
            this.cargar = 'spinner-border spinner-border-sm';
            // Validar que los campos de modal esten diligenciados.
            if(this.validarCamp()){
                await axios.post('/Actas_de_responsabilidad/Campanas/Registro',this.datos_cam)
                .then((cam)=>{
                    if(!cam.data){
                        // Notificar que la campaña fue registrada sin problemas
                        this.notificaciones(1);
                    }else{
                        this.notificaciones(3);
                    }
                })
                .catch((error)=>{
                    this.notificaciones(2);
                    console.log(error);
                })
            }else{
                this.notificaciones(4);

            }
            this.cargar = 'fa-brands fa-font-awesome';
            this.datos_cam.nombre_cam = '';
        },
        // Alertas sweetalert2
        notificaciones(opcion){
            switch (opcion) {
                case 1:
                    Swal.fire({
                        icon:'success',
                        title:'¡Exitoso!',
                        text:`La campaña ${this.datos_cam.nombre_cam.toUpperCase()} ha sido registrada correctamente`,
                    });
                    break;
            
                case 2:
                    Swal.fire({
                        icon:'error',
                        title:'¡Ups!',
                        text:`No fue posible registrar la campaña`,
                    });
                    break;
                case 3:
                    Swal.fire({
                        icon:'info',
                        title:'¡Ups!',
                        text:`¡Ya existe esta campaña!`,
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
        validarCamp(){
            if(this.datos_cam.nombre_cam != ''){
                return true;
            }
            return false;
        }
    },
}
</script>