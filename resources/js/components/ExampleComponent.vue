<template>
    <div class="container">
        {{titulo}}
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return{
                titulo:'Hola mundo'
                
            }
        }
    }
</script>
