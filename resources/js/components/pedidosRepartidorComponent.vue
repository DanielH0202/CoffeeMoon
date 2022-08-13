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
                    Pedidos disponibles
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
                        Pedidos disponibles
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
                      <th>Estatus pedido</th>
                      <th>Dirección</th>
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
                      <td>{{ v_pedido.estatusPedido }}</td>
                      <td>
                        <b>Pais:</b> {{ v_pedido.pais }} <b>Estado:</b>
                        {{ v_pedido.estado }} <br />
                        <b>Ciudad:</b> {{ v_pedido.ciudad }} <b>Colonia:</b>
                        {{ v_pedido.colonia }} <br />
                        <b>Calle:</b> {{ v_pedido.calle }} <b>No. Ext:</b>
                        {{ v_pedido.noExt }}, <b>No. Int:</b>
                        {{ v_pedido.noInt }} <br />
                        <b>Código Postal:</b> {{ v_pedido.codigoPostal }}
                      </td>
                      <td>
                        <button
                          type="button"
                          class="btn btn-danger btn-sm"
                          @click="aceptar(v_pedido)"
                        >
                          Aceptar Pedido
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
      lista_pedidos: {},
      lista_alimentos: {},
      paginate: ["vpedidos"],
    };
  },
  methods: {
    obtenerPedido() {
      this.$loading.show({ delay: 0 });
      axios
        .get("/listaPedidosRep")
        .then((response) => {
          this.lista_pedidos = response.data;
          this.$loading.hide();
        })
        .catch((error) => {
          this.v_error = error.response.data.errors;
          console.log(error.response);
          this.$loading.hide();
        });
    },
    aceptar(pedidoAc) {
      this.$loading.show({ delay: 0 });
      axios
          .post("/aceptarPedido", pedidoAc)
          .then((response) => {
            console.log("Pedido Aceptado");
            Swal.fire("Excelente", "Pasa a recoger el pedido", "success");
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