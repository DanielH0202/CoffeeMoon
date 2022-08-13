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
    <div class="card-footer py-4">
      <!-- Stepper -->
      <v-stepper v-model="e1">
        <!-- Header del Stepper -->
        <div>
          <v-stepper-header class="bg-warning text-white">
            <v-stepper-step :complete="e1 > 1" step="1">
              <a class="text-white">Detalles de los productos</a>
            </v-stepper-step>

            <v-divider></v-divider>

            <v-stepper-step :complete="e1 > 2" step="2">
              <a class="text-white">Detalles del pago</a>
            </v-stepper-step>
          </v-stepper-header>
        </div>
        <!-- Elementos de cada parte del Stepper -->
        <v-stepper-items>
          <!-- Primer Stepper: Confirmación de elementos del carrito -->
          <v-stepper-content step="1">
            <!-- Lista de productos en el pedido -->
            <div class="row">
              <div class="col">
                <div class="card bg-secondary shadow">
                  <div class="table-responsive">
                    <table class="table align-items-center table-lg">
                      <!-- Header de la tabla de productos -->
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">Nombre producto</th>
                          <th scope="col">Precio Unitario</th>
                          <th scope="col">Cantidad</th>
                          <th scope="col">Total del producto</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="v_producto in lista_productos"
                          :key="v_producto.id"
                        >
                          <td>{{ v_producto.nombre }}</td>
                          <td>{{ v_producto.precio }}</td>
                          <td>{{ v_producto.cantidad }}</td>
                          <td>{{ v_producto.precio * v_producto.cantidad }}</td>
                          <td>
                            <v-btn
                              class="bg-danger text-white form-control"
                              @click="eliminarProducto(v_producto)"
                            >
                              Eliminar
                            </v-btn>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <v-btn class="bg-primary text-white" @click="e1 = 2">
              Continuar
            </v-btn>
            <v-btn text href="/home"> Cancelar </v-btn>
          </v-stepper-content>

          <!-- Segundo Stepper: Confirmación del pago - OpenPay -->
          <v-stepper-content step="2">
            <!-- Formulario de pago para OpenPay
              Snippet tomado de:
              https://bbbootstrap.com/snippets/bootstrap-collapsible-credit-card-payment-form-details-95174592
            -->
            <div>
              <form id="payment-form" method="POST" action="procesarPago">
                <input type="hidden" name="token_id" id="token_id">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="total" :value="aPagar">
                <input type="hidden" name="pedido" :value="numPedido">
                <div class="container d-flex justify-content-center mt-5 mb-5">
                  <div class="row g-3">
                    <!-- Información de la tarjeta de credito -->
                    <div class="col-md-6">
                      <span>Metodo de pago</span>
                      <div class="card">
                        <div class="accordion" id="accordionExample">
                          <div class="card">
                            <div class="card-header p-0">
                              <h2 class="mb-0">
                                <button
                                  class="btn btn-danger btn-block text-left p-3 rounded-0"
                                  data-toggle="collapse" data-target="#collapseOne"
                                  aria-expanded="true" aria-controls="collapseOne">
                                  <div
                                    class="d-flex align-items-center justify-content-between">
                                    <span>Tarjeta de credito</span>
                                    <div >
                                      <img
                                        src="https://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Master-Card-Blue-icon.png"
                                        width="30"
                                      />
                                      <img
                                        src="https://img.icons8.com/color/452/visa.png"
                                        width="30"
                                      />
                                    </div>
                                  </div>
                                </button>
                              </h2>
                            </div>
                            <div
                              id="collapseOne" class="collapse show"
                              aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body payment-card-body">
                                <i class="fa fa-user-circle-o"></i>
                                <span class="font-weight-normal card-text">
                                  Nombre del titular
                                </span>
                                <div class="input">
                                  <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Como aparece en la tarjeta"
                                    data-openpay-card="holder_name"
                                  />
                                </div>
                                <i class="fa fa-credit-card"></i>
                                <span class="font-weight-normal card-text">
                                  Número de tarjeta
                                </span>
                                <div class="input">
                                  <input
                                    type="text"
                                    class="form-control"
                                    placeholder="0000 0000 0000 0000"
                                    data-openpay-card="card_number"
                                  />
                                </div>
                                <div class="row mt-3 mb-3">
                                  <div class="col-md-6">
                                    <i class="fa fa-calendar"></i>
                                    <span class="font-weight-normal card-text">
                                      Fecha de expiración
                                    </span>
                                    <div class="input">
                                      <input
                                        type="text"
                                        class="form-control col-md-3 d-inline-block"
                                        placeholder="MM"
                                        data-openpay-card="expiration_month"/>
                                        / 
                                      <input
                                        type="text"
                                        class="form-control col-md-3 d-inline-block"
                                        placeholder="YY"
                                        data-openpay-card="expiration_year"/>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <i class="fa fa-lock"></i>
                                    <span class="font-weight-normal card-text">
                                      CVC/CVV
                                    </span>
                                    <div class="input">
                                      <input
                                        type="text"
                                        class="form-control"
                                        placeholder="000"
                                        data-openpay-card="cvv2"/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Resumen del total a pagar -->
                    <div class="col-md-6">
                      <span>Detalles de pago</span>
                      <div class="card">
                        <div class="p-3 overflow-auto" style="height: 160px;">
                          <!-- Elementos dentro del pedido -->
                          <div v-for="v_producto in lista_productos"
                              :key="v_producto.id">
                            <div class="d-flex justify-content-between mb-2">
                              <span>{{ v_producto.nombre }}</span>
                              <span>
                                ${{ v_producto.precio * v_producto.cantidad}}
                              </span>
                            </div>
                          </div>
                        </div>
                        <hr class="mt-0 line" />
                        <div class="p-3 d-flex justify-content-between">
                          <div class="d-flex flex-column">
                            <span>El Total es: </span>
                          </div>
                          <span>${{ aPagar }}</span>
                        </div>
                        <div class="p-3">
                          <button type="button" id="pay-button"
                              class="btn bg-primary text-white btn-block free-button">
                            Realizar el pago
                          </button>
                          <v-btn class="btn-block free-button" @click="e1 = 1"> Regresar </v-btn>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </v-stepper-content>
        </v-stepper-items>
      </v-stepper>
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
      csrf: document.querySelector("meta[name='csrf-token']").getAttribute('content'),
      e1: 1,
      producto: {},
      v_error: "",
      lista_productos: {},
      aPagar: 0,
      numPedido: 0,
    };
  },
  methods: {
    //Función para obtener el total del pedido
    total(productod){
      for (var i = 0; i < productod.length; i++){
        this.aPagar= this.aPagar + (productod[i].precio * productod[i].cantidad);
      }
      this.numPedido = productod[0].idPedido;
    },
    //Función para obtener la lista de productos del pedido
    obtenerProducto() {
      this.$loading.show({ delay: 0 });
      axios
        .post("/listaProducto", { idUsuario: this.$userId })
        .then((response) => {
          this.lista_productos = response.data;
          this.total(this.lista_productos);
          this.$loading.hide();
        })
        .catch((error) => {
          this.v_error = error.response.data.errors;
          console.log(error.response);
          this.$loading.hide();
        });
    },
    //Función para remover un producto del pedido
    eliminarProducto(idProducto) {
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
            .delete("/eliminarProducto/" + idProducto.id)
            .then((response) => {
              console.log("Producto Eliminado");
              Swal.fire(
                "Eliminado!",
                "El producto se ha Eliminado.",
                "success"
              );
              this.$loading.hide();
            })
            .catch((error) => {
              this.v_error = error.response.data.errors;
              var mensaje = Object.values(this.v_error);
              Swal.fire(
                "Oh no!",
                "Se produjo un error con la tarjeta\n" + mensaje,
                "error"
              );
              console.log(error.response);
              this.$loading.hide();
            });
          this.obtenerProducto();
        }
      });
    },
  },
};
</script>