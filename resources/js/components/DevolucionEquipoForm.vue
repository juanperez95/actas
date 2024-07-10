<template>
  <div class="container mt-5">
    <div class="card shadow-lg">
      <div class="card-body">
        <form @submit.prevent="submitForm">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="numeroCaso" class="form-label">Número de Caso:</label>
              <input type="text" id="numeroCaso" class="form-control" @click="getSession" v-model="formData.numeroCaso">
            </div>
            <div class="col-md-6 mb-3">
              <label for="nombres" class="form-label">Nombre:</label>
              <input type="text" id="nombres" class="form-control" v-model="formData.nombres">
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="campana" class="form-label">Campaña:</label>
              <input type="text" id="campana" class="form-control" v-model="formData.campana">
            </div>
            <div class="col-md-4 mb-3">
              <label for="correoPersonal" class="form-label">Correo Personal:</label>
              <input type="email" id="correoPersonal" class="form-control" v-model="formData.correoPersonal">
            </div>
            <div class="col-md-4 mb-3">
              <label for="correoJefe" class="form-label">Correo del Jefe:</label>
              <input type="email" id="correoJefe" class="form-control" v-model="formData.correoJefe">
            </div>
          </div>

          <div class="mb-3">
            <label for="dispositivo" class="form-label">Tipo de Dispositivo:</label>
            <select id="dispositivo" class="form-select form-control" v-model="formData.dispositivo">
              <option value="">Seleccione</option>
              <option value="Portatil">Portátil</option>
              <option value="Escritorio">Escritorio</option>
            </select>
          </div>

          <div class="border p-3 rounded mb-3">
            <h4 class="mb-3">Detalles del Dispositivo</h4>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="serialDispositivo" class="form-label">Serial del Dispositivo:</label>
                <input type="text" id="serialDispositivo" class="form-control" v-model="formData.serialDispositivo">
              </div>
              <div class="col-md-4 mb-3">
                <label for="activoDispositivo" class="form-label">Activo del Dispositivo:</label>
                <input type="text" id="activoDispositivo" class="form-control" v-model="formData.activoDispositivo">
              </div>
              <div class="col-md-4 mb-3">
                <label for="estadoDispositivo" class="form-label">Estado del Dispositivo:</label>
                <select id="estadoDispositivo" class="form-select form-control" v-model="formData.estadoDispositivo">
                  <option value="Bueno">Bueno</option>
                  <option value="Dañado">Dañado</option>
                  <option value="Dado de baja">Dado de baja</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="serialMonitor" class="form-label">Serial del Monitor:</label>
                <input type="text" id="serialMonitor" class="form-control" v-model="formData.serialMonitor">
              </div>
              <div class="col-md-4 mb-3">
                <label for="activoMonitor" class="form-label">Activo del Monitor:</label>
                <input type="text" id="activoMonitor" class="form-control" v-model="formData.activoMonitor">
              </div>
              <div class="col-md-4 mb-3">
                <label for="estadoMonitor" class="form-label">Estado del Monitor:</label>
                <select id="estadoMonitor" class="form-select form-control" v-model="formData.estadoMonitor">
                  <option value="Bueno">Bueno</option>
                  <option value="Dañado">Dañado</option>
                  <option value="Dado de baja">Dado de baja</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="teclado" class="form-label">Teclado:</label>
                <select id="teclado" class="form-select form-control" v-model="formData.teclado">
                  <option value="No">No</option>
                  <option value="Si">Sí</option>
                </select>
              </div>
              <div class="col-md-4 mb-3" v-if="formData.teclado === 'Si'">
                <label for="estadoTeclado" class="form-label">Estado del Teclado:</label>
                <select id="estadoTeclado" class="form-select form-control" v-model="formData.estadoTeclado">
                  <option value="Bueno">Bueno</option>
                  <option value="Dañado">Dañado</option>
                  <option value="Dado de baja">Dado de baja</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="raton" class="form-label">Ratón:</label>
                <select id="raton" class="form-select form-control" v-model="formData.raton">
                  <option value="No">No</option>
                  <option value="Si">Sí</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3" v-if="formData.raton === 'Si'">
                <label for="estadoRaton" class="form-label">Estado del Ratón:</label>
                <select id="estadoRaton" class="form-select form-control" v-model="formData.estadoRaton">
                  <option value="Bueno">Bueno</option>
                  <option value="Dañado">Dañado</option>
                  <option value="Dado de baja">Dado de baja</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="diadema" class="form-label">Diadema:</label>
                <select id="diadema" class="form-select form-control" v-model="formData.diadema">
                  <option value="No">No</option>
                  <option value="Si">Sí</option>
                </select>
              </div>
              <div class="col-md-4 mb-3" v-if="formData.diadema === 'Si'">
                <label for="serialDiadema" class="form-label">Serial de la Diadema:</label>
                <input type="text" id="serialDiadema" class="form-control" v-model="formData.serialDiadema">
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="camara" class="form-label">Cámara:</label>
                <select id="camara" class="form-select form-control" v-model="formData.camara">
                  <option value="No">No</option>
                  <option value="Si">Sí</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="segundoMonitor" class="form-label">¿Segundo Monitor?:</label>
                <select id="segundoMonitor" class="form-select form-control" v-model="formData.segundoMonitor">
                  <option value="No">No</option>
                  <option value="Si">Sí</option>
                </select>
              </div>
            </div>

            <div v-if="formData.segundoMonitor === 'Si'" class="row">
              <div class="col-md-6 mb-3">
                <label for="serialMonitor2" class="form-label">Serial del Segundo Monitor:</label>
                <input type="text" id="serialMonitor2" class="form-control" v-model="formData.serialMonitor2">
              </div>
              <div class="col-md-6 mb-3">
                <label for="activoMonitor2" class="form-label">Activo del Segundo Monitor:</label>
                <input type="text" id="activoMonitor2" class="form-control" v-model="formData.activoMonitor2">
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones:</label>
            <textarea id="observaciones" class="form-control" v-model="formData.observaciones" rows="3"></textarea>
          </div>

          <div class="container firmas">
            <firma firma_d="Firma de quien entrega" :Nombre_de_quien_entrega="formData.nombres" class="mb-3"/>
            <firma firma_d="Firma de quien recibe" :Nombre_de_quien_entrega="usuario_session[0].nombre_gestor" class="mb-3"/>
          </div>

          <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-file-pdf me-2"></i>Generar PDF
            </button>
            <button type="reset" class="btn btn-secondary" @click="limpiarTodo">
              <i class="fas fa-eraser me-2"></i>Limpiar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapMutations } from 'vuex';
