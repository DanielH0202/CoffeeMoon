<template>
  <div>
    <div class="header bg-gradient-warning pt-5 pt-md-6">
      <div class="container-fluid">
        <!--Header-->

        <div class="header pb-6">
          <div class="container-fluid">
            <div class="header-body">
              <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                  <h6 class="h2 text-white d-inline-block mb-0">Sucursales</h6>
                  <nav
                    aria-label="breadcrumb"
                    class="d-none d-md-inline-block ml-md-4"
                  >
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                      <li class="breadcrumb-item">
                        <a><i class="fas fa-home"></i></a>
                      </li>
                      <li class="breadcrumb-item"><a>Inicio</a></li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Sucursales
                      </li>
                    </ol>
                  </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                  <button
                    type="button"
                    class="btn btn-sm btn-neutral"
                    @click="nuevoNegocio()"
                    data-toggle="modal"
                    data-target="#modal-form"
                    id="nuevoNegocio"
                  >
                    <i class="fas fa-plus"></i> Nueva Sucursal
                  </button>
                  <button
                    type="button"
                    class="btn btn-sm btn-neutral"
                    @click="obtenerNegocios"
                  >
                    Recargar Sucursal
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--CONTENIDO-->

    <div class="col-md-4">
      <!--<button
        type="button"
        class="btn btn-block btn-default"
        data-toggle="modal"
        data-target="#modal-form"
      >
        Registrar Negocio
      </button>-->
      <div
        class="modal fade"
        id="modal-form"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modal-form"
        aria-hidden="true"
      >
        <div
          class="modal-dialog modal- modal-dialog-centered modal-lg"
          role="document"
        >
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-12 py-lg-12">
                  <h6 class="h2 text-black m-auto display-4 text-center">
                    Registrar nueva sucursal
                  </h6>
                  <form>
                    <!--<div class="alert alert-success" role="alert">
                      <strong>Completado!</strong> {{ v_error }}
                    </div>-->

                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            placeholder="Nombre"
                            v-model="negocio.name"
                          />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Telefono"
                            class="form-control"
                            id="telefono"
                            v-model="negocio.telefono"
                          />
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Correo"
                            class="form-control"
                            id="correo"
                            v-model="negocio.email"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="password"
                            placeholder="Contraseña"
                            class="form-control"
                            id="password"
                            name="password"
                            v-model="negocio.password"
                          />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input
                            type="password"
                            placeholder="Confirmar Contraseña"
                            class="form-control"
                            name="password_confirmation"
                            id="password_confirmation"
                            v-model="negocio.password_confirmation"
                          />
                        </div>
                      </div>                                 

                      <div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="time"
                            placeholder="Hora de Apertura"
                            class="form-control"
                            id="horaApertura"
                            v-model="negocio.horaApertura"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="time"
                            placeholder="Hora de Cierre"
                            class="form-control"
                            id="horaCierre"
                            v-model="negocio.horaCierre"
                          />
                        </div>
                      </div>

                    <div class="col-md-3">
                    <div class="form-group">
                    
                                          
                        <select class="form-control" v-model="negocio.tipoUser">
                         <option selected disabled>Selecionar tipo de usuario</option>
                        <!--<option class="form-control" value="0">Cliente</option>-->
                        <!--<option class="form-control" value="1">Repartidor</option>-->
                        <option class="form-control" value="2">Sucursal</option>-->
                          </select>
                        </div>
                       </div>
                       

                      

                      <div class="col-md-12">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Descripcion"
                            class="form-control"
                            id="descripcion"
                            v-model="negocio.descripcion"
                          />
                        </div>
                      </div>
                    </div>
                    <button
                      type="button"
                      class="btn btn-danger btn-lg"
                      data-dismiss="modal"
                      @click="guardarNegocio"
                    >
                      Registrar
                    </button>
                    <button
                      type="button"
                      class="btn btn-link ml-auto"
                      data-dismiss="modal"
                    >
                      Cerrar
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div
        class="modal fade"
        id="modal-form-editar"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modal-form"
        aria-hidden="true"
      >
        <div
          class="modal-dialog modal- modal-dialog-centered modal-lg"
          role="document"
        >
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-12 py-lg-12">
                  <h6 class="h2 text-black m-auto display-4 text-center">
                    Editar Negocio
                  </h6>
                  <form>
                    <!--<div class="alert alert-success" role="alert">
                      <strong>Completado!</strong> {{ v_error }}
                    </div>-->

                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            placeholder="Nombre"
                            v-model="negocio.name"
                          />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Telefono"
                            class="form-control"
                            id="telefono"
                            v-model="negocio.telefono"
                          />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Correo"
                            class="form-control"
                            id="correo"
                            v-model="negocio.email"
                          />
                        </div>
                      </div>

                      
                      
                      <div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="time"
                            placeholder="Hora de Apertura"
                            class="form-control"
                            id="horaApertura"
                            v-model="negocio.horaApertura"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="time"
                            placeholder="Hora de Cierre"
                            class="form-control"
                            id="horaCierre"
                            v-model="negocio.horaCierre"
                          />
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Descripcion"
                            class="form-control"
                            id="descripcion"
                            v-model="negocio.descripcion"
                          />
                        </div>
                      </div>                   
                                  
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="password"></label><br>
                          
                          
                          <input
                            type="password"
                            placeholder="Actualizar Contraseña"
                            class="form-control"
                            id="password"
                            name="password"
                            v-model="negocio.password"
                            
                          />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="password_confirmation"></label><br>
                          <input
                            type="password"
                            placeholder="Confirmar Contraseña"
                            class="form-control"
                            name="password_confirmation"
                            id="password_confirmation"
                            v-model="negocio.password_confirmation"
                            
                          />
                          <input type="checkbox" id="actualizarPasswordCheck">
                          <label for="actualizarPasswordCheck"><small> si deseas actualizar</small></label>
                        </div>
                      </div>
                      <!--<div class="col-md-4">
                        <div class="form-group">
                          <label for="password_confirmation"></label>
                          
                          <input
                            type="password"
                            placeholder="Confirmar Contraseña"
                            class="form-control"
                            name="passwordValitadion"
                            id="passwordValitadion"
                            v-model="negocio.passwordValitadion"
                            
                          />
                          
                        </div>
                      </div>-->
                    </div>
                    <button
                      type="button"
                      class="btn btn-danger btn-lg"
                      data-dismiss="modal"
                      @click="guardarNegocio"
                    >
                      Actualizar
                    </button>
                    <button
                      type="button"
                      class="btn btn-link ml-auto"
                      data-dismiss="modal"
                    >
                      Cerrar
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div>
      <div class="container-fluid mt--7">
        <div class="row">
          <div class="col">
            <div class="card bg-secondary shadow">
              <div class="table-responsive">
                <table class="table align-items-center table-lg">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Nombre</th>
                      <th scope="col">Telefono</th>
                      <th scope="col">Correo</th>
                     
                      <th scope="col">Horario</th>
                      <th scope="col">Descripcion</th>
                    </tr>
                  </thead>
                  <paginate
                    name="vpnegocios"
                    :per="3"
                    :list="lista_negocios"
                    tag="tbody"
                    v-if="lista_negocios.length"
                  >
                    <tr
                      v-for="v_negocio in paginated('vpnegocios')"
                      :key="v_negocio.id"
                    >
                      <td>{{ v_negocio.name }}</td>
                      <td>{{ v_negocio.telefono }}</td>
                      <td>{{ v_negocio.email }}</td>
                      
                      <td>
                        <b>Apertura:</b> {{ v_negocio.horaApertura }} <br />
                        <b>Cierre:</b> {{ v_negocio.horaCierre }}
                      </td>
                      <td>{{ v_negocio.descripcion }}</td>
                      <td class="text-right">
                        <div class="dropdown">
                          <a
                            class="btn btn-sm btn-icon-only text-light"
                            href="#"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >
                            <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div
                            class="
                              dropdown-menu
                              dropdown-menu-right
                              dropdown-menu-arrow
                            "
                          >
                            <a
                              class="dropdown-item"
                              href="#"
                              data-toggle="modal"
                              data-target="#modal-form-editar"
                              @click="editarNegocio(v_negocio)"
                              ><i class="far fa-edit"></i>Editar</a
                            >
                            <a
                              class="dropdown-item"
                              href="#"
                              @click="eliminarNegocio(v_negocio)"
                              ><i class="fas fa-eraser"></i>Eliminar</a
                            >
                          </div>
                        </div>
                      </td>
                    </tr>
                  </paginate>
                  <tr v-else>
                    <td>No Hay registros</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer py-4">
      <nav aria-label="...">
        <paginate-links
          for="vpnegocios"
          :classes="{
            ul: ['pagination', 'justify-content-end', 'mb-0'],
            li: 'page-item',
            a: ['page-link', 'bg-warning', 'border-warning'],
          }"
        ></paginate-links>
      </nav>
    </div>
  </div>

  <!--TABLA-->
