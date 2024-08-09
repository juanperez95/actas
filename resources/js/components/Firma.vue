<template>
  <div>
    <canvas
      id="signature-pad"
      ref="signaturePad"
      width="540"
      height="100"
    ></canvas
    ><br />
    <h6 :class="[color_label,'mb-1']">{{firma_d}}: <b>{{Nombre_de_quien_entrega ? Nombre_de_quien_entrega.toUpperCase() : ''}}</b></h6>
    <p v-if="cargo_persona !== ''" :class="color_label">Cargo: <b>{{cargo_persona}}</b></p>
    <button type="button" @click="clearSignature" :class="botones">Borrar</button>
  </div>
</template>
  
  <script>
import { mapState,mapMutations } from 'vuex';

  

export default {
  props: ["firma_d", "Nombre_de_quien_entrega",'cargo_persona'],
  data() {
    return {
      drawing: false,
      ctx: null,
    };
  },
  mounted() {
    const canvas = this.$refs.signaturePad;
    this.ctx = canvas.getContext("2d");
    canvas.addEventListener("mousedown", this.startDrawing);
    canvas.addEventListener("mousemove", this.draw);
    canvas.addEventListener("mouseup", this.stopDrawing);
    canvas.addEventListener("mouseout", this.stopDrawing);
    canvas.addEventListener("touchstart", this.startDrawing);
    canvas.addEventListener("touchmove", this.draw);
    canvas.addEventListener("touchend", this.stopDrawing);
    canvas.addEventListener("touchcancel", this.stopDrawing);
  },
  methods: {
    
    getPointerPos(evt) {
      const canvas = this.$refs.signaturePad;
      const rect = canvas.getBoundingClientRect();
      const clientX = evt.clientX || evt.touches[0].clientX;
      const clientY = evt.clientY || evt.touches[0].clientY;
      return {
        x: clientX - rect.left,
        y: clientY - rect.top,
      };
    },
    startDrawing(evt) {
      this.drawing = true;
      const pos = this.getPointerPos(evt);
      this.ctx.moveTo(pos.x, pos.y);
      evt.preventDefault();
    },
    draw(evt) {
      if (!this.drawing) return;
      const pos = this.getPointerPos(evt);
      this.ctx.lineTo(pos.x, pos.y);
      this.ctx.stroke();
      evt.preventDefault();
    },
    stopDrawing() {
      this.drawing = false;
      this.ctx.beginPath();
    },
    clearSignature() {
      const canvas = this.$refs.signaturePad;
      this.ctx.clearRect(0, 0, canvas.width, canvas.height);
    },
    getSignatureDataUrl() {
      const canvas = this.$refs.signaturePad;
      return canvas.toDataURL("image/png");
    },
  },
  computed: {
    ...mapState(['botones','color_label']),
  },
  
};
</script>
  
<style>
#signature-pad {
  border: 1px solid #000;
  touch-action: none;
}

</style>
  