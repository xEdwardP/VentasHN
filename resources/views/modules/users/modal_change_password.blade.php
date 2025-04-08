<form id="frmPassword" onsubmit="return changePassword()">
    <div class="modal fade" id="change_password" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Cambiar Clave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="user_id" name="user_id" hidden>
                    <label for="password">Nueva Clave</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <span class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</span>
                    <button class="btn btn-warning">Actualizar clave</button>
                </div>
            </div>
        </div>
    </div>
</form>