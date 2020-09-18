<br>
<button type="button" class="btn btn-outline-dark" data-toggle="collapse" data-target="#demo">Filtros</button>

<!-- Button trigger modal -->
<button title="Agregar" data-trigger="hover" type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#exampleModal" style="float:right">
  <i class="fas fa-user-plus"></i>
</button>
<br><br>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form action="../../../../mvc/controller/empleado/guardar.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">cedula</label>
            <input autocomplete="off" type="number" name="cedula" class="form-control" maxlength="10" required="true" placeholder="Enter cedula">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">nombre</label>
            <input autocomplete="off" type="text" name="nombre" class="form-control" maxlength="30" required="true" placeholder="Enter nombre">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">apellido</label>
            <input autocomplete="off" type="text" name="apellido" class="form-control" maxlength="30" required="true" placeholder="Enter apellido">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">correo</label>
            <input autocomplete="off" type="email" name="correo" class="form-control" maxlength="50" required="true" placeholder="Enter correo">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">telefono</label>
            <input autocomplete="off" type="text" name="telefono" class="form-control" maxlength="12" required="true" placeholder="Enter telefono" pattern="[0-9]{1,10}">
          </div>


          <div class="form-group">
            <label for="exampleInputEmail1">Cargo</label>
            <select name="cargo" value="" class="form-control">
              <option value="administrador">administrador</option>
              <option value="Coordinador de rutas">Coordinador de rutas</option>
              <option value="conductor">conductor</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">estado</label>
            <select name="estado" value="" class="form-control">
              <option value="1">activo</option>
              <option value="0">inactivo</option>
            </select>
          </div>

          <h3>Usuario</h3>

          <div class="form-group">
            <label for="exampleInputEmail1">perfil</label>
            <select name="perfil" value="" class="form-control">
              <option value="1">administrador</option>
              <option value="2">Coordinador de rutas</option>
              <option value="3">conductor</option>
            </select>
          </div>



          <div class="form-group">
            <label for="exampleInputEmail1">usuario</label>
            <input type="text" autocomplete="off" name="usuario" class="form-control" maxlength="64" required="true" placeholder="Enter usuario">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">clave</label>
            <input type="password" autocomplete="off" name="clave" class="form-control" maxlength="64" required="true" placeholder="Enter clave">
          </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div id="demo" class="collapse">
  <form method="POST">
    <div class="input-group ">
      <select name="mostrar" id="inputState" class="form-control btn-outline-dark">
        <option value="" disabled selected>activos o inactivos</option>
        <option value="todos">todos</option>
        <option value="1">activos</option>
        <option value="0">inactivo</option>
      </select>
      <div class="input-group-append">
        <button class="btn btn-dark" type="submit"><i class="far fa-paper-plane btn-dark"></i></button>
      </div>
    </div>
  </form>
  <br>
  <input class="form-control btn-link" id="myInput" type="text" placeholder="Search..">
</div>