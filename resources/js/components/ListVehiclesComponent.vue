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

    <!-- Modal Form -->
 <form method="POST" v-on:submit.prevent="update == 0 ? createVehicle() : updateVehicle()">
  <div class="col-md-4">
    <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default" v-if="update == 0">Insertar Vehiculo</h6>
            <h6 class="modal-title" id="modal-title-default" v-else>Editar Vehiculo</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <!--Body del Modal-->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group input-group-merge">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input class="form-control"
                    placeholder="Placa (Matrícula)" 
                    v-model="vehicle.plate"
                    type="text">
                    <p v-if="errors.length">error </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group input-group-merge">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input class="form-control" placeholder="Color" type="text" v-model="vehicle.color">
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group input-group-merge">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input class="form-control" placeholder="Marca" v-model="vehicle.mark" type="text">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group input-group-merge">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input class="form-control" placeholder="Model" type="text" v-model="vehicle.model">
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="input-group input-group-merge">
                    <input class="form-control" placeholder="Comentario (Opcional)" type="text" v-model="vehicle.comment">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button v-if="update == 0" type="submit" class="btn btn-primary">Insertar</button>
            <button v-else type="submit" class="btn btn-danger">Editar</button>
            <button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
          </div>

          <p v-if="errors.length">
            <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
            <ul>
              <li v-for="error in errors">{{ error }}</li>
            </ul>
          </p>
        </div>
      </div>
    </div>
  </div>
</form> 
<!--End Modal Form-->



  </div>

</template>



<script>
	
	import axios from 'axios'
  import toastr from 'toastr'
  import swal from 'sweetalert';

  export default {
    mounted() {
    $('#form-modal').on("hidden.bs.modal", this.clearFields); // Ejecutamos la funcion de borrado de campos al cerrar modal
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



    //Funcion de Guardado
    createVehicle: function(){
      let me = this;
      let url = 'vehicle';
    axios.post(url, { //Enviamos el Request      
      //Pasamos los datos introducidos a Moayuscula
      plate:   me.vehicle.plate.toUpperCase(),
      mark:    me.vehicle.mark.toUpperCase(),
      model:   me.vehicle.model.toUpperCase(),
      color:   me.vehicle.color.toUpperCase(),
      comment: me.vehicle.comment.toUpperCase(),
    }).then(response => {
      //Limpiamos los camposy cerramos el modal
      me.clearFields();
      //2. Listamos
      me.getVehicles();
      //3. Avisamos al Usuarios
      toastr.success('Vehiculo creado Correctamente'); //Mensaje al Usuario

      //En caso de que haya errores        
    }).catch(error => {
      //1. Avsamos al usuario
      toastr.error('Ocurrio un error al Insertar');
      //2. Mostramos en consola
      console.log(error);
      //3. Agregamos los errorres al Arreglo de Errores
      me.errors.push(error);
    });
  }, //Fin Funcion de Guardado


  //Funcion para Cargas los datos del objeto en el Form

   editVehicle(vehicle){ //Esta función rellena los campos y la variable update, con la tarea que queremos modificar
      let me =this;
      me.update = vehicle.id;
      let url = 'vehicle/'+me.update+'/edit';
      axios.get(url).then(function (response) {
          me.vehicle.plate= response.data.plate;
          me.vehicle.mark= response.data.mark;
          me.vehicle.model= response.data.model;
          me.vehicle.color= response.data.color;
          me.vehicle.comment= response.data.comment;   
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
        //Limpiamos los camposy cerramos el modal
        me.clearFields();
        //2. Listamos
        me.getVehicles();
        //3. Avisamos al Usuarios
        toastr.success('Vehiculo editado Correctamente'); //Mensaje al Usuario        
      }).catch(error => {
        //1. Avsamos al usuario
        toastr.error('Ocurrio un error al Insertar');
        //2. Mostramos en consola
        console.log(error);
        //3. Agregamos los errorres al Arreglo de Errores
        me.errors.push(error);
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
      $('#form-modal').modal('hide'); //ocultamos el Modal
      $('.modal-backdrop').remove() //Ocultamos el Backdrop TO-DO
      let me = this;
        me.vehicle.plate   = '';
        me.vehicle.mark    = '';
        me.vehicle.model   = '';
        me.vehicle.color   = '';
        me.vehicle.comment = '';
        me.update = 0;
        me.errors = []; //Vaciamos los errores
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
