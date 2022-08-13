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
                  <h6 class="h2 text-white d-inline-block mb-0">Reservas</h6>
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
                        Reservas
                      </li>
                    </ol>
                  </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                  <button
                    type="button"
                    class="btn btn-sm btn-neutral"
                    @click="nuevoReservas()"
                    data-toggle="modal"
                    data-target="#modal-form"
                    id="nuevoReserva"
                  >
                    <i class="fas fa-plus"></i> Nueva Reserva
                  </button>
                  <button
                    type="button"
                    class="btn btn-sm btn-neutral"
                    @click="obtenerReservas"
                  >
                    Recargar Reserva
                  </button>
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
                  <h6 class="h2 text-black m-auto display-4 text-center">
                    Registrar nueva reserva
                  </h6>
                  <form>
                  

                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            placeholder="Nombre Completo"
                            v-model="reservas.nombre"
                          />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Teléfono a 10 digitos"
                            class="form-control"
                            id="telefono"
                            v-model="reservas.telefono"
                          />
                        </div>
                      </div>
                      
                      <!--<div class="col-md-3">
                        <div class="form-group">
                          <input
                            type="date"
                            placeholder="Hora de Apertura"
                            class="form-control"
                            id="horaApertura"
                            v-model="reservas.horaApertura"
                          />
                        </div>
                      </div>-->

                      <div class="col-md-3">
                        <div class="form-group">                        
                          <select class="form-control" v-model="reservas.id_horario">
                         <option :value="undefined" disabled>Selecionar horario </option>
                                         
                          <option v-for="horario in lista_horarios" :key="horario.id" v-bind:value="horario.id">                           
                          {{horario.horaini}}  
                          {{horario.horafin}}                     
                          </option>
                          </select>
                        </div>
                      </div>

                      
                      <div class="col-md-12">
                        
                      </div>
                    </div>
                    <button
                      type="button"
                      class="btn btn-danger btn-lg"
                      data-dismiss="modal"
                      @click="guardarReservas"
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


      <!--EDITAR RESERVAS-->
      <div
        class="modal fade"
        id="modal-form-editar"
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
                    Editar Reservas
                  </h6>
                  <form>

                    <!--ALERTA-->
                    <div class="alert alert-success" role="alert">
                      <strong>Completado!</strong> {{ v_error }}
                    </div>
                    <!---->

                  <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            placeholder="Nombre"
                            v-model="reservas.nombre"
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
                            v-model="reservas.telefono"
                          />
                        </div>
                      </div>
                      
                     
                   
                                 
                    </div>


                    <button
                      type="button"
                      class="btn btn-danger btn-lg"
                      data-dismiss="modal"
                      @click="guardarReservas"
                    >
                      Actualizar
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
                      <th scope="col">Horario Inicio</th>
                      <th scope="col">Horario Fin</th>
                      
                    </tr>
                  </thead>
                  <paginate
                    name="vpreservas"
                    :per="10"
                    :list="lista_reservas"
                    tag="tbody"
                    v-if="lista_reservas.length"
                  >
                    <tr
                      v-for="v_reservas in paginated('vpreservas')"
                      :key="v_reservas.id"
                    >
                      <td>{{ v_reservas.nombre }}</td>
                      <td>{{ v_reservas.telefono }}</td>
                      <td>{{ v_reservas.hora_ini }}</td>
                      <td>{{ v_reservas.hora_fin }}</td>                                         
                      <!--<td v-for="horario in lista_horarios" :key="horario.id" v-bind:value="horario.id">
                        <b>Inicio de la reserva:</b> {{ horario.horaini}} <br />
                        
                      </td>-->
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
                              data-toggle="modal"
                              data-target="#modal-form-editar"
                              @click="editarReservas(v_reservas)"
                              ><i class="far fa-edit"></i>Editar</a
                            >
                            <a
                              class="dropdown-item"
                              href="#"
                              @click="eliminarReservas(v_reservas)"
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
    <!--<div class="card-footer py-4">
      <nav aria-label="...">
        <paginate-links
          for="vpreservas"
          :classes="{
            ul: ['pagination', 'justify-content-end', 'mb-0'],
            li: 'page-item',
            a: ['page-link', 'bg-warning', 'border-warning'],
          }"
        ></paginate-links>
      </nav>
    </div>-->
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
    console.log("JAM|1: ");
    this.obtenerReservas();
     console.log("JAM 2: ");
    this.listaHorarios();
     console.log("JAM 3: ");
    this.$loading.show({ delay: 0 });
  },
  data() {
    return {
      reservas: {},
      v_error: "",
      lista_reservas: {},
      lista_horarios:{},
      editandoReservas: false,
      paginate: ["vpreservas"],
    };
  },
  methods: {
    guardarReservas() {
      this.$loading.show({ delay: 0 });
      if (this.editandoReservas) {
        axios
          .post("/editarReservas", this.reservas)
          .then((response) => {
            console.log("Reservas Editado");
            Swal.fire("Excelente", "Se ha editado", "success");
            this.obtenerReservas();
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(error.response);
            this.$loading.hide();
          });
        this.editandoReservas = false;
      } else {
        axios
          .post("/guardarReservas", this.reservas)
          .then((response) => {
            console.log("Reserva Registrada");
            Swal.fire("Excelente", "Se ha registrado", "success");
            this.obtenerReservas();
          })
          .catch((error) => {
            this.v_error = error.response.data.errors;
            var mensaje = Object.values(this.v_error);
            Swal.fire("Oh no!", "Ha ocurrido un problema\n" + mensaje, "error");
            console.log(error.response);
            this.$loading.hide();
          });
      }
      this.reservas = {};
    },
    obtenerReservas() {
      this.$loading.show({ delay: 0 });
      axios
        .get("/listaReservas")
        .then((response) => {
          this.lista_reservas = response.data;
          this.$loading.hide();
        })
        .catch((error) => {
          this.v_error = error.response.data.message;
          console.log(error.response);
          this.$loading.hide();
        });
    },
    listaHorarios(){

      //console.log("JAM 4: ");

      axios
        .get("/listaHorarios")
        .then((response) => {
          console.log(response.data);

          this.lista_horarios = response.data;
          //this.$loading.hide();
        })
        .catch((error) => {
          this.v_error = error.response.data.message;
          console.log("JAM 6: " + error.response);
          this.$loading.hide();
        });
    },
    editarReservas(idReservas) {
      this.editandoReservas = true;
      this.reservas = idReservas;
    },
    eliminarReservas(idReservas) {
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
            .delete("/eliminarReservas/" + idReservas.id)
            .then((response) => {
              console.log("Reservas Eliminado");
              Swal.fire("Eliminado!", "La reserva se ha Eliminado.", "success");
              this.$loading.hide();
            })
            .catch((error) => {
              this.v_error = error.response.data.message;
              Swal.fire("Oh no!", "ha ocurrido un problema", "error");
              console.log(error.response);
              this.$loading.hide();
            });
          this.obtenerReservas();
        }
      });
    },
    nuevoReserva() {
      this.editandoReservas = false;
      this.reservas = {};
    },
  },
};

</script>