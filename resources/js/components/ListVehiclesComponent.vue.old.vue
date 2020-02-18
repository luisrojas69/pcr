<template>


  <!--BODY del Componente-->
  <div class="card">
    <!-- Card header -->
    <div class="card-header border-0">
      <div class="row">
        <div class="col-6">
          <h3 class="mb-0">Vehiculos Registrados</h3>
        </div>
        <div class="col-6 text-right">
          <a href="#" class="btn btn-sm btn-neutral btn-round btn-icon" data-original-title="Insertar Vehiculo" data-toggle="modal" data-target="#form-modal">
            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            <span class="btn-inner--text">Insertar Vehiculo</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Light table -->
    <div class="table-responsive">
      <!--Listado de Items-->
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th>Id</th>
            <th>Placa</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Color</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="vehicle in arrayVehicles" :key="vehicle.id">
            <td>
              <span class="text-muted" v-text="vehicle.id"></span>
            </td>
            <td class="table-user">
              <!--img src="" class="avatar rounded-circle mr-3"-->
              <b v-text="vehicle.plate"></b>
            </td>
            <td>
              <span class="text-muted" v-text="vehicle.mark"></span>
            </td>
            <td>
              <a href="#!" class="font-weight-bold" v-text="vehicle.model"></a>
            </td>
            <td>
              <span class="text-muted" v-text="vehicle.color"></span>
            </td>
            <td class="table-actions">
              <a href="#" class="table-action" data-toggle="modal" data-target="#form-modal" data-original-title="Editar Vehiculo" v-on:click="editVehicle(vehicle)">
                <i class="fas fa-edit"></i>
              </a>
              <a href="#" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="Eliminar Vehiculo" v-on:click.prevent="deleteVehicle(vehicle)">
                <i class="fas fa-trash"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
      <!--End Listado-->

    </div>

<form-vehicle @new="newVehicle"></form-vehicle>

  </div>

</template>



<script>
	
	import axios from 'axios'
  import toastr from 'toastr'
  import swal from 'sweetalert';

  export default {
    mounted() {
    // $('#form-modal').on("hidden.bs.modal", this.clearFields); // Ejecutamos la fncion de borrado de campos al cerrar modal
     this.getVehicles();
   },

   data () {
    return {
      arrayVehicles: [],
      update :0,
      errors: [],
      vehicle:{
        plate: '',
        mark: '',
        model: '',
        color: '',
        status: '1',
        comment: '',
      }
    }
  },

  methods: {

    //Funcion de Listar  
    getVehicles: function(){ 
      alert('Listando Vehiculos');
      let me=this;
      let url = 'get-vehicles';
      axios.get(url).then(response => {
        me.arrayVehicles = response.data;
      }).catch(function(error){
        console.log(error);
        toastr.error('Ocurrio un error al Listar');
        me.errors = error.response.data
      });
    },

     editVehicle(vehicle){ //Esta función rellena los campos y la variable update, con la tarea que queremos modificar
      this.update = vehicle.id
      let me =this;
      let url = 'vehicle/'+me.update+'/edit';
      axios.get(url).then(function (response) {
          me.plate= response.data.plate;
          me.mark= response.data.mark;
          me.model= response.data.model;
          me.color= response.data.color;
          me.comment= response.data.comment;   
      })
      .catch(function (error) {
          toastr.error('Error al Cargar datos');
          console.log(error);
      }); 
  },

    //Funcion para Actualizar Registro
   updateVehicle: function(){
      let me = this;
      let id = me.update;
      let url = 'vehicle/'+id;
      axios.put(url, { //Enviamos el Request
        plate:   me.vehicle.plate.toUpperCase(),
        mark:    me.vehicle.mark.toUpperCase(),
        model:   me.vehicle.model.toUpperCase(),
        color:   me.vehicle.color.toUpperCase(),
        comment: me.vehicle.comment.toUpperCase(),

      }).then(response => {
        me.vehicle.plate   = '';
        me.vehicle.mark    = '';
        me.vehicle.model   = '';
        me.vehicle.color   = '';
        me.vehicle.comment = '';
        me.errors = []; //Vaciamos los errores
        $('#form-modal').modal('hide'); //ocultamos el Modal
        $('.modal-backdrop').remove() //Ocultamos el Bckdrop TO-DO
        toastr.success('Vehiculo editado Correctamente'); //Mensaje al Usuario        
      }).catch(error => {
        toastr.error(error);
        console.log(error);
        me.errors = error.response.data
      });
    },


    //Funcion para Eliminar un Objeto
    deleteVehicle: function(vehicle){
      swal({
        title: "Está Seguro?",
        text: "Está seguro de querer eliminar este Elemento?",
        icon: "warning",
        buttons: ["Cancelar", "Si, Estoy Seguro!"],
        dangerMode: true,
      })
      .then(willDelete => {
        if (willDelete) {
          let me = this;
          var url = 'vehicle/'+vehicle.id;
          axios.delete(url).then(response =>{//ELiminamos
            me.getVehicles();//Listamos
            toastr.success('Vehiculo Eliminado Correctamente');
          }).catch(error => {
            console.log(error);
            me.errors = error.response.data
            toastr.error('Ocurrio un error al Eliminar');
          });
        }
      });
    },


    //Funcion para Limpiar los Campos
    clearFields(){/*Limpia los campos e inicializa la variable update a 0*/
      alert('Limpiando campos y Reseteando todos');
      let me = this;
        me.vehicle.plate   = '';
        me.vehicle.mark    = '';
        me.vehicle.model   = '';
        me.vehicle.color   = '';
        me.vehicle.comment = '';
        me.update = 0;
    },

  },



   //Filtro e Interpolaciones
   filters: {
        upper: function (value) {
            return value.toUpperCase();
        }
    }

}
</script>
