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
                  <h6 class="h2 text-white d-inline-block mb-0">Repartidor</h6>
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
                        Repartidores
                      </li>
                    </ol>
                  </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                  <button
                    type="button"
                    class="btn btn-sm btn-neutral"
                    @click="nuevoRepartidor()"
                    data-toggle="modal"
                    data-target="#modal-form"
                    id="nuevoRepartidor"
                  >
                    <i class="fas fa-plus"></i> Nuevo repartidor
                  </button>
                  <button type="button" class="btn btn-sm btn-neutral" @click="obtenerRepartidor">
                    Recargar repartidor
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
        Registrar repartidor
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
                    Registrar repartidor
                  </h6>
                  <form>
                    <!--<div class="alert alert-success" role="alert">
                      <strong>Completado!</strong> {{ repartidor }}
                    </div>-->

                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            placeholder="Nombre"
                            v-model="repartidor.name"
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
                            v-model="repartidor.horaInicio"
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
                            v-model="repartidot.horaFin"
                          />
                        </div>
                      </div>
                      

                      
                    </div>
                    <button
                      type="button"
                      class="btn btn-danger btn-lg"
                      data-dismiss="modal"
                      @click="guardarRepartidor"
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

      <!-- Modal para editar el repartidor-->
      <div
        class="modal fade"
        id="modal-form-editar"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modal-form-editar"
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
                  <h6 class="h2 text-black m-auto display-4 text-center">Editar Repartidor</h6>
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
                            v-model="repartidor.name"
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
                            v-model="repartidor.telefono"
                          />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Correo"
                            class="form-control"
                            id="correo"
                            v-model="repartidor.email"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Calle"
                            class="form-control"
                            id="avenida"
                            v-model="repartidor.calle"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Colonia"
                            class="form-control"
                            id="colonia"
                            v-model="repartidor.colonia"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Ciudad"
                            class="form-control"
                            id="ciudad"
                            v-model="repartidor.ciudad"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Estado"
                            class="form-control"
                            id="estado"
                            v-model="repartidor.estado"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Pais"
                            class="form-control"
                            id="pais"
                            v-model="repartidor.pais"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="No. ext"
                            class="form-control"
                            id="noExt"
                            v-model="repartidor.noExt"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="No. Int"
                            class="form-control"
                            id="noInt"
                            v-model="repartidor.noInt"
                          />
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Codigo Postal"
                            class="form-control"
                            id="codigoPostal"
                            v-model="repartidor.codigoPostal"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <select
                            placeholder="Sexo"
                            class="form-control"
                            id="sexo"
                            v-model="repartidor.sexo"
                          >
                            <option value="Masculino" selected>
                              Masculino
                            </option>
                            <option value="Fememnino">Fememnino</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"
                                ><i class="ni ni-calendar-grid-58"></i
                              ></span>
                            </div>
                            <input
                              class="form-control"
                              placeholder="Fecha de nacimiento"
                              type="date"
                              value="06/20/2020"
                              id="fechaNacimiento"
                              v-model="repartidor.fechaNacimiento"
                            />
                          </div>
                        </div>
                      </div>
                      <!--
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="password">Actualiza tu contraseña</label
                          ><br />
                          <input
                            type="checkbox"
                            id="actualizarPasswordCheck"
                            name="actualizarPasswordCheck"
                            v-model="repartidor.actualizarPasswordCheck"
                            value="True"
                          />@click="click"
                          <label for="actualizarPasswordCheck"
                            ><small> si deseas actualizar</small></label
                          >
                          <input
                            type="password"
                            placeholder="Actualizar Contraseña"
                            class="form-control"
                            id="passwordNew"
                            name="passwordNew"
                            v-model="repartidor.passwordNew"
                          />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="password_confirmation"
                            >Confirmar tu contraseña Nueva</label
                          ><br />
                          <input
                            type="password"
                            placeholder="Confirmar Contraseña"
                            class="form-control"
                            name="password_confirmation"
                            id="password_confirmation"
                            v-model="repartidor.password_confirmation"
                          />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="password_confirmation"
                            >Introduce tu contraseña para actualizar</label
                          >
                          <input
                            type="password"
                            placeholder="Confirmar Contraseña"
                            class="form-control"
                            name="passwordValidation"
                            id="passwordValidation"
                            v-model="repartidor.passwordValidation"
                          />
                        </div>
                      </div>-->
                    </div>

                    <button
                      type="button"
                      class="btn btn-danger btn-lg"
                      data-dismiss="modal"
                      @click="guardarRepartidor"
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
      <!---->
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
                      <th scope="col">Direccion</th>
                      <th scope="col">Sexo</th>
                      <th scope="col">Fecha <br />Nacimiento</th>
                    </tr>
                  </thead>
                  <paginate
                    name="vprepartidor"
                    :per="3"
                    :list="lista_repartidor"
                    tag="tbody"
                    v-if="lista_repartidor.length"
                  >
                    <tr
                      v-for="v_repartidor in paginated('vprepartidor')"
                      :key="v_repartidor.id"
                    >
                      <td>{{ v_repartidor.name }}</td>
                      <td>{{ v_repartidor.telefono }}</td>
                      <td>{{ v_repartidor.email }}</td>
                      <td>
                        <b>Pais:</b> {{ v_repartidor.pais }} <b>Estado:</b>
                        {{ v_repartidor.estado }}<br />
                        <b>Ciudad:</b> {{ v_repartidor.ciudad }} <b>Colonia:</b>
                        {{ v_repartidor.colonia }}<br />
                        <b>Calle:</b> {{ v_repartidor.calle }} <b>No. Ext:</b>
                        {{ v_repartidor.noExt }}, <b>No. Int:</b>
                        {{ v_repartidor.noInt }}<br />
                        <b>Código Postal:</b> {{ v_repartidor.codigoPostal }}
                      </td>
                      <td>{{ v_repartidor.sexo }}</td>
                      <td>{{ v_repartidor.fechaNacimiento }}</td>
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
                              @click="editarRepartidor(v_repartidor)"
                            >
                              <i class="far fa-edit"></i>Editar
                            </a>
                            <a
                              class="dropdown-item"
                              href="#"
                              @click="eliminarRepartidor(v_repartidor)"
                            >
                              <i class="fas fa-eraser"></i>Eliminar
                            </a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </paginate>
                  <tr v-else><td>No Hay registros</td></tr>
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
          for="vprepartidor"
          :classes="{
            ul: ['pagination', 'justify-content-end', 'mb-0'],
            li: 'page-item',
            a: ['page-link','bg-warning' ,'border-warning']
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
    this.obtenerRepartidor();
    this.$loading.show({ delay: 0 });
  },
  data() {
    return {
      repartidor: {},
      v_error: "",
      lista_repartidor: {},
      editandoRepartidor: false,
      paginate: ["vprepartidor"],
    };
  },
  methods: {
    guardarRepartidor() {
      this.$loading.show({ delay: 0 });
      if (this.editandoRepartidor) {
        axios
          .post("/editarRepartidor", this.repartidor)
          .then((response) => {
            console.log("Repartidor Editado");
            Swal.fire("Excelente", "Se ha editado", "success");
            this.obtenerRepartidor();
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(error.response);
            this.$loading.hide();
          });
        this.editandoRepartidor = false;
      } else {
        axios
          .post("/guardarRepartidor", this.repartidor)
          .then((response) => {
            console.log("Repartidor Registrado");
            Swal.fire("Excelente", "Se ha registrado", "success");
            this.obtenerRepartidor();
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(error.response);
            this.$loading.hide();
          });
      }
      this.repartidor = {};
    },
    obtenerRepartidor() {
      this.$loading.show({ delay: 0 });
      axios
        .get("/listaRepartidores")
        .then((response) => {
          this.lista_repartidor = response.data;
          this.$loading.hide();
        })
        .catch((error) => {
          this.v_error = error.response.data.errors;
          console.log(error.response);
          this.$loading.hide();
        });
    },
    editarRepartidor(idRepartidor) {
      this.editandoRepartidor = true;
      this.repartidor = idRepartidor;
    },
    eliminarRepartidor(idRepartidor) {
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
            .delete("/eliminarRepartidor/" + idRepartidor.id)
            .then((response) => {
              console.log("Repartidor Eliminado");
              Swal.fire("Eliminado!", "El repartidor se ha Eliminado.", "success");
              this.$loading.hide();
            })
            .catch((error) => {
              this.v_error = error.response.data.message;
              Swal.fire("Oh no!", "ha ocurrido un problema", "error");
              console.log(error.response);
              this.$loading.hide();
            });
          this.obtenerRepartidor();
        }
      });
    },
    nuevoRepartidor() {
      this.editandoRepartidor = false;
      this.repartidor = {};
    },
    /*click() {
      if(document.getElementById("actualizarPasswordCheck").checked){
        document.getElementById("passwordNew").style.display='block';
        document.getElementById("password_confirmation").style.display='block';
      }else{
          document.getElementById("passwordNew").style.display='none';
        document.getElementById("password_confirmation").style.display='none';
      }
    },*/
  },
};
</script>