</template>

<script>
import VuePaginate from "vue-paginate";
import Dialog from "vue-dialog-loading";
Vue.use(Dialog, { dialogBtnColor: "#0f0" });
export default {
  mounted() {
    console.log("Component mounted.");
    this.obtenerNegocios();
    this.$loading.show({ delay: 0 });
  },
  data() {
    return {
      negocio: {},
      v_error: "",
      lista_negocios: {},
      editandoNegocio: false,
      paginate: ["vpnegocios"],
    };
  },
  methods: {
    guardarNegocio() {
      this.$loading.show({ delay: 0 });
      if (this.editandoNegocio) {
        axios
          .post("/editarNegocio", this.negocio)
          .then((response) => {
            console.log("Negocio Editado");
            Swal.fire("Excelente", "Se ha editado", "success");
            this.obtenerNegocios();
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(error.response);
            this.$loading.hide();
          });
        this.editandoNegocio = false;
      } else {
        axios
          .post("/guardarNegocio", this.negocio)
          .then((response) => {
            console.log("Negocio Registrado");
            Swal.fire("Excelente", "Se ha registrado", "success");
            this.obtenerNegocios();
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(error.response);
            this.$loading.hide();
          });
      }
      this.negocio = {};
    },
    obtenerNegocios() {
      this.$loading.show({ delay: 0 });
      axios
        .get("/listaNegocios")
        .then((response) => {
          this.lista_negocios = response.data;
          this.$loading.hide();
        })
        .catch((error) => {
          this.v_error = error.response.data.message;
          console.log(error.response);
          this.$loading.hide();
        });
    },
    editarNegocio(idNegocio) {
      this.editandoNegocio = true;
      this.negocio = idNegocio;
    },
    eliminarNegocio(idNegocio) {
      Swal.fire({
        title: "Estas seguro que deseas eliminarlo?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
          this.$loading.show({ delay: 0 });
          axios
            .delete("/eliminarNegocio/" + idNegocio.id)
            .then((response) => {
              console.log("Negocio Eliminado");
              Swal.fire("Eliminado!", "El negocio se ha Eliminado.", "success");
              this.$loading.hide();
            })
            .catch((error) => {
              this.v_error = error.response.data.message;
              Swal.fire("Oh no!", "ha ocurrido un problema", "error");
              console.log(error.response);
              this.$loading.hide();
            });
          this.obtenerNegocios();
        }
      });
    },
    nuevoNegocio() {
      this.editandoNegocio = false;
      this.negocio = {};
    },
  },
};

/*var bo = document.getElementById('actualizarPasswordCheck');
bo.addEventListener('change',function(e){
  if(bo.checked) {
       document.getElementById('passwordNew').disabled = 'false';
       document.getElementById('passwordConfirmationNew').disabled = 'false';
    }
});*/
</script>