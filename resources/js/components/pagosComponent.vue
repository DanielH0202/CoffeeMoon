<template>
  <div>
    <!-- HEADER -->
    <div class="header bg-gradient-warning pt-5 pt-md-6">
      <div class="container-fluid">
        <div class="header pb-6">
          <div class="container-fluid">
            <div class="header-body">
              <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                  <h6 class="h2 text-white d-inline-block mb-0">Historial de pagos</h6>
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
                        Historial de pagos
                      </li>
                    </ol>
                  </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                  <button
                    type="button"
                    class="btn btn-sm btn-neutral"
                    @click="nuevoPago()"
                    data-toggle="modal"
                    data-target="#modal-form"
                    id="nuevoPago"
                  >
                    <i class="fas fa-plus"></i> Nuevo pago
                  </button>
                  <button type="button" class="btn btn-sm btn-neutral">
                    Recargar pagos
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--CONTENIDO-->

    <!-- Modal de registro de pago -->
    <div class="col-md-4">
      <div
        class="modal fade"
        id="modal-form"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modal-form"
        aria-hidden="true">
        <div
          class="modal-dialog modal- modal-dialog-centered modal-lg"
          role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-6 py-lg-6">
                  <h6 class="h2 text-black m-auto display-4">
                    Registrar pago
                  </h6>
                  <form>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Monto total"
                            class="form-control"
                            id="montoTotal"
                            v-model="pago.montoTotal"/>
                        </div>
                      </div>
                    </div>
                    <button
                      type="button"
                      class="btn btn-danger btn-lg"
                      data-dismiss="modal"
                      @click="guardarPago">
                      Registrar
                    </button>
                    <button
                      type="button"
                      class="btn btn-link ml-auto"
                      data-dismiss="modal">
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

    <!-- Lista de pagos en la base -->
    <div>
      <div class="container-fluid mt--7">
        <div class="row">
          <div class="col">
            <div class="card bg-secondary shadow">
              <div class="table-responsive">
                <table class="table align-items-center table-lg">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Fecha pago</th>
                      <th scope="col">monto total del pago</th>
                      <th scope="col">Ver detalles</th>
                    </tr>
                  </thead>
                  <paginate
                    name="vpagos"
                    :per="3"
                    :list="lista_pagos"
                    tag="tbody"
                    v-if="lista_pagos.length">
                    <tr
                      v-for="v_pagos in paginated('vpagos')"
                      :key="v_pagos.id">
                      <td>{{ v_pagos.created_at }}</td>
                      <td>{{ v_pagos.montoTotal }}</td>
                      <td>
                        <button
                            type="button"
                            class="btn btn-danger btn-sm"
                            >
                                Detalles del pago
                        </button>
                      </td>
                      <!-- Botón editar/eliminar -->
                      <td class="text-right">
                        <div class="dropdown">
                          <a
                            class="btn btn-sm btn-icon-only text-light"
                            href="#"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div
                            class="dropdown-menu
                              dropdown-menu-right
                              dropdown-menu-arrow">
                            <a
                              class="dropdown-item"
                              href="#"
                              data-toggle="modal"
                              data-target="#modal-form"
                              @click="editarPago(v_pagos)">
                              <i class="far fa-edit"></i>Editar
                            </a>
                            <a
                              class="dropdown-item"
                              href="#"
                              @click="eliminarPago(v_pagos)">
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

    <!-- Paginación de la lista de pagos -->
    <div class="card-footer py-4">
      <nav aria-label="...">
        <paginate-links
          for="vpagos"
          :classes="{
            ul: ['pagination', 'justify-content-end', 'mb-0'],
            li: 'page-item',
            a: ['page-link','bg-warning' ,'border-warning']
          }"
        ></paginate-links>
      </nav>
    </div>
  </div>
</template>

<script>
import VuePaginate from "vue-paginate";
export default {
  mounted() {
    console.log("Component mounted.");
    this.obtenerPago();
  },
  data() {
    return {
      pago: {},
      v_error: "",
      lista_pagos: {},
      editandoPago: false,
      paginate: ["vpagos"],
    };
  },
  methods: {
    guardarPago() {
      if (this.editandoPago) {
        axios
          .post("/editarPago", this.pago)
          .then((response) => {
            console.log("Pago Editado");
            Swal.fire("Excelente", "Se ha editado", "success");
            this.obtenerPago();
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(error.response);
          });
        this.editandoPago = false;
      } else {
        console.log(this.pago);
        axios
          .post("/guardarPago", this.pago)
          .then((response) => {
            console.log("Pago Registrado");
            Swal.fire("Excelente", "Se ha registrado", "success");
            this.obtenerPago();
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(error.response);
          });
      }
      this.pago = {};
    },
    obtenerPago() {
      axios
        .get("/listarPagos")
        .then((response) => {
          this.lista_pagos = response.data;
        })
        .catch((error) => {
          this.v_error = error.response.data.errors;
          console.log(error.response);
        });
    },
    editarPago(idPago) {
      this.editandoPago = true;
      this.pago = idPago;
    },
    eliminarPago(idPago) {
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
          console.log(idPago.id);
          axios
            .delete("/eliminarPago/" + idPago.id)
            .then((response) => {
              console.log("Pago Eliminado");
              Swal.fire("Eliminado!", "El pago se ha Eliminado.", "success");
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
            });
          this.obtenerPago();
        }
      });
    },
    nuevoPago() {
      this.editandoPago = false;
      this.pago = {};
    },
  },
};
</script>