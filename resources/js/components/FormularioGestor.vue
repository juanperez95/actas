<template>
  <div>
    <div id="gestores">
      <p>
        Señor
        <input type="text" placeholder="Ingrese el nombre" v-model="form_data.nombre_persona"/>
      </p>
      <p>
        CC.
        <input type="text" placeholder="Ingrese el número de CC" v-model="form_data.documento_persona"/>
      </p>
      <p>
        Correo:
        <input type="email" placeholder="Ingrese el correo" v-model="form_data.correo_persona"/>
      </p>
      <p>
        Respetada Señor
        <b>{{form_data.nombre_persona.toUpperCase()}}</b>
      </p>
      <p>
        El presente formato se tiene con fin de entregar la responsabilidad del activo solicitado al gestor
        <input type="text" placeholder="Ingrese el gestor" v-model="form_data.nombre_gestor"/>
      </p>
      <p>Definiciones:</p>
      <ul>
        <li>
          Motivo de Solicitud
          <input type="text" placeholder="Ingrese el motivo" v-model="form_data.motivo_solicitud"/>
        </li>
        <li>
          Operación Solicitante
          <input type="text" placeholder="Ingrese la operación" class="form-select" v-model="form_data.op_solicitante" list="listaOp"/>
          
          <datalist id="listaOp">
            <option value="ANM AGENCIA NACIONAL DE MINERÍA">ANM AGENCIA NACIONAL DE MINERÍA</option>
            <option value="BANCAMIACOBRANZAS">BANCAMIACOBRANZAS</option>
            <option value="BANCAMIASAC">BANCAMIASAC</option>
            <option value="BIENESTAR IPS">BIENESTAR IPS</option>
            <option value="CAFAM">CAFAM</option>
            <option value="CARVAJAL EBUSINESS">CARVAJAL EBUSINESS</option>
            <option value="CARVAJAL IDC">CARVAJAL IDC</option>
            <option value="CARVAJAL S.A LINEA 25000">CARVAJAL S.A LINEA 25000</option>
            <option value="CARVAJAL TECNOLOGÍA Y SERVICIOS S.A.S">CARVAJAL TECNOLOGÍA Y SERVICIOS S.A.S</option>
            <option value="CHILCO">CHILCO</option>
            <option value="CODENSA">CODENSA</option>
            <option value="COMFAMA CARVAJAL">COMFAMA CARVAJAL</option>
            <option value="COMFANDI">COMFANDI</option>
            <option value="COMPENSAR">COMPENSAR</option>
            <option value="CREDIBANCO S.A">CREDIBANCO S.A</option>
            <option value="CREDIVALORES">CREDIVALORES</option>
            <option value="CRUZ ROJA">CRUZ ROJA</option>
            <option value="DERCO">DERCO</option>
            <option value="ECOPETROL S.A">ECOPETROL S.A</option>
            <option value="ENDESA">ENDESA</option>
            <option value="ETBCOBRANZAS">ETBCOBRANZAS</option>
            <option value="ETBRETENCIONES">ETBRETENCIONES</option>
            <option value="EXPERIAN">EXPERIAN</option>
            <option value="FACTURA ELECTRONICA">FACTURA ELECTRONICA</option>
            <option value="FAMISANAR">FAMISANAR</option>
            <option value="FISCALIA">FISCALIA</option>
            <option value="GERENCIA COMERCIAL">GERENCIA COMERCIAL</option>
            <option value="GERENCIA FINANCIERA Y ADMINISTRATIVA">GERENCIA FINANCIERA Y ADMINISTRATIVA</option>
            <option value="GERENCIA GENERAL">GERENCIA GENERAL</option>
            <option value="GERENCIA GESTIÓN HUMANA">GERENCIA GESTIÓN HUMANA</option>
            <option value="GERENCIA GESTIÓN HUMANA DESARROLLO Y CULTURA">GERENCIA GESTIÓN HUMANA DESARROLLO Y CULTURA</option>
            <option value="GERENCIA GESTIÓN HUMANA FORMACIÓN">GERENCIA GESTIÓN HUMANA FORMACIÓN</option>
            <option value="GERENCIA GESTIÓN HUMANA NOMINA">GERENCIA GESTIÓN HUMANA NOMINA</option>
            <option value="GERENCIA TECNOLOGÍA">GERENCIA TECNOLOGÍA</option>
            <option value="GERENCIA TECNOLOGÍASEGURIDAD DE LA INFORMACIÓN">GERENCIA TECNOLOGÍASEGURIDAD DE LA INFORMACIÓN</option>
            <option value="GERENCIA TRANSFORMACIÓN DIGITAL Y DISEÑO DEL SERVICIO">GERENCIA TRANSFORMACIÓN DIGITAL Y DISEÑO DEL SERVICIO</option>
            <option value="GERENCIA UNIDAD DE DESARROLLO DE NUEVOS NEGOCIOS">GERENCIA UNIDAD DE DESARROLLO DE NUEVOS NEGOCIOS</option>
            <option value="GERENCIA WORKFORCE MANAGEMENT">GERENCIA WORKFORCE MANAGEMENT</option>
            <option value="GERENCIA WORKFORCE MANAGEMENT CIENCIA DE DATOS">GERENCIA WORKFORCE MANAGEMENT CIENCIA DE DATOS</option>
            <option value="GERENCIA WORKFORCE MANAGEMENT EXPERIENCIA AL CLIENTE">GERENCIA WORKFORCE MANAGEMENT EXPERIENCIA AL CLIENTE</option>
            <option value="GERENCIA WORKFORCE MANAGEMENT INTELIGENCIA DE NEGOCIOS">GERENCIA WORKFORCE MANAGEMENT INTELIGENCIA DE NEGOCIOS</option>
            <option value="GERENCIA WORKFORCE MANAGEMENT WFM">GERENCIA WORKFORCE MANAGEMENTWFM</option>
            <option value="GRUPO AVAL">GRUPO AVAL</option>
            <option value="GRUPO AVALBANCO DE BOGOTÁCOBRANZAS">GRUPO AVALBANCO DE BOGOTÁ COBRANZAS</option>
            <option value="GRUPO AVALBANCO DE BOGOTÁSAC">GRUPO AVALBANCO DE BOGOTÁ SAC</option>
            <option value="GRUPO AVALBANCO DE OCCIDENTE">GRUPO AVALBANCO DE OCCIDENTE</option>
            <option value="GRUPO AVALBANCO POPULAR">GRUPO AVALBANCO POPULAR</option>
            <option value="HERO MOTOCORP">HERO MOTOCORP</option>
            <option value="HP HEWLETT PACKARD">HP HEWLETT PACKARD</option>
            <option value="ICETEX">ICETEX</option>
            <option value="ILANS">ILANS</option>
            <option value="ITAU">ITAU</option>
            <option value="ITAU COBRANZAS">ITAUCOBRANZAS</option>
            <option value="JAVESALUD">JAVESALUD</option>
            <option value="MEDERI">MEDERI</option>
            <option value="MINISTERIO DE CULTURA">MINISTERIO DE CULTURA</option>
            <option value="MINISTERIO DE SALUD Y PROTECCIÓN SOCIAL">MINISTERIO DE SALUD Y PROTECCIÓN SOCIAL</option>
            <option value="MINISTERIO DEL TRABAJO">MINISTERIO DEL TRABAJO</option>
            <option value="MULTICAMPAÑAS">MULTICAMPAÑAS</option>
            <option value="NUEVA EPS">NUEVA EPS</option>
            <option value="NUEVA EPSCLIENTE NUEVA EPS">NUEVA EPSCLIENTE NUEVA EPS</option>
            <option value="POSITIVA">POSITIVA</option>
            <option value="PROCERASEO SAS">PROCERASEO SAS</option>
            <option value="QCL AUDITORES SERVISALUD">QCL AUDITORES SERVISALUD</option>
            <option value="QNT">QNT</option>
            <option value="RED DE PAGOS">RED DE PAGOS</option>
            <option value="SECRETARIA DE HACIENDA">SECRETARIA DE HACIENDA</option>
            <option value="SEGUROS EQUIDAD">SEGUROS EQUIDAD</option>
            <option value="SERVINFORMBACKOFFICE">SERVINFORM BACKOFFICE</option>
            <option value="SERVINFORMPOWEN">SERVINFORM POWEN</option>
            <option value="SODEXO">SODEXO</option>
            <option value="SOS EPS">SOS EPS</option>
            <option value="SUPERINTENDENCIA DE TRANSPORTE">SUPERINTENDENCIA DE TRANSPORTE</option>
            <option value="SUPERSALUD SUPERINTENDENCIA NACIONAL DE SALUD">SUPERSALUD SUPERINTENDENCIA NACIONAL DE SALUD</option>
            <option value="UGPP NORMALIZACIÓN">UGPP NORMALIZACIÓN</option>
            <option value="UGPP UT">UGPP UT</option>
            <option value="UPRESS">UPRESS</option>
            <option value="VERTIV">VERTIV</option>
            <option value="WOM">WOM</option>
          </datalist>
        </li>
      </ul>
      <p>
        Fecha de entrega del activo:
        <input type="date" v-model="form_data.fecha_entregaActivo"/>
      </p>
      <p>Activos relacionados:</p>
      <table>
        <tr>
          <th>Elemento</th>
          <th>Serial</th>
          <th>Activo</th>
          <th>Observaciones</th>
          <th>Acciones</th>
        </tr>
        <tr>
          <td>
            <select name="" id="" class="form-select" v-model="form_data.ingreso_elemento">
              <option value="Torre">Torre</option>
              <option value="Diadema">Diadema</option>
              <option value="Monitor">Monitor</option>
              <option value="Minitorre">Minitorre</option>
            </select>
          </td>
          <td>
            <input type="text" placeholder="Ingrese el serial" v-model="form_data.serial_elemento"/>
          </td>
          <td>
            <input type="text" placeholder="Ingrese el activo" v-model="form_data.activo_elemento"/>
          </td>
          <td>
            <input type="text" placeholder="Ingrese las observaciones" v-model="form_data.observaciones_elemento" @keyup.enter="agregarElementos"/>
          </td>
          <td>
            <button class="btn btn-danger" @click="agregarElementos">Agregar</button>
          </td>
        </tr>
      </table>

      <!-- Lista de elementos agregados -->

      <div class="container p-3">
        <table class="table">
          <thead>
            <tr>
              <th>Elemento</th>
              <th>N° Serial</th>
              <th>N° Activo</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="data in form_data.data_elemento" :key="data.id">
              <td scope="col">{{data.ingreso_elemento.toUpperCase()}}</td>
              <td scope="col">{{data.serial_elemento.toUpperCase()}}</td>
              <td scope="col">{{data.activo_elemento.toUpperCase()}}</td>
              <td scope="col">
                <button class="btn btn-danger" @click="quitarElementos(data)">x</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <p>
        Observación:
        <textarea placeholder="Ingrese la observación" v-model="form_data.observaciones"></textarea>
      </p>
      <p>Con la firma de esta acta el gestor que solicita el elemento se hará responsable de este en su totalidad hasta que sea entregada a la operación la cual deberá de ser certificada por un acta de entrega similar, firmada por la operación y cargada a GLPI.</p>
      <hr>
      <div class="container firmas">
        <Firma ref="signaturePad" firma_d="Firma de quien entrega" class="mb-3"></Firma>
        <Firma ref="signaturePad2" firma_d="Firma de quien recibe" class="mb-3"></Firma>
      </div>
      <table>
        <tr>
          <td>
            <p>
              Gestor de Soluciones Tecnológica</p>
            <p>
              Nombre:
              <b>{{form_data.nombre_persona.toUpperCase()}}</b>
            </p>
          </td>
          <td>
            <p>Gestor de Soluciones Tecnológica</p>
            <p>
              Nombre:
              <b>{{form_data.nombre_gestor.toUpperCase()}}</b>
            </p>
          </td>
        </tr>
      </table>
    </div>
    <div class="container-fluid b-finales">
      <button class="btn btn-danger mt-2 b-anchof" @click="generarPDFGestor">Generar PDF</button>
      <button class="btn btn-danger mt-2 b-anchof" @click="limpiarTodo">Limpiar Formulario</button>
    </div>

    <a href="" download="" id="enlace"></a>
    <br>
    <div class="container-fluid" align="center">

      <p style="font-size:12px">Derechos reservados MaxJP 2024</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import Firma from './Firma.vue';
