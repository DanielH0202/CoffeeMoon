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
                    Pedidos pendientes
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
                        Pedidos pendientes
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
                      <th>Productos</th>
                    </tr>
                  </thead>
                  <paginate
                    name="vpedidos"
                    :per="10"
                    :list="llaves"
                    tag="tbody"
                    v-if="llaves.length"
                  >
                    <tr
                      v-for="v_pedido in paginated('vpedidos')"
                      :key="lista_pedidos[v_pedido][0].idPedido"
                    >
                      <td>{{ lista_pedidos[v_pedido][0].idPedido }}</td>
                      <td>{{ lista_pedidos[v_pedido][0].name }}</td>
                      <td>
                          <div v-for="item in lista_pedidos[v_pedido]" :key="item.id">
                              {{item.nombre}}
                          </div>
                      </td>
                      <td>
                        <button
                          type="button"
                          class="btn btn-danger btn-sm"
                          @click="completar(lista_pedidos[v_pedido][0])"
                        >
                          Completar pedido
                        </button>
                      </td>
                    </tr>
                  </paginate>
                  <tr v-else>
                    <td>No hay pedidos pendientes</td>
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
  },
  data() {
    return {
      pedido: {},
      v_error: "",
      llaves: {},
      lista_pedidos: {},
      lista_alimentos: {},
      paginate: ["vpedidos"],
    };
  },
  methods: {
    obtenerPedido() {
      this.$loading.show({ delay: 0 });
      axios
        .get("/listarPedidosNegocio/" + this.$userId)
        .then((response) => {
          this.lista_pedidos = response.data;
          this.llaves = Object.keys(this.lista_pedidos);
          this.$loading.hide();
        })
        .catch((error) => {
          this.v_error = error.response.data.errors;
          console.log(error.response);
          this.$loading.hide();
        });
    },
    completar(pedidoAc) {
      this.$loading.show({ delay: 0 });
      axios
        .post("/completarPedido", pedidoAc)
        .then((response) => {
          console.log("Pedido Completado");
          Swal.fire("Excelente", "", "success");
          this.obtenerPedido();
        })
        .catch((error) => {
          this.v_error = error.response.data.errors;
          var mensaje = Object.values(this.v_error);
          Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
          console.log(error.response);
          this.$loading.hide();
        });
    },
  },
};
</script>