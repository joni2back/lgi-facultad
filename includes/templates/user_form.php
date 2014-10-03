<fieldset>
  <div class="row-fluid">
      <div class="span4">
          <label>Tipo de usuario</label>
          <select name="id_role" class="span12">
              <option value="">Seleccione el rol...</option>
              <?php foreach($app->getRoles() as $role) { var_dump($app->getRoles());?>
                  <option <?php echo $role->id_role == $id_role ? 'selected="selected"':''; ?> value="<?php echo $role->id_role; ?>"><?php echo $role->name; ?></option>
              <?php } ?>
          </select>
          <div class="alert alert-error hide"></div>
      </div>
      <div class="span4">
          <label>Nombre de usuario</label>
          <input type="text" name="username" placeholder="Ingrese el usuario..." class="span12" value="<?php echo $username; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span4">
          <label>Contrase&ntilde;a</label>
          <input type="password" name="password" placeholder="Ingrese el password..." class="span12" value=""/>
          <div class="alert alert-error hide"></div>
      </div>
  </div>

  <div class="row-fluid">
      <div class="span4">
          <label>Nombre</label>
          <input type="text" name="first_name" placeholder="Ingrese el nombre..." class="span12" value="<?php echo $first_name; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span4">
          <label>Apellido</label>
          <input type="text" name="last_name" placeholder="Ingrese el apellido..." class="span12" value="<?php echo $last_name; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>

  </div>

</fieldset>
