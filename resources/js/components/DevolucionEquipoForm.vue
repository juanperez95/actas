<template>
  <div class="card shadow-lg">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 mb-3">        
          <section class="sm:grid grid-cols-5 mt-5 p-2 border-2 gap-8 justify-center items-center">
            <article class="text-2xl bg-fuchsia-950 text-white col-span-5 p-2">Datos del usuario</article>
            <article>
              <label for="numeroCaso" class="form-label">N° Caso:</label>
              <input type="text" id="numeroCaso" :class="inputs" v-model="formData.numeroCaso"
                @click="cargarUsuarioSession">
            </article>
            <article>
              <label for="nombres" class="form-label">Nombre:</label>
              <input type="text" id="nombres" :class="inputs" v-model="formData.nombres">
            </article>
            <article>
              <label for="campana" class="form-label">Campaña:</label>
              <input type="text" id="campana" :class="inputs" v-model="formData.campana" list="listaOp"
                @click="mostrarCamps">
              <datalist id="listaOp">
                <option :value="cam.nombre_camp" v-for="cam in lista_operaciones" :key="cam.id">
                  {{ cam.nombre_camp.toUpperCase() }}</option>
              </datalist>
            </article>
            <article>
              <label for="correoPersonal" class="form-label">Correo usuario:</label>
              <input type="email" id="correoPersonal" :class="inputs" v-model="formData.correoPersonal">
            </article>
            <article>
              <label for="correoJefe" class="form-label">Correo del Jefe:</label>
              <input type="email" id="correoJefe" :class="inputs" v-model="formData.correoJefe">
            </article>
          </section>
        </div>
      </div>

      <div class="border p-3 rounded mb-3">
        <section class="sm:border-2 mt-5 p-2 grid grid-cols-3 gap-8 justify-center items-center">
          <h4 class="text-2xl p-2 bg-fuchsia-950 text-white col-span-3">Detalles del Dispositivo</h4>

          <div class="col-md-6 mb-3">
            <label for="dispositivo" class="form-label">Tipo de dispositivo:</label>
            <select id="dispositivo" :class="[inputs, 'p-3']" v-model="formData.dispositivo">
              <option value="">Seleccione</option>
              <option value="Portatil">Portátil</option>
              <option value="Escritorio">Escritorio</option>
            </select>
          </div>
          <div class="col-md-6 mb-3" v-if="formData.dispositivo === 'Escritorio'">
            <label for="Tipoescritorio" class="form-label">Tipo de escritorio:</label>
            <select id="Tipoescritorio" :class="[inputs, 'p-3']" v-model="formData.Tipoescritorio">
              <option value="Torre">Torre</option>
              <option value="Micro">Micro</option>
            </select>
          </div>
          <div class="mb-1">
            <label for="serialDispositivo" class="form-label">Serial del Dispositivo:</label>
            <input type="text" id="serialDispositivo" :class="inputs" v-model="formData.serialDispositivo">
          </div>
          <div class="mb-1">
            <label for="activoDispositivo" class="form-label">Activo del Dispositivo:</label>
            <input type="text" id="activoDispositivo" :class="inputs" v-model="formData.activoDispositivo">
          </div>


          <div class="col-md-4 mt-3">
            <label for="estadoDispositivo" class="form-label">Estado del Dispositivo:</label>
            <select id="estadoDispositivo" :class="[inputs, 'p-3']" v-model="formData.estadoDispositivo">
              <option value="Bueno">Bueno</option>
              <option value="Dañado">Dañado</option>
              <option value="Dado de baja">Dado de baja</option>
            </select>
          </div>

        </section>
        <div class="row">
          <section class="grid grid-cols-3 p-2 mt-5 border-2 gap-8 ">
            <h3 class="text-white col-span-3 bg-fuchsia-950 p-2 text-2xl">Detalles del monitor</h3>
            <div class="col-md-4 mb-3">
              <label for="serialMonitor" class="form-label">Serial del Monitor:</label>
              <input type="text" id="serialMonitor" :class="inputs" v-model="formData.serialMonitor">
            </div>
            <div class="col-md-4 mb-3">
              <label for="activoMonitor" class="form-label">Activo del Monitor:</label>
              <input type="text" id="activoMonitor" :class="inputs" v-model="formData.activoMonitor">
            </div>
            <div class="col-md-4 mb-3">
              <label for="estadoMonitor" class="form-label">Estado del Monitor:</label>
              <select id="estadoMonitor" :class="[inputs, 'p-3']" v-model="formData.estadoMonitor">
                <option value="Bueno">Bueno</option>
                <option value="Dañado">Dañado</option>
                <option value="Dado de baja">Dado de baja</option>
              </select>
            </div>
          </section>
        </div>

        <div class="row">
          <section class="grid grid-cols-2 border-2 mt-5 p-2 gap-8 mb-8">
            <h4 class="text-white col-span-2 bg-fuchsia-950 p-2 text-2xl">Detalles de los perisfericos</h4>
            <div class="col-md-6 mb-3">
              <label for="raton" class="form-label">Ratón:</label>
              <select id="raton" :class="[inputs, 'p-3']" v-model="formData.raton">
                <option value="No">No</option>
                <option value="Si">Sí</option>
              </select>
            </div>
            <div class="col-md-6 mb-3" v-if="formData.raton === 'Si'">
              <label for="estadoRaton" class="form-label">Estado del Ratón:</label>
              <select id="estadoRaton" :class="[inputs, 'p-3']" v-model="formData.estadoRaton">
                <option value="Bueno">Bueno</option>
                <option value="Dañado">Dañado</option>
                <option value="Dado de baja">Dado de baja</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label for="teclado" class="form-label">Teclado:</label>
              <select id="teclado" :class="[inputs, 'p-3']" v-model="formData.teclado">
                <option value="No">No</option>
                <option value="Si">Sí</option>
              </select>
            </div>
            <div class="col-md-6 mb-3" v-if="formData.teclado === 'Si'">
              <label for="estadoTeclado" class="form-label">Estado del Teclado:</label>
              <select id="estadoTeclado" :class="[inputs, 'p-3']" v-model="formData.estadoTeclado">
                <option value="Bueno">Bueno</option>
                <option value="Dañado">Dañado</option>
                <option value="Dado de baja">Dado de baja</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="diadema" class="form-label">Diadema:</label>
              <select id="diadema" :class="[inputs, 'p-3']" v-model="formData.diadema">
                <option value="No">No</option>
                <option value="Si">Sí</option>
              </select>
            </div>
            <div class="col-md-5 mb-4" v-if="formData.diadema === 'Si'">
              <label for="marcaDiadema" class="form-label">Marca de la Diadema:</label>
              <select id="marcaDiadema" :class="[inputs, 'p-3']" v-model="formData.marcaDiadema">
                <option value="PLANTRONICS">PLANTRONICS</option>
                <option value="JABRA">JABRA</option>
                <option value="XKIM">XKIM</option>
              </select>
            </div>
            <div class="col-md-10  mb-9" v-if="formData.diadema === 'Si'">
              <label for="serialDiadema" class="form-label">Serial de la Diadema:</label>
              <input type="text" id="serialDiadema" :class="inputs" v-model="formData.serialDiadema">
            </div>
            <div class="col-md-10 mb-9" v-if="formData.diadema === 'Si'">
              <label for="estadoDiadema" class="form-label">Estado de la Diadema:</label>
              <select id="estadoDiadema" :class="[inputs, 'p-3']" v-model="formData.estadoDiadema">
                <option value="Bueno">Bueno</option>
                <option value="Dañado">Dañado</option>
                <option value="Dado de baja">Dado de baja</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="camara" class="form-label">Cámara:</label>
              <select id="camara" :class="[inputs, 'p-3']" v-model="formData.camara">
                <option value="No">No</option>
                <option value="Si">Sí</option>
              </select>
            </div>
          </section>

        </div>

        <div class="row">

          <div class="col-md-6 mb-3">
            <label for="segundoMonitor" class="form-label">¿Segundo Monitor?:</label>
            <select id="segundoMonitor" :class="[inputs, 'p-3']" v-model="formData.segundoMonitor">
              <option value="No">No</option>
              <option value="Si">Sí</option>
            </select>
          </div>
        </div>

        <div v-if="formData.segundoMonitor === 'Si'" class="row">
          <div class="col-md-6 mb-3">
            <label for="serialMonitor2" class="form-label">Serial del Segundo Monitor:</label>
            <input type="text" id="serialMonitor2" :class="inputs" v-model="formData.serialMonitor2">
          </div>
          <div class="col-md-6 mb-3">
            <label for="activoMonitor2" class="form-label">Activo del Segundo Monitor:</label>
            <input type="text" id="activoMonitor2" :class="inputs" v-model="formData.activoMonitor2">
          </div>
        </div>
      </div>

      <p>El presente documento confirma la recepción de equipos tecnológicos asignados al <b>TRABAJADOR</b>, los cuales están
        sujetos a validaciones técnicas dentro de un plazo de dos (2) días hábiles. Si no se emite un reporte en este
        periodo, se considerará que los equipos han sido recibidos a satisfacción. En caso de daños ocasionados por mala
        manipulación, se aplicarán descuentos según la valorización del equipo.
        Cualquier desperfecto detectado durante las validaciones será notificado inmediatamente al jefe inmediato o
        responsable de la entrega para que se tomen las acciones correspondientes. EL TRABAJADOR autoriza que, en caso
        de pérdida, extravío, daño o destrucción de cualquiera de los elementos por cualquier motivo, le sea deducido o
        descontado el valor comercial del equipo de cómputo, generando la deducción de las sumas que se le adeuden por
        salarios, prestaciones sociales, vacaciones, intereses de cesantía, pagos de naturaleza extralegal, eventuales
        indemnizaciones y cualquier otra acreencia a la que pueda tener derecho durante la vigencia del contrato de
        trabajo o al momento de la terminación del mismo por cualquier motivo.
        <article for="condiciones" class="p-2 mt-5 flex">
          <input type="checkbox" name="condiciones" id="" class="w-4" :value="true" v-model="condiciones"><label for="condiciones">Si, acepto las condiciones</label>
        </article>
      </p>

      

      <div class="mb-3">
        <label for="observaciones" class="form-label">Observaciones:</label>
        <textarea id="observaciones" :class="inputs" v-model="formData.observaciones" rows="3"></textarea>
      </div>
    </div>



    <div class="flex flex-wrap mt-5 p-3 gap-4 justify-around">
      <firma ref="signaturePad" firma_d="Firma de quien entrega" :Nombre_de_quien_entrega="formData.nombres"
        cargo_persona="" class="mb-3" />
      <firma ref="signaturePad2" firma_d="Firma de quien recibe" :Nombre_de_quien_entrega="formData.NombreRecibe"
        cargo_persona="GESTOR DE SOLUCIONES TECNOLOGICAS(TIMAC)" class="mb-3" />
    </div>

    <div class="flex justify-around p-6 m-2">
      <button type="submit" :class="[botones]" @click="submitForm" :disabled="!condiciones" :enabled="condiciones">
        <i :class="[cargar]"></i> Generar PDF
      </button>
      <button type="reset" :class="[botones]" @click="limpiarTodo">
        <i class="fas fa-eraser me-2"></i>Limpiar
      </button>
    </div>
    <a href="#" download="" id="down"></a>
  </div>