export default {

  name: "formulario-gestor",
  components:{
    Firma,
  },
  data(){
    return {
      form_data:{
        // Datos basicos
        nombre_persona:'',
        documento_persona:'',
        correo_persona:'',
        // Nombre gestor
        nombre_gestor:'',
        // Motivos
        motivo_solicitud:'',
        op_solicitante:'',
        fecha_entregaActivo:'',
        observaciones:'',
        // Nombre de quien entrega e elemento
        nombre_deEntrega:'',
        // Datos de elemento
        data_elemento:[],
        // Firmas de quien entrega y de quien recibe
        firma1:null,
        firma2:null,
      }
    }
  },
  methods: {
    generarPDFGestor: async function(){
      if(this.validarInformacion()){
        this.notificacion(4);
      }else{
        // Generar la alerta
        this.notificacion(1);
  
        // Asignar firmas a laravel
        this.form_data.firma1 = this.$refs.signaturePad.getSignatureDataUrl();
        this.form_data.firma2 = this.$refs.signaturePad2.getSignatureDataUrl();
  
        await axios.post('/PDF_G',this.form_data,{
          responseType:'blob'
        })
        .then((res)=>{
          if(res.status == 200){
            var enlace = document.getElementById('enlace');
            enlace.download = (new Date().getDate().toLocaleString() +'_'+ (new Date().getMonth()+1).toString() +'_'+ (new Date().getFullYear()).toString() + '_' + new Date().getTime().toString()) + '_GESTOR_' + this.form_data.nombre_gestor.toUpperCase() + '.pdf';
            enlace.href = URL.createObjectURL(res.data);
            enlace.click();
            URL.revokeObjectURL(enlace.href);
          }else{
            this.notificacion(2);
          }
        }).catch((err)=>{
          this.notificacion(2);
        })
      }
    },
    agregarElementos(){
      try{
        if(this.form_data.serial_elemento != '' && this.form_data.activo_elemento != ''){
          this.form_data.data_elemento.unshift(
            {
              // Datos de elementos y observaciones
              ingreso_elemento:this.form_data.ingreso_elemento.toUpperCase(),
              serial_elemento:this.form_data.serial_elemento.toUpperCase(),
              activo_elemento:this.form_data.activo_elemento.toUpperCase(),
              observaciones_elemento:this.form_data.observaciones_elemento,
            }  
          );
          this.form_data.ingreso_elemento = '';
          this.form_data.serial_elemento = '';
          this.form_data.activo_elemento = '';
          this.form_data.observaciones_elemento = 'N/A';
        }
      }catch(err){
        this.notificacion(3);
      }
    },
    quitarElementos(elemento){
      for(let elem in this.form_data.data_elemento){
        if(elemento.serial_elemento === this.form_data.data_elemento[elem].serial_elemento){
          this.form_data.data_elemento.splice(elem,1);
        }
      }
    },
    limpiarTodo(){
      this.form_data = {
        // Datos basicos
        nombre_persona:'',
        documento_persona:'',
        correo_persona:'',
        // Nombre gestor
        nombre_gestor:'',
        // Motivos
        motivo_solicitud:'',
        op_solicitante:'',
        fecha_entregaActivo:'',
        observaciones:'',
        // Nombre de quien entrega e elemento
        nombre_deEntrega:'',
        // Datos de elemento
        data_elemento:[],
        // Firmas de quien entrega y de quien recibe
        firma1:null,
        firma2:null,
      }
    },
    validarInformacion(){
      if(this.form_data.correo_persona == '' || this.form_data.fecha_entregaActivo == ''
        || this.form_data.nombre_persona == '' || this.form_data.op_solicitante == '' || this.form_data.documento_persona == ''
        || this.form_data.nombre_gestor == '' || this.form_data.data_elemento == []
      ){
        return true
      }
      return false
    },
    // alertas de sweetalert2 
    notificacion(contexto){
          let datos = {};
          switch (contexto) {
            case 1: // Generar alerta del pdf
              datos = {
                title:'¡Generando PDF!',
                timer:2000,
                imageUrl: 'https://play-lh.googleusercontent.com/9XKD5S7rwQ6FiPXSyp9SzLXfIue88ntf9sJ9K250IuHTL7pmn2-ZB0sngAX4A2Bw4w',
                imageHeight: 180,
              };
              break;
            case 2: // Generar alerta de error
              datos = {
                title:'¡Oops!',
                text:'Ha ocurrido un error al generar el pdf',
                icon:'error',
              };
              break;
            case 3: // Generar alerta de error al no completar los seriales
              datos = {
                text:'Llene los campos de serial y activo',
                icon:'error',
                position:"top-end",
                showConfirmButton: false,
                timer:1000,
              };
            break;
            case 4: // Generar alerta de error al no llenar los campos del formulario
              datos = {
                title:'¡Oops!',
                text:'¡Valide los campos del formulario!',
                icon:'warning',
              };
            break;
            
          }
          Swal.fire(datos);
    },

  },
  mounted(){
    this.form_data.observaciones_elemento = 'N/A'
  },
};
</script>
