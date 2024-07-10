<template>
    <div>
      
        <li v-for="item in paginatedItems" :key="item.id"> 
          <!-- Analizar los datos que se paginaran -->
          {{ item.nombre }}: {{item.id}} 
        </li>

        
      <div class="p-2" style="display:flex; justify-content:space-between">
        <button @click="previousPage" class="btn btn-outline-danger" :disabled="currentPage === 1">Anterior</button>
        <button @click="nextPage" class="btn btn-outline-danger" :disabled="currentPage === totalPages">Siguiente</button>
      </div>

    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        items: [], // Aquí se almacenan todos los elementos
        currentPage: 1,
        itemsPerPage: 5 // Número de elementos por página
      };
    },
    computed: {
      // Calcula los elementos para la página actual
      paginatedItems() {
        const startIndex = (this.currentPage - 1) * this.itemsPerPage;
        return this.items.slice(startIndex, startIndex + this.itemsPerPage);
      },
      // Calcula el número total de páginas
      totalPages() {
        return Math.ceil(this.items.length / this.itemsPerPage);
      }
    },
    methods: {
      previousPage() {
        if (this.currentPage > 1) {
          this.currentPage--;
        }
      },
      nextPage() {
        if (this.currentPage < this.totalPages) {
          this.currentPage++;
        }
      }
    }
  };
  </script>
  