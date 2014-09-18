<fieldset>
  <div class="row-fluid">
      <div class="span6">
          <label>Tipo de cheque</label>
          <select name="id_tipo_cheque" class="span12">
              <option value="">Seleccione el tipo de cheque...</option>
              <?php foreach($app->getTipoCheques() as $tipoCheque) { ?>
                  <option <?php echo $tipoCheque->id_tipo_cheque == $id_tipo_cheque ? 'selected="selected"':''; ?> value="<?php echo $tipoCheque->id_tipo_cheque; ?>"><?php echo $tipoCheque->detalle; ?></option>
              <?php } ?>
          </select>
          <div class="alert alert-error hide"></div>
      </div>
      <div class="span6">
          <label>Banco</label>
          <select name="id_banco" class="span12">
              <option value="">Seleccione el banco...</option>
              <?php foreach($app->getBancos() as $banco) { ?>
                  <option <?php echo $banco->id_banco == $id_banco ? 'selected="selected"':''; ?> value="<?php echo $banco->id_banco; ?>"><?php echo $banco->nombre; ?> - Sucursal <?php echo $banco->sucursal; ?></option>
              <?php } ?>
          </select>
          <div class="alert alert-error hide"></div>
      </div>

  </div>

  <div class="row-fluid">
      <div class="span6">
          <label>Fecha</label>
          <input type="date" name="fecha" placeholder="Ingrese la fecha..." class="span12" value="<?php echo $fecha; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span6">
          <label>Numero de cheque</label>
          <input type="text" name="numero" placeholder="Ingrese el numero..." class="span12" value="<?php echo $numero; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>
  </div>
</fieldset>