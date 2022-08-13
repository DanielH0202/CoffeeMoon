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
                  <h6 class="display-2 text-white d-inline-block mb-0">Menú de Alimentos</h6>
                </div>
                <div class="col-lg-6 col-5 text-right d-none" id="admin1">
                  <button
                    type="button"
                    class="btn btn-sm btn-neutral"
                    @click="nuevoAlimento()"
                    data-toggle="modal"
                    data-target="#modal-form"
                    id="nuevoAlimento"
                  >
                    <i class="fas fa-plus"></i> Nuevo Alimento
                  </button>
                  <button
                    type="button"
                    class="btn btn-sm btn-neutral"
                    @click="obtenerAlimentos"
                  >
                    Recargar Alimento
                  </button>
                  <a
                    class="btn btn-sm btn-neutral"
                    target="_blank"
                    :href="'/ejecutarReporte'"
                  >
                    Generar Reporte
                  </a>
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
                  <h6 class="h2 text-black m-auto display-4">
                    Registrar Alimentos
                  </h6>
                  <form>
                    <!--
                    <div class="alert alert-success" role="alert">
                      <strong>Completado!</strong> {{ alimentos }}
                    </div>
                    -->
                    <div class="card mb-3 bg-secondary">
                      <div class="row g-0">
                        <div class="col-md-4">
                          <img
                            class="card-img-top"
                            :src="'/storage/' + alimentos.rutaImagen"
                            alt="No hay Imagen disponible"
                          />
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <div class="text-center"></div>
                                  <input
                                    type="file"
                                    class="form-control"
                                    id="file"
                                    accept="image/*"
                                    @change="getArchivos"
                                  />
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                  <input
                                    type="text"
                                    class="form-control"
                                    id="nombre"
                                    placeholder="Nombre"
                                    v-model="alimentos.nombre"
                                  />
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input
                                    type="text"
                                    placeholder="Precio"
                                    class="form-control"
                                    id="precio"
                                    v-model="alimentos.precio"
                                  />
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <select
                                    name="estatus"
                                    id="estatus"
                                    class="form-control"
                                    v-model="alimentos.estatus"
                                    placeholder="Selecciona"
                                  >
                                    <option
                                      class="form-control"
                                      selected
                                      disabled
                                    >
                                      Selecione
                                    </option>
                                    <option
                                      class="form-control"
                                      value="Existente"
                                    >
                                      Existente
                                    </option>
                                    <option
                                      class="form-control"
                                      value="Agotado"
                                    >
                                      Agotado
                                    </option>
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-12">
                                <div class="form-group">
                                  <select
                                    name="negocios"
                                    id="negocios"
                                    class="form-control"
                                    v-model="alimentos.idNegocios"
                                  >
                                    <option
                                      class="form-control"
                                      v-for="v_negocios in lista_Negocios"
                                      v-bind:value="v_negocios.id"
                                      :key="v_negocios.id"
                                    >
                                      {{ v_negocios.name }}
                                    </option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button
                      type="button"
                      class="btn btn-danger btn-lg"
                      data-dismiss="modal"
                      @click="guardarAlimentos"
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
    </div>

    <!-- TARJETITAS CON DISEÑO INCORRECTO -->
    <paginate
      name="vpalimentos"
      :per="100"
      :list="lista_alimentos"
      tag="div"
      v-if="lista_alimentos.length"
    >
      <div
        class="otroCont"
        v-for="v_alimentos in paginated('vpalimentos')"
        :key="v_alimentos.id"
      >
      <div class="contenedor">
        <div class="cuadros">
          <div class="imgBx">
            <img
              alt="Image placeholder"
              :src="'/storage/' + v_alimentos.rutaImagen"
            />
          </div>
          <div class="contenido">
            <div class="detalles">
              <h2>
                {{ v_alimentos.nombre }}
                <br />
                <span>$ {{ v_alimentos.precio }}</span>
              </h2>
              <ul>
                <li>Negocio: {{ v_alimentos.name }}</li>
                <li>{{ v_alimentos.estatus }}</li>
                <li>
                  <input
                    type="number"
                    class="form-control"
                    id="cantidad"
                    placeholder="0"
                    v-model="v_alimentos.cantidad"
                    value="1"
                  />
                </li>
                <li>
                  <button
                    type="button"
                    class="btn btn-danger btn-sm"
                    @click="addCarrito(v_alimentos)"
                  >
                    Añadir al carrito
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      </div>
    </paginate>

    <!--<div class="card-footer py-4">
      <nav aria-label="...">
        <paginate-links
          for="vpalimentos"
          :classes="{
            ul: ['pagination', 'justify-content-end', 'mb-0'],
            li: 'page-item',
            a: ['page-link', 'bg-warning', 'border-warning'],
          }"
        ></paginate-links>
      </nav>
    </div>-->
  </div>
</template>

