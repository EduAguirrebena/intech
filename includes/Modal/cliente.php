<!-- MODAL DIRECCION -->
<div class="modal fade text-left" id="clienteModal" tabindex="-1" role="dialog"
          aria-labelledby="myModalLabel33" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
              role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel33">Datos del cliente </h4>
                      <button type="button" class="close" data-bs-dismiss="modal"
                          aria-label="Close">
                          <i data-feather="x"></i>
                      </button>
                  </div>
                  <form id="clienteAddForm">
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="txtNombreCliente">Nombre</label>
                              <input type="text" name="txtNombreCliente" id="txtNombreCliente" placeholder="Nombre Completo"
                                  class="form-control">
                          </div>
                      </div>
                      <div class="modal-footer row" style="justify-content: space-between;">
                          <button type="button" class="btn btn-danger col-4"
                              data-bs-dismiss="modal"
                              >
                              <i class="bx bx-x d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Cancelar</span>
                          </button>
                          <button type="submit" id="addDireccion" class="btn btn-success ml-1 col-4">
                              <i class="bx bx-check d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Guardar</span>
                          </button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
      <!-- END MODAL DIRECCION -->