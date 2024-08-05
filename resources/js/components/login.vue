<template>
    <div class="login-container">
      <img src="../assets/americas.png" alt="Américas BPS Logo" class="logo">
      <form @submit.prevent="login">
        <div class="input-group">
          <i class="fas fa-id-card"></i>
          <input v-model="datos_login.cedula" type="text" placeholder="Cédula" required>
        </div>
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input v-model="datos_login.password" type="password" placeholder="Contraseña" minlength="4" maxlength="16" required>
        </div>
        <button type="submit"><span :class="cargar"></span> {{titulo}}</button>
        <div class="alert alert-warning mt-4" style="background:#e3cdff; color: #952FA4">
          <p style="font-size:12px"><b>Nota:</b>Tenga en cuenta que para asignar la <b>clave</b> debe escribirla solo una vez en el campo de contraseña, seguido presione <b>iniciar sesion.</b></p>
        </div>
      </form>
    </div>
</template>
  
<script>
import axios from 'axios';
import Swal from 'sweetalert2';


  export default {
    name: 'Login',
    data() {
      return {
        datos_login:{
          cedula: '',
          password: '',
        },
        titulo:'Iniciar sesion',
        cargar:'',
        // Contador para bloquear usuario por seguridad
        contador:0,
      }
    },
    methods: {
      login: async function() {
        
        this.cargar = 'spinner-border spinner-border-sm';
        this.titulo = '';
        await axios.post('/Actas_de_responsabilidad/Login/Validate',this.datos_login)
        .then(res=>{
          switch (res.data) {
            case 0:
              Swal.fire({title:'¡Ups!',text:'Este usuario no existe',icon:'warning',toast:true,position: "top-end",timer:2000, showConfirmButton:false});
              break;
            case 1:
              Swal.fire({title:'¡Exitoso!',text:'¡Clave correctamente asignada!',icon:'success',toast:true,position: "top-end",timer:2000, showConfirmButton:false});
              break;
            case 2:
              window.location.href = '/Actas';
              history.replaceState(null, '', '/Actas');
              this.contador = 0;
              break;
            case 4:
              // Aumentar las veces que intenta acceder al perfil, si es igual a 6 se bloquea
              this.contador += 1;
              if(this.contador >= 4){
                axios.get(`/Actas_de_responsabilidad/Gestores/BloquearUsuario/${this.datos_login.cedula}`)
                  .then(res=>{
                      if(res.data){
                          Swal.fire({
                              icon: 'info',
                              text: '¡Tu usuario ha sido bloqueado!'
                          });
                          this.contador = 0;
                      }
                  })
                  .catch(err=>{
                      // console.log(err);
                  });
              }else{
                // console.log(this.contador);
                Swal.fire({title:'¡Ups!',text:`¿Eres tu?, Digita nuevamente la contraseña ${this.contador}/3 intentos`,icon:'info',toast:true,position: "top-end",timer:2000, showConfirmButton:false});
              }
              break;      
          }
          this.cargar = '';
          this.titulo = 'Iniciar sesion';
        })
        .catch(error=>{
          console.log(error);
        })
      },
      // Cerrar sesion
      cerrar_sesion(){
        axios.post('/Actas_de_responsabilidad/Login/Destroy',this.datos_login)
        .then(res=>{
          if(res.data){
            window.location.href = '/Actas_de_responsabilidad/Login';
            history.replaceState(null, '', '/Actas_de_responsabilidad/Login');
          }
        })
        .catch(error=>{

        });
      }

    }
  }

</script>
  
