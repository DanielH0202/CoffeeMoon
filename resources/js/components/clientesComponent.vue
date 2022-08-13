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
                  <h6 class="h2 text-white d-inline-block mb-0">Cliente</h6>
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
                        Cliente
                      </li>
                    </ol>
                  </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                  <button
                    type="button"
                    class="btn btn-sm btn-neutral"
                    @click="nuevoCliente()"
                    data-toggle="modal"
                    data-target="#modal-form"
                    id="nuevoCliente"
                  >
                    <i class="fas fa-plus"></i> Nuevo cliente
                  </button>
                  <button type="button" class="btn btn-sm btn-neutral" @click="obtenerCliente">
                    Recargar cliente
                  </button>
                </div>

                <!--<div class="col-lg-6 col-5 text-right">
                  <button
                    type="button"
                    class="btn btn-sm btn-neutral"
                    @click="nuevoCliente()"
                    data-toggle="modal"
                    data-target="#modal-form"
                    id="nuevoCliente"
                  >
                    <i class="fas fa-plus"></i> Nuevo cliente
                  </button>
                  
                </div>-->
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
        Registrar cliente
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
                    Registrar cliente
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
                            v-model="cliente.name"
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
                            v-model="cliente.telefono"
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
                            v-model="cliente.email"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="password"
                            placeholder="Contraseña"
                            class="form-control"
                            id="contraseña"
                            v-model="cliente.password"
                          />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input
                            type="password"
                            placeholder="Confirmar Contraseña"
                            class="form-control"
                            id="password_confirmation"
                            v-model="cliente.password_confirmation"
                          />
                        </div>
                      </div>
                      
                      <div class="col-md-3">
                        <div class="form-group">
                          <select
                            placeholder="Sexo"
                            class="form-control"
                            id="sexo"
                            v-model="cliente.sexo"
                          >
                            <option value="Masculino" selected>
                              Masculino
                            </option>
                            <option value="Femenino">Femenino</option>
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
                              v-model="cliente.fechaNacimiento"
                            />
                          </div>
                        </div>
                      </div>
                    <!--<div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="time"
                            placeholder="Hora de Apertura"
                            class="form-control"
                            id="horaApertura"
                            v-model="cliente.horaInicio"
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
                            v-model="cliente.horaFin"
                          />
                        </div>
                      </div>-->

                    </div>
                    <button
                      type="button"
                      class="btn btn-danger btn-lg"
                      data-dismiss="modal"
                      @click="guardarCliente"
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
      <!--END MODAL BOTÓN-->



      <!-- Modal para editar el cliente-->
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
                  <h6 class="h2 text-black m-auto display-4 text-center">Editar cliente</h6>
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
                            v-model="cliente.name"
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
                            v-model="cliente.telefono"
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
                            v-model="cliente.email"
                          />
                        </div>
                      </div>
                      
                      <div class="col-md-3">
                        <div class="form-group">
                          <select
                            placeholder="Sexo"
                            class="form-control"
                            id="sexo"
                            v-model="cliente.sexo"
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
                              v-model="cliente.fechaNacimiento"
                            />
                          </div>
                        </div>
                      </div>
                      
                     
                    </div>

                    <button
                      type="button"
                      class="btn btn-danger btn-lg"
                      data-dismiss="modal"
                      @click="guardarCliente"
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
                     
                      <th scope="col">Sexo</th>
                      <th scope="col">Fecha <br />Nacimiento</th>
                     
                    </tr>
                  </thead>
                  <paginate
                    name="vpclientes"
                    :per="3"
                    :list="lista_cliente"
                    tag="tbody"
                    v-if="lista_cliente.length"
                  >
                    <tr
                      v-for="v_cliente in paginated('vpclientes')"
                      :key="v_cliente.id"
                    >
                      <td>{{ v_cliente.name }}</td>
                      <td>{{ v_cliente.telefono }}</td>
                      <td>{{ v_cliente.email }}</td>
                      
                      <td>{{ v_cliente.sexo }}</td>
                      <td>{{ v_cliente.fechaNacimiento }}</td>
                      
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
                              @click="editarCliente(v_cliente)"
                            >
                              <i class="far fa-edit"></i>Editar
                            </a>
                            <a
                              class="dropdown-item"
                              href="#"
                              @click="eliminarCliente(v_cliente)"
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
          for="vpclientes"
          :classes="{
            ul: ['pagination', 'justify-content-end', 'mb-0'],
            li: 'page-item',
            a: ['page-link','bg-warning' ,'border-warning']
          }"
        ></paginate-links>
      </nav>
    </div>
  <br>
  
    <!--TABLA DOS-->
    <!--<div>
      
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
                     <th scope="col">Hora inicio</th>
                      <th scope="col">Hora fin</th>
                    </tr>
                  </thead>
                  <paginate
                    name="vpclientes"
                    :per="3"
                    :list="lista_cliente"
                    tag="tbody"
                    v-if="lista_cliente.length"
                  >
                    <tr
                      v-for="v_cliente in paginated('vpclientes')"
                      :key="v_cliente.id"
                    >
                      <td>{{ v_cliente.name }}</td>
                      <td>{{ v_cliente.telefono }}</td>                     
                      <td>{{ v_cliente.horaInicio }}</td>
                      <td>{{ v_cliente.horaFin }}</td>
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
                              @click="editarCliente(v_cliente)"
                            >
                              <i class="far fa-edit"></i>Editar
                            </a>
                            <a
                              class="dropdown-item"
                              href="#"
                              @click="eliminarCliente(v_cliente)"
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
    </div>-->
    <!--END TABAL DOS-->
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
    this.obtenerCliente();
    this.$loading.show({ delay: 0 });
  },
  data() {
    return {
      cliente: {},
      v_error: "",
      lista_cliente: {},
      editandoCliente: false,
      paginate: ["vpclientes"],
    };
  },
  methods: {
    guardarCliente() {
      this.$loading.show({ delay: 0 });
      if (this.editandoCliente) {
        axios
          .post("/editarCliente", this.cliente)
          .then((response) => {
            console.log("Cliente Editado");
            Swal.fire("Excelente", "Se ha editado", "success");
            this.obtenerCliente();
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(error.response);
            this.$loading.hide();
          });
        this.editandoCliente = false;
      } else {
        axios
          .post("/guardarCliente", this.cliente)
          .then((response) => {
            console.log("Cliente Registrado");
            Swal.fire("Excelente", "Se ha registrado", "success");
            this.obtenerCliente();
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(error.response);
            this.$loading.hide();
          });
      }
      this.cliente = {};
    },
    obtenerCliente() {
      this.$loading.show({ delay: 0 });
      axios
        .get("/listaCliente")
        .then((response) => {
          this.lista_cliente = response.data;
          this.$loading.hide();
        })
        .catch((error) => {
          this.v_error = error.response.data.errors;
          console.log(error.response);
          this.$loading.hide();
        });
    },
    editarCliente(idCliente) {
      this.editandoCliente = true;
      this.cliente = idCliente;
    },
    eliminarCliente(idCliente) {
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
            .delete("/eliminarCliente/" + idCliente.id)
            .then((response) => {
              console.log("Cliente Eliminado");
              Swal.fire("Eliminado!", "El cliente se ha Eliminado.", "success");
              this.$loading.hide();
            })
            .catch((error) => {
              this.v_error = error.response.data.errors;
              var mensaje = Object.values(this.v_error);
              Swal.fire(
                "Oh no!",
                "Ha ocurrido un problema\n" + mensaje,
                "error"
              );
              console.log(error.response);
              this.$loading.hide();
            });
          this.obtenerCliente();
        }
      });
    },
    nuevoCliente() {
      this.editandoCliente = false;
      this.cliente = {};
    },
    
  },
};
</script>