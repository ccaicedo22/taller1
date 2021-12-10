<template>
    <div class="row">
        <div class="col-12 mb-2">
            <!-- llamamos al componente para Crear   -->
            <router-link :to='{name:"crearProducto"}' class="btn btn-success"><i class="fas fa-plus-circle"></i></router-link>
        </div>
        <div class="col-12">             
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Descripcion</th>
                                    <th>Slug</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="producto in productos" :key="producto.id">
                                    <td>{{ producto.id }}</td>
                                    <td>{{ producto.title }}</td>
                                    <td>{{ producto.description }}</td>
                                    <td>{{ producto.slug }}</td>
                                    <td>
                                       
                                        <router-link :to='{name:"editarProducto",params:{id:producto.id}}' class="btn btn-info"><i class="fas fa-edit"></i></router-link>
                                        <a type="button" @click="borrarProducto(producto.id)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>                          
        </div>
    </div>
</template>

<script>
export default {
    name:"productos",
    data(){
        return {
            productos:[]
        }
    },
    mounted(){
        this.mostrarProductos()
    },
    methods:{
        async mostrarProductos(){
            await this.axios.get('/api/producto').then(response=>{
                this.productos = response.data
            }).catch(error=>{
                console.log(error)
                this.productos = []
            })
        },
        borrarProducto(id){
            if(confirm("¿Confirma eliminar el registro?")){
                this.axios.delete(`/api/producto/${id}`).then(response=>{
                    this.mostrarProductos()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>