<script>
import VuePaginate from "vue-paginate";
import Dialog from "vue-dialog-loading";
Vue.use(Dialog, { dialogBtnColor: "#0f0" });
export default {
  mounted() {
    console.log(this.$userId);
    console.log(this.$userT);
    this.obtenerAlimentos();
    this.obtenerNegocios();
    this.admin();
    this.$loading.show({ delay: 0 });
  },
  data() {
    return {
      alimentos: {},
      negocio: {},
      archivo: "",
      v_error: "",
      lista_alimentos: {},
      lista_Negocios: {},
      editandoAlimentos: false,
      paginate: ["vpalimentos"],
    };
  },
  methods: {
    getArchivos(e) {
      this.archivo = e.target.files[0];
    },
    admin() {
      if (this.$userT == "8") {
        var noOcultar1 = document.getElementById("admin1");
        var noOcultar2 = document.getElementById("admin2");
        noOcultar1.classList.remove("d-none");
        noOcultar2.classList.remove("d-none");
      }
    },
    guardarAlimentos() {
      this.$loading.show({ delay: 0 });
      const datosAlimento = new FormData();

      datosAlimento.set("nombre", this.alimentos.nombre);
      datosAlimento.set("precio", this.alimentos.precio);
      datosAlimento.set("estatus", this.alimentos.estatus);
      datosAlimento.set("idNegocios", this.alimentos.idNegocios);
      datosAlimento.set("archivo", this.archivo);

      if (this.editandoAlimentos) {
        //Antes de enviar datos se asigna el ID del alimento
        datosAlimento.set("id", this.alimentos.id);

        axios
          .post("/editarAlimentos", datosAlimento)
          .then((response) => {
            console.log("Alimento Editado");
            Swal.fire("Excelente", "Se ha editado", "success");
            this.obtenerAlimentos();
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(error.response);
            this.$loading.hide();
          });
        this.editandoAlimentos = false;
      } else {
        axios
          .post("/guardarAlimentos", datosAlimento)
          .then((response) => {
            console.log("Alimento Registrado");
            Swal.fire("Excelente", "Se ha registrado", "success");
            this.obtenerAlimentos();
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(this.v_error);
            console.log(error.response);
            this.$loading.hide();
          });
      }
      this.alimentos = {};
      document.getElementById("file").value = "";
      this.archivo = "";
    },
    obtenerAlimentos() {
      this.$loading.show({ delay: 0 });
      axios
        .get("/listaAlimentos/"+this.$userT)
        .then((response) => {
          this.lista_alimentos = response.data;
          this.$loading.hide();
        })
        .catch((error) => {
          this.v_error = error.response.data.errors;
          console.log(error.response);
          this.$loading.hide();
        });
    },
    obtenerNegocios() {
      axios
        .get("/listaNegociosAlimentos")
        .then((response) => {
          this.lista_Negocios = response.data;
        })
        .catch((error) => {
          this.v_error = error.response.data.errors;
          console.log(error.response);
        });
    },
    editarAlimentos(idAlimentos) {
      this.editandoAlimentos = true;
      this.alimentos = idAlimentos;
    },
    eliminarAlimentos(idAlimentos) {
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
            .delete("/eliminarAlimentos/" + idAlimentos.id)
            .then((response) => {
              console.log("Alimento Eliminado");
              Swal.fire(
                "Eliminado!",
                "El alimento se ha Eliminado.",
                "success"
              );
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
          this.obtenerAlimentos();
        }
      });
    },
    nuevoAlimento() {
      this.editandoAlimentos = false;
      this.alimentos = {};
    },
    addCarrito(alimento) {
      this.$loading.show({ delay: 0 });

      const datosProducto = new FormData();

      datosProducto.set("id_Usuario", this.$userId);
      datosProducto.set("id_Alimento", alimento.id);
      datosProducto.set("cantidad", alimento.cantidad);

      axios
        .post("/addCarrito", datosProducto)
        .then((response) => {
          console.log("Añadido al carrito");
          Swal.fire("Excelente", "Se añadió el producto al carrito", "success");
          this.obtenerAlimentos();
        })
        .catch((error) => {
          this.v_error = error.response.data.errors;
          var mensaje = Object.values(this.v_error);
          Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
          console.log(error.response);
          this.$loading.hide();
        });
      this.producto = {};
    },
  },
};
</script>

<style type="text/css">
/* Añadido porque el body afectaba toda la pagina y no se mostraba correctamente */
.otroCont {
  display: inline-flex;
  margin: auto;
}
.contenedor {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
}
.contenedor .cuadros {
  position: relative;
  width: 600px;
  height: 600px;
  background: linear-gradient(#6F4E37, #6F4E37 30%, #f4f5f7 30%, #f4f5f7);
  margin: 10px;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}
.contenedor .cuadros .imgBx {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  transition: 0.5s;
  z-index: 100;
  overflow: hidden;
  border-radius: 20px;
  transform-origin: top;
}
.contenedor .cuadros:hover .imgBx {
  transform: translateY(30px) scale(0.3);
}
.contenedor .cuadros .imgBx img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.contenedor .cuadros .contenido {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: flex-end;
  padding-bottom: 30px;
  transform: translateY(100%);
  transition: 0.5s;
}
.contenedor .cuadros:hover .contenido {
  transform: translateY(0);
}
.contenedor .cuadros .contenido .detalles {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  text-align: center;
}
.contenedor .cuadros .contenido .detalles h2 {
  color: #000;
  font-size: 1.2em;
  font-weight: 500;
}
.contenedor .cuadros .contenido .detalles h2 span {
  font-size: 0.8em;
  font-weight: 400;
  color: #222;
}
.contenedor .cuadros .contenido .detalles li {
  list-style: none;
  color: #000;
  text-align: left;
  margin: 3px;
}
#cantidad {
  padding: 0%;
  margin: 3px;
  font-size: 0.8em;
  width: 30%;
  height: 10%;
  text-align: center;
  color: black;
}
</style>