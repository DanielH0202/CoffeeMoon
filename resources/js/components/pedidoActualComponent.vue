<template>
  <div>
    <!--Header-->
    <div class="header bg-gradient-warning pt-5 pt-md-6">
      <div class="container-fluid">
        <div class="header pb-6">
          <div class="container-fluid">
            <div class="header-body">
              <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                  <h6 class="h2 text-white d-inline-block mb-0">
                    Carrito de compras
                  </h6>
                  <nav
                    aria-label="breadcrumb"
                    class="d-none d-md-inline-block ml-md-4"
                  >
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                      <li class="breadcrumb-item">
                        <a><i class="fas fa-home"></i></a>
                      </li>
                      <li class="breadcrumb-item">
                        <a>Inicio</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Carrito de compras
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

    <!--Contenido-->
    <div class="card text-center">
      <div class="card-header">Pedido Actual</div>
      <div class="card-body">
        <h5 class="card-title" v-for="detalle in lista_pedido" :key="detalle.id">Pedido: </h5>
        <h5 class="card-title">Direccion de Entrega: </h5>
        <p class="card-text">
          
        </p>
        <h5 class="card-title">Producto(s): </h5>
        <p class="card-text">
          
        </p>
        <a href="#" class="btn btn-info">Producto Recogido</a>
        <a href="#" class="btn btn-success">Producto Entregado</a>
      </div>
    </div>
  </div>
</template>

<script>
import Dialog from "vue-dialog-loading";
Vue.use(Dialog, { dialogBtnColor: "#0f0" });
export default {
  mounted() {
    this.obtenerProducto();
    this.$loading.show({ delay: 0 });
  },
  data() {
    return {
      numPedido: 0,
    };
  },
  methods: {
    listarPedidoActual() {
      axios
        .get("/lista_pedido/" + this.$userId)
        .then((response) => {
          this.lista_pedido = response.data;
        })
        .catch((error) => {
          this.v_error = error.response.data.errors;
          console.log(error.response);
        });
    },
  },
};
</script>