</template>



<script>
import { mapState, mapMutations } from 'vuex';
import axios from 'axios';
import Swal from 'sweetalert2';
import Firma from './Firma.vue';

export default {
  components: {
    Firma,
  },
  mounted() {
    this.getSession();
  },
  data() {
    return {
      formData: {
        tipo_formulario: 'retornos',
        dispositivo: '',
        Tipoescritorio: '',
        numeroCaso: '',
        nombres: ''.toUpperCase(),
        campana: '',
        correoPersonal: '',
        correoJefe: '',
        dispositivo: '',
        serialDispositivo: '',
        activoDispositivo: '',
        estadoDispositivo: '',
        diadema: 'No',
        marcaDiadema: '',
        serialDiadema: '',
        estadoDiadema: '',
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
        NombreRecibe: ''.toUpperCase(),
        firma1: null,
        firma2: null,
      },
      // Valor para aceptar terminos y condiciones y habilitar el boton de generar
      condiciones:false,
      // Mostrar spinner para demostrar que carga el elemento
      cargar:'fas fa-file-pdf me-2',


    };
  },
  methods: {
    ...mapMutations(["getSession", 'mostrarCamps']),
    async submitForm() {
      console.log(this.isFormValid);
      if (this.isFormValid) {
        this.generarPDFRetorno();
      } else {
        this.showNotification('warning', 'Por favor, complete todos los campos requeridos.');
      }
    },
    limpiarTodo() {
      // Lógica para reiniciar el formulario
      this.formData = {
        dispositivo: '',
        Tipoescritorio: '',
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
        marcaDiadema: '',
        serialDiadema: '',
        estadoDiadema: '',
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
    generarPDFRetorno: async function () {
      this.cargar = 'fa-solid fa-spinner fa-spin';
      
      // Asignar firmas a laravel
      this.formData.firma1 = this.$refs.signaturePad.getSignatureDataUrl();
      this.formData.firma2 = this.$refs.signaturePad2.getSignatureDataUrl();
      
      
      this.showNotification('info', 'Generando PDF...');
      
      await axios.post('/PDF_RTN', this.formData, {
        responseType: 'blob'
      })
      .then((res) => {
        if (res.status == 200) {
            var enlace = document.getElementById('down');
            enlace.download = (new Date().getDate().toLocaleString() + '_' + (new Date().getMonth() + 1).toString() + '_' + (new Date().getFullYear()).toString() + '_' + new Date().getTime().toString()) + '_GESTOR_RETORNO_A ' + (this.formData.nombres.toUpperCase()) + '--' + (this.formData.NombreRecibe.toUpperCase()) + '.pdf';
            enlace.href = URL.createObjectURL(res.data);
            enlace.click();
            URL.revokeObjectURL(enlace.href);
          } else {
            // this.notificacion(2);
          }
        }).catch((err) => {
          console.log(err);
        })
        
        this.showNotification('success', 'PDF generado con éxito');
        this.cargar = 'fas fa-file-pdf me-2';
        
        
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
    },
    cargarUsuarioSession() {
      try {
        this.formData.NombreRecibe = this.usuario_session[0].nombre_gestor;

      } catch (error) {
        // Console.log(error);
      }
    }
  },
  computed: {
    isFormValid() {
      if (this.formData.nombres == '' || this.formData.serialMonitor == '' || this.formData.serialDispositivo == '' &&
        this.formData.numeroCaso == '' || this.formData.NombreRecibe == '' || this.formData.correoPersonal == '' || this.formData.campana == ''
        && this.formData.Tipoescritorio == '') {
        return false;
      }
      return true;


    },
    ...mapState(["usuario_session", 'lista_operaciones', 'inputs', 'botones', 'color_label'])

  },
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