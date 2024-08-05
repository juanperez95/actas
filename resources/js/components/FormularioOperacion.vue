<template>
  <div>
    <div id="operaciones m-2">
      <p>Señor(a) <input type="text" placeholder="Ingrese el nombre" v-model="form_data.nombre_encargado"
          class="form-control"></p>
      <p>CC. <input type="number" class="form-control" placeholder="Ingrese el número de CC"
          v-model.number="form_data.documento_encargado"></p>
      <p>Correo: <input type="email" placeholder="Ingrese el correo" v-model="form_data.correo_encargado"
          class="form-control"></p>
      <p>Datos gestor:</p>
      <input name="" id="" class="form-control" v-model="form_data.nombre_gestor" disabled>
      <p>Respetado(a) Señor(a)</p>
      <p>El presente formato se tiene con fin de entregar la responsabilidad del activo solicitado a la operación
        retirando el activo anterior según el caso: <input type="text" placeholder="Ingrese el caso"
          v-model="form_data.n_caso" class="form-control"></p>
      <p>Definiciones:</p>
      <ul>
        <li>Motivo de Solicitud <input type="text" placeholder="Ingrese el motivo" v-model="form_data.motivo_solicitud"
            class="form-control"></li>
        <li>Operación Solicitante <span :class="[cargar1]"></span>
          <!-- Lista que permite escribir las opciones -->
          <input type="text" list="lista" class="form-control" v-model="form_data.op_solicitante" @click="mostrarCamps"
            @touchstart="mostrarCamps" placeholder="Ingrese la operacion solicitante">

          <!-- Iterar todas las campañas de la base de datos -->
          <datalist id="lista">
            <option :value="cam.nombre_camp.toUpperCase()" v-for="cam in lista_operaciones" :key="cam.id">
              {{ cam.nombre_camp.toUpperCase() }}</option>
          </datalist>
        </li>
        <li>Estado de Entrega del Nuevo Activo
          <select class="form-select mt-2 mb-2" v-model="form_data.est_entrega_nuevoActivo">
            <option value="EN REPARACION">EN REPARACION</option>
            <option value="DAÑADO">DAÑADO</option>
            <option value="OPERATIVO">OPERATIVO</option>
          </select>
        </li>
        <li>Estado de Recibido del Activo Recogido
          <select class="form-select mt-2 mb-2" v-model="form_data.est_recibido_activo">
            <option value="EN REPARACION">EN REPARACION</option>
            <option value="DAÑADO">DAÑADO</option>
            <option value="OPERATIVO">OPERATIVO</option>
          </select>
        </li>
      </ul>
      <p>Activos relacionados:</p>
      <table class="table cabeceras_tabla">
        <tr>
          <th>Elemento Recogido</th>
          <th>Serial</th>
          <th>Activo</th>
          <th>Observaciones (Estado)</th>
          <th>Acciones</th>
        </tr>
        <tr>
          <td>
            <select name="" id="" class="form-select" v-model="form_data.elemento_recogido" @click="mostrarComponentes"
              @touchstart="mostrarComponentes">
              <option :value="componente.nombre_componente" v-for="componente in componentes_vuex" :key="componente.id">
                {{ componente.nombre_componente.toUpperCase() }}</option>
            </select>
          </td>
          <td><input type="text" placeholder="Ingrese el serial" v-model="form_data.serial_recogido"
              class="form-control"></td>
          <td><input type="text" placeholder="Ingrese el activo" v-model="form_data.activo_recogido"
              class="form-control"></td>
          <td><input type="text" placeholder="Ingrese las observaciones" v-model="form_data.observaciones_recogido"
              class="form-control" @keyup.enter="agregarRecogidos"></td>
          <td>
            <button class="btn morado_boton" @click="agregarRecogidos" @touchstart="agregarRecogidos"><i
                class="fa-solid fa-plus"></i> Agregar</button>
          </td>
        </tr>
      </table>
      <!-- vista de agregados de equipos recogidos -->
      <div class="p-1" v-if="form_data.data_recogido.length !== 0">
        <table class="table cabeceras_tabla">
          <thead>
            <tr>
              <th>Elemento</th>
              <th>N° Serial</th>
              <th>N° Activo</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="data in form_data.data_recogido" :key="data.id">
              <td scope="col">{{ data.elemento_recogido }}</td>
              <td scope="col">{{ data.serial_recogido }}</td>
              <td scope="col">{{ data.activo_recogido }}</td>
              <td scope="col">
                <button class="btn morado_boton" @click="quitarRecogidos(data)" @touchstart="quitarRecogidos(data)"><i
                    class="fa-solid fa-trash"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Tabla entregados -->
      <table class="table cabeceras_tabla">
        <tr>
          <th>Elemento Entregado</th>
          <th>Serial</th>
          <th>Activo</th>
          <th>Observaciones (Estado)</th>
          <th>Acciones</th>
        </tr>
        <tr>
          <td>
            <select name="" id="" class="form-select" v-model="form_data.elemento_entregado" @click="mostrarComponentes"
              @touchstart="mostrarComponentes">
              <option :value="componente.nombre_componente" v-for="componente in componentes_vuex" :key="componente.id">
                {{ componente.nombre_componente.toUpperCase() }}</option>
            </select>
          </td>
          <td><input type="text" placeholder="Ingrese el serial" v-model="form_data.serial_entregado"
              class="form-control"></td>
          <td><input type="text" placeholder="Ingrese el activo" v-model="form_data.activo_entregado"
              class="form-control"></td>
          <td><input type="text" placeholder="Ingrese las observaciones" v-model="form_data.observaciones_entregado"
              class="form-control" @keyup.enter="agregarEntregados"></td>
          <td>
            <button @click="agregarEntregados" @touchstart="agregarEntregados" class="btn morado_boton"><i
                class="fa-solid fa-plus"></i> Agregar</button>
          </td>
        </tr>
      </table>

      <!-- Vista de elementos entregados -->
      <div class="p-1" v-if="form_data.data_entregado.length !== 0">

        <table class="table cabeceras_tabla">
          <thead>
            <tr>
              <th>Elemento</th>
              <th>N° Serial</th>
              <th>N° Activo</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="data in form_data.data_entregado" :key="data.id">
              <td scope="col">{{ data.elemento_entregado }}</td>
              <td scope="col">{{ data.serial_entregado }}</td>
              <td scope="col">{{ data.activo_entregado }}</td>
              <td scope="col">
                <button class="btn morado_boton" @click="quitarEntregados(data)" @touchstart="quitarEntregados(data)"><i
                    class="fa-solid fa-trash"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <p>Observación: <textarea placeholder="Ingrese la observación" v-model="form_data.observaciones"></textarea></p>
      <hr>
      <!-- Componente firmas -->
      <div class="container firmas">
        <Firma ref="signaturePad" firma_d="Firma de quien entrega" class="mb-3" cargo_persona="GESTOR SOLUCIONES TECNOLOGICAS" :Nombre_de_quien_entrega="form_data.nombre_gestor"></Firma>
        <Firma ref="signaturePad2" firma_d="Firma Operacion" class="mb-3" :cargo_persona="form_data.cargo_operacion" :Nombre_de_quien_entrega="form_data.nombre_encargado"></Firma>
        <Firma ref="signaturePad3" firma_d="Firma Operacion" class="mb-3" cargo_persona=""></Firma>
      </div>
      <table>
        <tr>
          <th></th>
          <th></th>
        </tr>
        <tr>
          <td>
            <p>Nombre: <b>{{ form_data.nombre_encargado.toUpperCase() }}</b></p>
            <p>Cargo:
              <select class="form-select" v-model="form_data.cargo_operacion" required>
                <!-- Cargos de personas que pueden firmar -->
                <option value="JEFE DE OPERACION">Jefe de Operacion</option>
                <option value="DIRECTOR DE OPERACIONES">Director de Operaciones</option>
                <option value="COORDINADOR DE OPERACION">Coordinador de Operación</option>
                <option value="GERENTE DE OPERACION">Gerente de Operación</option>
                <option value="JEFE DE SOPORTE">Jefe de Soporte</option>
                <option value="COORDINADOR DE SOPORTE">Coordinador de Soporte</option>
              </select>
            </p>
          </td>
        </tr>
      </table>
      <div class="container-fluid b-finales">
        <!-- Llamar a la funcion para generar el pdf -->
        <button class="btn morado_boton b-anchof" @click="generarPDF" @touchstart="generarPDF"><span
            :class="[cargar]"></span>Generar PDF</button>
        <button class="btn morado_boton b-anchof" @click="limpiarTodo" @touchstart="limpiarTodo"><span
            class="fa-solid fa-eraser" /> Limpiar formulario</button>
      </div>
      <a href="#" download="" id="link"></a>
    </div>
    <br>
    <div class="container-fluid" align="center">

      <p style="font-size:12px">Derechos reservados MaxJP 2024 1.1</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