import axios from 'axios';
import Swal from 'sweetalert2';
import Firma from './Firma.vue';

export default {
  components:{
    Firma,
  },
  data() {
    return {
      formData: {
        numeroCaso: '',
        nombres: '',
        campana: '',
        correoPersonal: '',
        correoJefe: '',
        dispositivo: '',
        serialDispositivo: '',
        activoDispositivo: '',
        estadoDispositivo: '',
        diadema: 'No',
        serialDiadema: '',
        raton: 'No',
        estadoRaton: '',
        teclado: 'No',
        estadoTeclado: '',
        camara: 'No',
        serialCpu: '',
        activoCpu: '',
        estadoCpu: '',
        serialMonitor: '',
        activoMonitor: '',
        estadoMonitor: '',
        segundoMonitor: 'No',
        serialMonitor2: '',
        activoMonitor2: '',
        tieneDiadema: 'No',
        Diademaserial: '',
        observaciones: '',
        NombreRecibe: this.getSession(),
        firma1: null,
        firma2: null,
      },
   

    };
  },
  computed: {
    isFormValid() {
      return (
        this.formData.numeroCaso &&
        this.formData.nombres &&
        this.formData.campana &&
        this.formData.correoPersonal &&
        this.formData.correoJefe &&
        this.formData.dispositivo &&
        (this.formData.dispositivo === 'Portatil' ? (
          this.formData.serialDispositivo &&
          this.formData.activoDispositivo &&
          this.formData.estadoDispositivo
        ) : (
          this.formData.serialCpu &&
          this.formData.activoCpu &&
          this.formData.estadoCpu &&
          this.formData.serialMonitor &&
          this.formData.activoMonitor &&
          this.formData.estadoMonitor
        ))
      );
    },
    ...mapState(["usuario_session"])

  },
  methods: {
    ...mapMutations(["getSession"]),
    toggleFields() {
      // Lógica para mostrar/ocultar campos según las selecciones
    },
    async submitForm() {
      if (this.isFormValid) {
        this.generarPDF();
      } else {
        this.showNotification('error', 'Por favor, complete todos los campos requeridos.');
      }
    },
    limpiarTodo() {
      // Lógica para reiniciar el formulario
      this.formData = {
        numeroCaso: '',
        nombres: '',
        campana: '',
        correoPersonal: '',
        correoJefe: '',
        dispositivo: '',
        serialDispositivo: '',
        activoDispositivo: '',
        estadoDispositivo: '',
        diadema: 'No',
        serialDiadema: '',
        serialCpu: '',
        activoCpu: '',
        estadoCpu: '',
        raton: 'No',
        estadoRaton: '',
        teclado: 'No',
        estadoTeclado: '',
        camara: 'No',
        serialMonitor: '',
        activoMonitor: '',
        estadoMonitor: '',
        segundoMonitor: 'No',
        serialMonitor2: '',
        activoMonitor2: '',
        tieneDiadema: 'No',
        Diademaserial: '',
        observaciones: '',
      };
    },
    generarPDF() {
      this.showNotification('info', 'Generando PDF...');
      this.showNotification('success', 'PDF generado con éxito');
    },
    showNotification(icon, text) {
      Swal.fire({
        icon,
        text,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    }
  }
};
</script>

<style scoped>
.form-control,
.form-select {
  height: calc(1.5em + 0.75rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: 0.25rem;
}

.form-select {
  padding-right: 2.25rem;
  background-position: right 0.75rem center;
}
</style>