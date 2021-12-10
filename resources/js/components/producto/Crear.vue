<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Crear Producto</h4></div>
                <div class="card-body">
                    <form @submit.prevent="crear">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Título</label>
                                    <input type="text" class="form-control" v-model="producto.title">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-floating">
                                    <textarea class="form-control" id="floatingTextarea2" v-model="producto.description" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Descripcion</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"crear-producto",
    data(){
        return {
            producto:{
                title:"", 
                description:""
            }
        }
    },
    methods:{
        async crear(){
            await this.axios.post('/api/producto',this.producto).then(response=>{
                this.$router.push({name:"mostrarProductos"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>