import Swal from 'sweetalert2'
import Firma from './Firma.vue'
import { mapState, mapMutations } from 'vuex';


export default {
  components: {
    Firma
  },
  name: 'form-operacion',

  // Recoger los datos del formulario
  data() {
    return {
      form_data: {
        tipo_formulario: 'operacion',
        // Datos basicos de la persona
        nombre_encargado: '',
        documento_encargado: null,
        correo_encargado: '',
        // N° Caso
        n_caso: '',
        // Motivos
        motivo_solicitud: '',
        op_solicitante: '',
        est_entrega_nuevoActivo: '',
        est_recibido_activo: '',
        // Datos del equipos recogido
        data_recogido: [],
        // Datos del equipos entregado
        data_entregado: [],
        // observaciones
        observaciones: '',
        // Firmas
        nombre_gestor: '',
        cargo_operacion: '',
        nombre_operacion: '',
        // Firmas
        firma1: null,
        firma2: null,
        firma3: null,
      },
      // Mostrar un spinner para señalar la carga de la respuesta.
      cargar: 'fa-solid fa-file-pdf',
      // Guardar los gestores de la base de datos.
      cargar1: '',
      // Cargar gestores
      cargar2: '',
    }
  },
  mounted() {
    this.validateActas('operacion');
    this.form_data.observaciones_recogido = 'N/A'
    this.form_data.observaciones_entregado = 'N/A';
    this.cerrarSesionAuto(this.form_data)
    this.getSession();
    this.form_data.nombre_gestor = this.usuario_session[0].nombre_gestor.toUpperCase();

  },
  methods: {
    ...mapMutations(['mostrarComponentes', 'mostrarGestores', 'getSession', 'mostrarCamps', 'cerrarSesionAuto', 'validateActas']),
    generarPDF: async function () {
      this.cargar = 'spinner-border spinner-border-sm';
      if (this.validarInformacion()) {
        this.notificacion(4);
        this.cargar = '';
      } else {
        // Generar la alerta
        this.notificacion(1);
        const firma1 = this.$refs.signaturePad.getSignatureDataUrl();
        const firma2 = this.$refs.signaturePad2.getSignatureDataUrl();
        const firma3 = this.$refs.signaturePad3.getSignatureDataUrl();
        // Recoger las firmas para laravel
        this.form_data.firma1 = firma1;
        this.form_data.firma2 = firma2;
        this.form_data.firma3 = firma3;

        await axios.post('/PDF_OP', this.form_data, {
          responseType: 'blob'
        })
          .then((res) => {
            if (res.status == 200) {
              // Descargar el pdf desde laravel
              var link = document.getElementById('link');
              link.download = (new Date().getDate().toLocaleString() + '_' + (new Date().getMonth() + 1).toString() + '_' + (new Date().getFullYear()).toString() + '_' + new Date().getTime().toString()) + 'OPERACION_' + this.form_data.op_solicitante.toUpperCase() + '.pdf';
              link.href = URL.createObjectURL(res.data);
              link.click();

              URL.revokeObjectURL(link.href);
            } else {
              this.notificacion(2);
            }
          })
          .catch((err) => {
            this.notificacion(2);
          });
      }
      this.cargar = 'fa-solid fa-file-pdf';

    },
    // Agregar los elementos recogidos de la operacion
    agregarRecogidos() {
      try {
        // Validar que los cmapos no esten vacios
        if (this.form_data.serial_recogido != '' && this.form_data.activo_recogido != '') {
          this.form_data.data_recogido.unshift({
            elemento_recogido: this.form_data.elemento_recogido.toUpperCase(),
            serial_recogido: this.form_data.serial_recogido.toUpperCase(),
            activo_recogido: this.form_data.activo_recogido.toUpperCase(),
            observaciones_recogido: this.form_data.observaciones_recogido
          });
          this.form_data.elemento_recogido = '';
          this.form_data.serial_recogido = '';
          this.form_data.activo_recogido = '';
          this.form_data.observaciones_recogido = 'N/A';
        } else {
          this.notificacion(3);
        }
      } catch (err) {
        this.notificacion(3);
      }
    },
    // Quitar elementos recogidos por equivocacion del usuario
    quitarRecogidos(elemento) {
      for (let ind in this.form_data.data_recogido) {
        if (elemento.serial_recogido === this.form_data.data_recogido[ind].serial_recogido) {
          this.form_data.data_recogido.splice(ind, 1);
        }
      }

    },

    // Agregar datos del entragado
    agregarEntregados() {
      try {
        if (this.form_data.serial_entregado !== '' && this.form_data.activo_entregado !== '') {
          this.form_data.data_entregado.unshift(
            {
              elemento_entregado: this.form_data.elemento_entregado.toUpperCase(),
              serial_entregado: this.form_data.serial_entregado.toUpperCase(),
              activo_entregado: this.form_data.activo_entregado.toUpperCase(),
              observaciones_entregado: this.form_data.observaciones_entregado,
            }
          );
          this.form_data.elemento_entregado = '';
          this.form_data.serial_entregado = '';
          this.form_data.activo_entregado = '';
          this.form_data.observaciones_entregado = 'N/A';
        } else {
          this.notificacion(3);
        }

      } catch (err) {
        this.notificacion(3);
      }
    },
    // Quitar elementos entregados
    quitarEntregados(elemento) {
      for (let ind in this.form_data.data_entregado) {
        if (elemento.serial_entregado === this.form_data.data_entregado[ind].serial_entregado) {
          this.form_data.data_entregado.splice(ind, 1);
        }
      }
    },
    // Limpiar todos los campos
    limpiarTodo() {
      this.form_data = {
        // Datos basicos de la persona
        nombre_encargado: '',
        documento_encargado: null,
        correo_encargado: '',
        // N° Caso
        n_caso: '',
        // Motivos
        motivo_solicitud: '',
        op_solicitante: '',
        est_entrega_nuevoActivo: '',
        est_recibido_activo: '',
        // Fecha entrega
        fecha_entrega: '',
        // Datos del equipos recogido
        data_recogido: [],
        // Datos del equipos entregado
        data_entregado: [],
        // observaciones
        observaciones: '',
        // Firmas
        nombre_gestor: '',
        cargo_operacion: '',
        nombre_operacion: '',
        // Firmas
        firma1: null,
        firma2: null,
        observaciones_recogido: 'N/A',
        observaciones_entregado: 'N/A',
      }
    },
    // Retornar un valor booleano para indicar que se puede generar el PDF.
    validarInformacion() {
      if (this.form_data.correo_encargado == '' || this.form_data.documento_encargado == '' || this.form_data.n_caso == '' ||
        this.form_data.est_entrega_nuevoActivo == '' || this.form_data.est_recibido_activo == ''
        || this.form_data.op_solicitante == ''
      ) {
        return true;
      }
      return false;
    },
    // alertas de sweetalert2 
    notificacion(contexto) {
      let datos = {};
      switch (contexto) {
        case 1: // Generar alerta del pdf
          datos = {
            title: '¡Generando PDF!',
            timer: 3000,
            icon: 'success',
            toast: true,
            position: "top-end",
            showConfirmButton: false,
          };
          break;
        case 2: // Generar alerta de error
          datos = {
            title: '¡Oops!',
            text: 'Ha ocurrido un error al generar el pdf',
            icon: 'error',
            toast: true,
            position: "top-end",
            showConfirmButton: false,
          };
          break;
        case 3: // Generar alerta de error al no completar los seriales
          datos = {
            text: 'Llene los campos de serial y activo',
            icon: 'error',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
            position: "top-end",
            showConfirmButton: false,
          };
          break;
        case 4: // Generar alerta de error al no llenar los campos del formulario
          datos = {
            title: '¡Oops!',
            text: '¡Valide los campos del formulario!',
            icon: 'warning',
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
          };
          break;

      }
      Swal.fire(datos);

    },
  },
  computed: {
    ...mapState(['componentes_vuex', 'lista_gestores', 'usuario_session', 'lista_operaciones', 'datos_form'])
  },

}
</script>