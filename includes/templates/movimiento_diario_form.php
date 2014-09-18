<fieldset>
  <div class="row-fluid">
      <div class="span4">
          <label>Usuario</label>
          <select name="id_user" class="span12">
              <option value="">Seleccione el usuario...</option>
              <?php foreach($app->getUsers() as $user) { ?>
                  <option <?php echo $user->id_user == $id_user ? 'selected="selected"':''; ?> value="<?php echo $user->id_user; ?>"><?php echo $user->first_name; ?> <?php echo $user->last_name; ?></option>
              <?php } ?>
          </select>
          <div class="alert alert-error hide"></div>
      </div>
      <div class="span4">
          <label>Concepto</label>
          <select name="id_concepto" class="span12">
              <option value="">Seleccione el concepto...</option>
              <?php foreach($app->getConceptos() as $concepto) { ?>
                  <option <?php echo $concepto->id_concepto == $id_concepto ? 'selected="selected"':''; ?> value="<?php echo $concepto->id_concepto; ?>"><?php echo $concepto->detalle; ?></option>
              <?php } ?>
          </select>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span4">
          <label>Forma de pago</label>
          <select name="id_forma_pago" class="span12">
              <option value="">Seleccione la forma de pago...</option>
              <?php foreach($app->getFormasPago() as $formaPago) { ?>
                  <option <?php echo $formaPago->id_forma_pago == $id_forma_pago ? 'selected="selected"':''; ?> value="<?php echo $formaPago->id_forma_pago; ?>"><?php echo $formaPago->detalle; ?></option>
              <?php } ?>
          </select>
          <div class="alert alert-error hide"></div>
      </div>
  </div>

  <div class="row-fluid">
      <div class="span4">
          <label>Fecha</label>
          <input type="date" name="fecha" placeholder="Ingrese la fecha..." class="span12" value="<?php echo $fecha; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span4">
          <label>Debe (decimales separados por puntos)</label>
          <input type="number" step="any" name="debe" placeholder="Ingrese la deuda..." class="span12" value="<?php echo $debe; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span4">
          <label>Haber (decimales separados por puntos)</label>
          <input type="text" name="haber" placeholder="Ingrese el haber..." class="span12" value="<?php echo $haber; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>
  </div>
</fieldset>