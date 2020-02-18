<template>
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

</template>

<script>
  import toastr from 'toastr'

  export default {
    mounted() {
      console.log('Component mounted.')
    },


   data () {
    return {
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

 methods:{

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
      //1. Generamos el Evento para enviarselo al componente Padre
      const vehiculo = response.data

      me.$emit('new', vehiculo);
      
      // 2. Vaciamos los campos del Form
      me.vehicle.plate   = '';
      me.vehicle.mark    = '';
      me.vehicle.model   = '';
      me.vehicle.color   = '';
      me.vehicle.comment = '';
      
      //4. Vaciamos el arreglo de errores.
      me.errors = []; //Vaciamos los errores

      //3. Cerramos el MOdal
      $('#form-modal').modal('hide'); //ocultamos el Modal
      $('.modal-backdrop').remove() //Ocultamos el Bckdrop TO-DO
      
      //Avisamos al Usuarios
      toastr.success('Vehiculo creado Correctamente'); //Mensaje al Usuario

      //En caso de que haya errores        
    }).catch(error => {

      //avsamos al usuario
      toastr.error('Ocurrio un error al Insertar');

      //2. Mostramos en consola
      console.log(error);

      //4. Agregamos los errorres al Arreglo de Errores
      me.errors.push(error);

    });
  }, //Fin Funcion de Guardado


  //Funcion de Editado



} 

}
</script>
