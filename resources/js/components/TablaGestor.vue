<template>
    <div>
        <section>
            <article>
                <button :class="botones" @click="showActasGestorLogin"><i class="fa-solid fa-magnifying-glass"></i>   Mostrar actas</button>
            </article>
        </section>
        <table>
            <thead>
                <tr class="cabeceras_tabla">
                    <th :class="tabla">N° Caso</th>
                    <th :class="tabla">Tipo de acta</th>
                    <th :class="tabla">Fecha de creacion</th>
                    <th :class="tabla">Accion</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="acta in lista_actas" :key="acta.id">
                    <td :class="tabla">{{ acta.numero_caso }}</td>
                    <td :class="tabla">{{ acta.tipo_acta }}</td>
                    <td :class="tabla">{{ acta.fecha_creacion }}</td>
                    <td :class="tabla"><i class="fa-regular fa-file"></i> {{ acta.ruta_pdf }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<style scope>
.cabeceras_tabla th{
    background-color: var(--color_americas);
    color: aliceblue;
}
</style>

<script>
import { mapMutations, mapState } from 'vuex';
import axios from 'axios';

export default {
    data() {
        return {
            lista_actas: [],
        }
    },
    methods: {
        ...mapMutations(['getIDGestor']),
        // Metodo para iniciar la tabla de actas que lleva
        async showActasGestorLogin() {
            await axios.post(`/Actas_de_responsabilidad/Historial/MyDocuments/Show`, { id: this.name_gestor_session })
                .then((res) => {
                    this.lista_actas = res.data;
                })
                .catch(err => {
                    console.log(err)
                })
        }
    },
    computed: {
        ...mapState(['tabla', 'name_gestor_session', 'inputs', 'botones']),
    },
    mounted() {
        this.getIDGestor();
        this.showActasGestorLogin();
    },


}
</script>