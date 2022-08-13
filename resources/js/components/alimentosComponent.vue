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
                  <h6 class="h2 text-white d-inline-block mb-0">Alimentos</h6>
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
                        Alimentos
                      </li>
                    </ol>
                  </nav>
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
                  <!--<a
                    class="btn btn-sm btn-neutral"
                    target="_blank"
                    :href="'/ejecutarReporte'"
                  >
                    Generar Reporte
                  </a>-->
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
                                    
                                    >
                                    <option :value="undefined" disabled>Selecione: </option>
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

                              <div class="col-md-12 d-none" id="combo">
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
    <!--Anterior implementación de presentación de alimentos-->
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
                      <th scope="col">Precio</th>
                      <th scope="col">Estatus</th>
                      <th scope="col">Negocio</th>
                    </tr>
                  </thead>
                  <paginate
                    name="vpalimentos"
                    :per="6"
                    :list="lista_alimentos"
                    tag="tbody"
                    v-if="lista_alimentos.length"
                  >
                    <tr
                      v-for="v_alimentos in paginated('vpalimentos')"
                      :key="v_alimentos.id"
                    >
                      <td>
                        <div class="media align-items-center">
                          <a href="#" class="avatar rounded-circle mr-3">
                            <img
                              alt="Image placeholder"
                              :src="'/storage/' + v_alimentos.rutaImagen"
                            />
                          </a>
                          <div class="media-body">
                            {{ v_alimentos.nombre }}
                          </div>
                        </div>
                      </td>
                      <td>{{ v_alimentos.precio }}</td>
                      <td>{{ v_alimentos.estatus }}</td>
                      <td>{{ v_alimentos.name }}</td>
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
                              data-target="#modal-form"
                              @click="editarAlimentos(v_alimentos)"
                              ><i class="far fa-edit"></i>Editar</a
                            >
                            <a
                              class="dropdown-item"
                              href="#"
                              @click="eliminarAlimentos(v_alimentos)"
                              ><i class="fas fa-eraser"></i>Eliminar</a
                            >
                          </div>
                        </div>
                      </td>
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
    

    <div class="card-footer py-4">
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
    </div>

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
      if (this.$userT == "8" || this.$userT == "2") {
        var noOcultar1 = document.getElementById("admin1");
        //var noOcultar2 = document.getElementById("admin2");
        noOcultar1.classList.remove("d-none");
        //noOcultar2.classList.remove("d-none");
      }
      if(this.$userT == "8"){
        var noOcultar1 = document.getElementById("combo");
        noOcultar1.classList.remove("d-none");
      }
    },
    guardarAlimentos() {
      this.$loading.show({ delay: 0 });
      const datosAlimento = new FormData();

      datosAlimento.set("nombre", this.alimentos.nombre);
      datosAlimento.set("precio", this.alimentos.precio);
      datosAlimento.set("estatus", this.alimentos.estatus);
      if(this.$userT=="2"){
        datosAlimento.set("idUsuario", this.$userId);
      }else{
        datosAlimento.set("idNegocios", this.alimentos.idNegocios);
      }
      //datosAlimento.set("idNegocios", this.alimentos.idNegocios);
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

