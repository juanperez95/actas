Vue.component('example-component',{ //html
    template: ` 
    <div>
        <h1>{{titulo}}</h1>
    </div>
    `,
    data(){
        return {
            titulo:'este es el titulo'
        }
    }
})


new Vue({
    el:'#app',
    
});




