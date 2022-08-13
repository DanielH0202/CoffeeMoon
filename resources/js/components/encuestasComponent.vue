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
                  <h6 class="h2 text-white d-inline-block mb-0">Cliente</h6>
                  <nav
                    aria-label="breadcrumb"
                    class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                      <li class="breadcrumb-item">
                        <a><i class="fas fa-home"></i></a>
                      </li>
                      <li class="breadcrumb-item">
												<a>Inicio</a>
											</li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Cliente
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

    <!--CONTENIDO-->
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
                    Califica tu pedido
                  </h6>
                  <form>
                    <div class="row">
                      <!-- Calificación general del repartidor -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for='califRepartidor'>
														<p>¿Qué calificación le das al repartidor?</p>
													</label>
													<input
														type="radio"
														class="form-control"
														id="califRepartidor"
														name="califRepartidor"
														value="1"
														v-model="pedido.califRepartidor"/>
													<input
														type="radio"
														class="form-control"
														id="califRepartidor"
														name="califRepartidor"
														value="2"
														v-model="pedido.califRepartidor"/>
													<input
														type="radio"
														class="form-control"
														id="califRepartidor"
														name="califRepartidor"
														value="3"
														v-model="pedido.califRepartidor"/>
													<input
														type="radio"
														class="form-control"
														id="califRepartidor"
														name="califRepartidor"
														value="4"
														v-model="pedido.califRepartidor"/>
													<input
														type="radio"
														class="form-control"
														id="califRepartidor"
														name="califRepartidor"
														value="5"
														v-model="pedido.califRepartidor"/>
                        </div>
                      </div>
                      <!-- Calificación general de la comida -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for='califComida'>
														<p>¿Qué calificación le das a la comida?</p>
													</label>
													<input
														type="radio"
														class="form-control"
														id="califComida"
														name="califComida"
														value="1"
														v-model="pedido.califComida"/>
													<input
														type="radio"
														class="form-control"
														id="califComida"
														name="califComida"
														value="2"
														v-model="pedido.califComida"/>
													<input
														type="radio"
														class="form-control"
														id="califComida"
														name="califComida"
														value="3"
														v-model="pedido.califComida"/>
													<input
														type="radio"
														class="form-control"
														id="califComida"
														name="califComida"
														value="4"
														v-model="pedido.califComida"/>
													<input
														type="radio"
														class="form-control"
														id="califComida"
														name="califComida"
														value="5"
														v-model="pedido.califComida"/>
                        </div>
                      </div>
                    </div>
                    <!-- Botones del formulario -->
                    <button
                      type="button"
                      class="btn btn-danger btn-lg"
                      data-dismiss="modal"
                      @click="guardarEncuesta">
                      Guardar
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
  </div>
</template>

<script>
import VuePaginate from "vue-paginate";
export default {
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      encuesta: {},
      v_error: "",
      lista_encuesta: {}
    };
  },
  methods: {
    guardarEncuesta() {
      axios
          .post("/guardarEncuesta", this.encuesta)
          .then((response) => {
            console.log("Encuesta guardada");
            Swal.fire("Excelente", "Gracias", "success");
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(error.response);
          });
      this.encuesta = {};
    },
  },
};
</script>