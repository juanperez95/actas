<template>
    <div class="container">
      <img :src="require('@/assets/iconos/americas.png')" alt="Logo" class="logo">
      <h1>Formulario de Retorno de Equipos</h1>
      <h2>Acta de Responsabilidad de Equipos de Trabajo</h2>
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="numeroCaso">Número de Caso:</label>
          <input type="text" id="numeroCaso" v-model="formData.numeroCaso">
        </div> 
  
        <div class="form-group">
          <label for="nombres">Nombre:</label>
          <input type="text" id="nombres" v-model="formData.nombres">
        </div>
  
        <div class="form-group">
          <label for="campana">Campaña:</label>
          <input type="text" id="campana" v-model="formData.campana">
        </div>
  
        <div class="form-group">
          <label for="correoPersonal">Correo Personal:</label>
          <input type="email" id="correoPersonal" v-model="formData.correoPersonal">
        </div>
  
        <div class="form-group">
          <label for="correoJefe">Correo del Jefe:</label>
          <input type="email" id="correoJefe" v-model="formData.correoJefe">
        </div>
  
        <div class="form-group">
          <label for="dispositivo">Dispositivo:</label>
          <select id="dispositivo" v-model="formData.dispositivo" @change="toggleFields">
            <option value="">Seleccione</option>
            <option value="Portatil">Portátil</option>
            <option value="Escritorio">Escritorio</option>
          </select>
        </div>
  
        <div v-if="formData.dispositivo === 'Portatil'" class="section">
          <h2>Detalles del Portátil</h2>
          <div class="form-group">
            <label for="serialDispositivo">Serial del Dispositivo:</label>
            <input type="text" id="serialDispositivo" v-model="formData.serialDispositivo" :disabled="!formData.dispositivo">
          </div>
  
          <div class="form-group">
            <label for="activoDispositivo">Activo del Dispositivo:</label>
            <input type="text" id="activoDispositivo" v-model="formData.activoDispositivo" :disabled="!formData.dispositivo">
          </div>
  
          <div class="form-group">
            <label for="estadoDispositivo">Estado del Dispositivo:</label>
            <select id="estadoDispositivo" v-model="formData.estadoDispositivo" :disabled="!formData.dispositivo">
              <option value="Bueno">Bueno</option>
              <option value="Dañado">Dañado</option>
              <option value="Dado de baja">Dado de baja</option>
            </select>
          </div>
  
          <div class="form-group">
            <label for="diadema">Diadema:</label>
            <select id="diadema" v-model="formData.diadema" @change="toggleFields">
              <option value="No">No</option>
              <option value="Si">Sí</option>
            </select>
          </div>
  
          <div class="form-group">
            <label for="serialDiadema">Serial de la Diadema:</label>
            <input type="text" id="serialDiadema" v-model="formData.serialDiadema" :disabled="formData.diadema !== 'Si'">
          </div>
  
          <div class="form-group">
            <label for="observaciones">Observaciones:</label>
            <textarea id="observaciones" v-model="formData.observaciones" class="full-width"></textarea>
          </div>
        </div>
  
        <div v-if="formData.dispositivo === 'Escritorio'" class="section">
        <h2>Detalles del Escritorio</h2>
        
        <div class="form-group">
            <label for="raton">Ratón:</label>
            <select id="raton" v-model="formData.raton" @change="toggleFields">
            <option value="No">No</option>
            <option value="Si">Sí</option>
            </select>
        </div>

        <div class="form-group">
            <label for="estadoRaton">Estado del Ratón:</label>
            <select id="estadoRaton" v-model="formData.estadoRaton" :disabled="formData.raton !== 'Si'">
            <option value="Bueno">Bueno</option>
            <option value="Dañado">Dañado</option>
            <option value="Dado de baja">Dado de baja</option>
            </select>
        </div>

        <div class="form-group">
            <label for="teclado">Teclado:</label>
            <select id="teclado" v-model="formData.teclado" @change="toggleFields">
            <option value="No">No</option>
            <option value="Si">Sí</option>
            </select>
        </div>

        <div class="form-group">
            <label for="estadoTeclado">Estado del Teclado:</label>
            <select id="estadoTeclado" v-model="formData.estadoTeclado" :disabled="formData.teclado !== 'Si'">
            <option value="Bueno">Bueno</option>
            <option value="Dañado">Dañado</option>
            <option value="Dado de baja">Dado de baja</option>
            </select>
        </div>

        <div class="form-group">
            <label for="camara">Cámara:</label>
            <select id="camara" v-model="formData.camara">
            <option value="No">No</option>
            <option value="Si">Sí</option>
            </select>
        </div>

        <div class="form-group">
            <label for="serialMonitor">Serial del Monitor:</label>
            <input type="text" id="serialMonitor" v-model="formData.serialMonitor">
        </div>

        <div class="form-group">
            <label for="activoMonitor">Activo del Monitor:</label>
            <input type="text" id="activoMonitor" v-model="formData.activoMonitor">
        </div>

        <div class="form-group">
            <label for="estadoMonitor">Estado del Monitor:</label>
            <select id="estadoMonitor" v-model="formData.estadoMonitor">
            <option value="Bueno">Bueno</option>
            <option value="Dañado">Dañado</option>
            <option value="Dado de baja">Dado de baja</option>
            </select>
        </div>

        <div class="form-group">
            <label for="segundoMonitor">¿Segundo Monitor?:</label>
            <select id="segundoMonitor" v-model="formData.segundoMonitor" @change="toggleFields">
            <option value="No">No</option>
            <option value="Si">Sí</option>
            </select>
        </div>

        <div v-if="formData.segundoMonitor === 'Si'">
            <div class="form-group">
            <label for="serialMonitor2">Serial del Segundo Monitor:</label>
            <input type="text" id="serialMonitor2" v-model="formData.serialMonitor2" :disabled="formData.segundoMonitor !== 'Si'">
            </div>

            <div class="form-group">
            <label for="activoMonitor2">Activo del Segundo Monitor:</label>
            <input type="text" id="activoMonitor2" v-model="formData.activoMonitor2" :disabled="formData.segundoMonitor !== 'Si'">
            </div>
        </div>

        <div class="form-group">
            <label for="tieneDiadema">¿Diadema?:</label>
            <select id="tieneDiadema" v-model="formData.tieneDiadema" @change="toggleFields">
            <option value="No">No</option>
            <option value="Si">Sí</option>
            </select>
        </div>

        <div class="form-group">
            <label for="Diademaserial">Serial de la Diadema:</label>
            <input type="text" id="Diademaserial" v-model="formData.Diademaserial" :disabled="formData.tieneDiadema !== 'Si'">
        </div>

        <div class="form-group">
            <label for="observaciones">Observaciones:</label>
            <textarea id="observaciones" v-model="formData.observaciones" class="full-width"></textarea>
        </div>
    </div>
  
        <div class="form-group">
          <label for="firma">Firma:</label>
          <input type="file" id="firma" @change="handleFileUpload">
        </div>
  
        <div class="button-group">
          <button type="submit">Guardar</button>
          <button type="reset" @click="resetForm">Limpiar</button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  import { jsPDF } from 'jspdf';
  
  export default {
    data() {
      return {
        formData: {
          numeroCaso: '',
          nombre: '',
          campana: '',
          correoPersonal: '',
          correoJefe: '',
          dispositivo: '',
          serialDispositivo: '',
          activoDispositivo: '',
          estadoDispositivo: '',
          diadema: 'No',
          serialDiadema: '',
          observaciones: '',
          // Agrega aquí los demás campos del formulario
        },
        firma: null
      };
    },
        methods: {
    toggleFields() {
        // Lógica para habilitar/deshabilitar campos según las selecciones
        if (this.formData.dispositivo === 'Portatil') {
        this.formData.raton = 'No';
        this.formData.teclado = 'No';
        } else if (this.formData.dispositivo === 'Escritorio') {
        this.formData.diadema = 'No';
        }

        // Habilitar/deshabilitar campos según selecciones
        this.$nextTick(() => {
        document.getElementById('serialDispositivo').disabled = !this.formData.dispositivo;
        document.getElementById('activoDispositivo').disabled = !this.formData.dispositivo;
        document.getElementById('estadoDispositivo').disabled = !this.formData.dispositivo;
        document.getElementById('serialDiadema').disabled = this.formData.diadema !== 'Si';
        if (this.formData.dispositivo === 'Escritorio') {
            document.getElementById('estadoRaton').disabled = this.formData.raton !== 'Si';
            document.getElementById('estadoTeclado').disabled = this.formData.teclado !== 'Si';
            document.getElementById('serialMonitor2').disabled = this.formData.segundoMonitor !== 'Si';
            document.getElementById('activoMonitor2').disabled = this.formData.segundoMonitor !== 'Si';
        }
        });
    },

    async submitForm() {
        // Aquí iría la lógica para enviar el formulario al backend
        try {
        const formData = new FormData();
        Object.keys(this.formData).forEach(key => {
            formData.append(key, this.formData[key]);
        });
        formData.append('firma', this.firma);

        const response = await axios.post('/api/devolucion-equipo', formData, {
            headers: {
            'Content-Type': 'multipart/form-data'
            }
        });

        if (response.status === 201) {
            alert('Formulario enviado con éxito');
            this.generarPDF();
        }
        } catch (error) {
        console.error('Error al enviar el formulario:', error);
        alert('Hubo un error al enviar el formulario');
        }
    },

    resetForm() {
        // Reiniciar todos los campos del formulario
        Object.keys(this.formData).forEach(key => {
        if (typeof this.formData[key] === 'boolean') {
            this.formData[key] = false;
        } else if (key === 'dispositivo' || key === 'diadema') {
            this.formData[key] = '';
        } else if (key === 'pantallas') {
            this.formData[key] = 1;
        } else {
            this.formData[key] = '';
        }
        });
        this.firma = null;
        this.$nextTick(this.toggleFields);
    },

    generarPDF() {
        const doc = new jsPDF();
        
        // Agregar contenido al PDF
        doc.setFontSize(16);
        doc.text('Formulario de Retorno de Equipos', 10, 10);
        doc.setFontSize(12);
        doc.text(`Número de Caso: ${this.formData.numeroCaso}`, 10, 20);
        doc.text(`Nombres: ${this.formData.nombres}`, 10, 30);
        doc.text(`Apellidos: ${this.formData.apellidos}`, 10, 40);
        doc.text(`Campaña: ${this.formData.campana}`, 10, 50);
        doc.text(`Correo Personal: ${this.formData.correoPersonal}`, 10, 60);
        doc.text(`Correo del Jefe: ${this.formData.correoJefe}`, 10, 70);
        doc.text(`Dispositivo: ${this.formData.dispositivo}`, 10, 80);

        if (this.formData.dispositivo === 'Portatil') {
        doc.text(`Serial del Dispositivo: ${this.formData.serialDispositivo}`, 10, 90);
        doc.text(`Activo del Dispositivo: ${this.formData.activoDispositivo}`, 10, 100);
        doc.text(`Estado del Dispositivo: ${this.formData.estadoDispositivo}`, 10, 110);
        doc.text(`Diadema: ${this.formData.diadema}`, 10, 120);
        doc.text(`Serial de la Diadema: ${this.formData.serialDiadema}`, 10, 130);
        } else if (this.formData.dispositivo === 'Escritorio') {
        doc.text(`Ratón: ${this.formData.raton}`, 10, 90);
        doc.text(`Estado del Ratón: ${this.formData.estadoRaton}`, 10, 100);
        doc.text(`Teclado: ${this.formData.teclado}`, 10, 110);
        doc.text(`Estado del Teclado: ${this.formData.estadoTeclado}`, 10, 120);
        doc.text(`Serial del Monitor: ${this.formData.serialMonitor}`, 10, 130);
        doc.text(`Activo del Monitor: ${this.formData.activoMonitor}`, 10, 140);
        doc.text(`Estado del Monitor: ${this.formData.estadoMonitor}`, 10, 150);
        doc.text(`Segundo Monitor: ${this.formData.segundoMonitor}`, 10, 160);
        if (this.formData.segundoMonitor === 'Si') {
            doc.text(`Serial del Segundo Monitor: ${this.formData.serialMonitor2}`, 10, 170);
            doc.text(`Activo del Segundo Monitor: ${this.formData.activoMonitor2}`, 10, 180);
        }
        doc.text(`Cámara: ${this.formData.camara}`, 10, 190);
        }

        doc.text(`Observaciones: ${this.formData.observaciones}`, 10, 200);

        doc.save('formulario_retorno_equipos.pdf');
        }
    }
  };
  </script>
  
  <style scoped>
  /* Estilos CSS aquí */
  </style>