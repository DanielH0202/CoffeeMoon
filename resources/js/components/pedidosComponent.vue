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
                  <h6 class="h2 text-white d-inline-block mb-0">
                    Historial de pedidos
                  </h6>
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
                        Historial de pedidos
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    

    <!-- Lista de pedidos en la base -->
    <div>
      <div class="container-fluid mt--7">
        <div class="row">
          <div class="col">
            <div class="card bg-secondary shadow">
              <div class="table-responsive">
                <table class="table align-items-center table-lg">
                  <thead class="thead-light">
                    <tr>
                      <th># Pedido</th>
                      <th>Cliente</th>
                      <th>Correo cliente</th>
                      <th scope="col">Fecha pedido</th>
                      <th scope="col">Estatus pedido</th>
                    </tr>
                  </thead>
                  <paginate
                    name="vpedidos"
                    :per="10"
                    :list="lista_pedidos"
                    tag="tbody"
                    v-if="lista_pedidos.length"
                  >
                    <tr
                      v-for="v_pedido in paginated('vpedidos')"
                      :key="v_pedido.id"
                    >
                      <td>{{ v_pedido.id }}</td>
                      <td>{{ v_pedido.name }}</td>
                      <td>{{ v_pedido.email }}</td>
                      <td>{{ v_pedido.created_at }}</td>
                      <td>{{ v_pedido.estatusPedido }}</td>

                    <!--MODAL ELIMINAR Y EDITAR-->
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
                              @click="eliminarPedido(v_pedido)"
                              ><i class="fas fa-eraser"></i>Eliminar</a
                            >
                          </div>
                        </div>
                      </td>
                      <!--FIN MODAL ELIMINAR Y EDITAR-->
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

    <!-- Paginación de la lista de pedidos -->
    <div class="card-footer py-4">
      <nav aria-label="...">
        <paginate-links
          for="vpedidos"
          :classes="{
            ul: ['pagination', 'justify-content-end', 'mb-0'],
            li: 'page-item',
            a: ['page-link', 'bg-warning', 'border-warning'],
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
    this.obtenerPedido();
    this.obtenerAlimentos();
  },
  data() {
    return {
      pedido: {},
      v_error: "",
      lista_pedidos: {},
      lista_alimentos: {},
      alimento: {},
      editandoPedido: false,
      paginate: ["vpedidos"],
    };
  },
  methods: {
    guardarPedido() {
      if (this.editandoPedido) {
        axios
          .post("/editarPedido", this.pedido)
          .then((response) => {
            console.log("Pedido Editado");
            Swal.fire("Excelente", "Se ha editado", "success");
            this.obtenerPedido();
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(error.response);
          });
        this.editandoPedido = false;
      } else {
        console.log(this.pedido);
        axios
          .post("/guardarPedido", this.pedido)
          .then((response) => {
            console.log("Pedido Registrado");
            Swal.fire("Excelente", "Se ha registrado", "success");
            this.obtenerPedido();
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(error.response);
          });
      }
      this.pedido = {};
    },
    obtenerPedido() {
      axios
        .get("/listaPedidos")
        .then((response) => {
          this.lista_pedidos = response.data;
        })
        .catch((error) => {
          this.v_error = error.response.data.errors;
          console.log(error.response);
        });
    },
    obtenerAlimentos() {
      axios
        .get("/listaAlimentos")
        .then((response) => {
          this.lista_alimentos = response.data;
        })
        .catch((error) => {
          this.v_error = error.response.data.errors;
          console.log(error.response);
        });
    },
    eliminarPedido(idPedido) {
      Swal.fire({
        title: "¿Estas seguro que deseas eliminarlo?",
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
            .delete("/eliminarPedido/" + idPedido.id)
            .then((response) => {
              console.log("Pedido Eliminado");
              Swal.fire("Eliminado!", "La reserva se ha Eliminado.", "success");
              this.$loading.hide();
            })
            .catch((error) => {
              this.v_error = error.response.data.message;
              Swal.fire("Oh no!", "ha ocurrido un problema", "error");
              console.log(error.response);
              this.$loading.hide();
            });
          this.obtenerPedido();
        }
      });
    },
    editarPedido(idPedido) {
      this.editandoPedido = true;
      this.pedido = idPedido;
    },
    nuevoPedido() {
      this.editandoPedido = false;
      this.pedido = {};
    },
  },
};
</script>