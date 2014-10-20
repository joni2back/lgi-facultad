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
      <div class="span4">
          <label>Fecha Emision</label>
          <input type="date" name="fecha_emision" placeholder="Ingrese la fecha..." class="span12" value="<?php echo $fecha_emision; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span4">
          <label>Fecha Cobro</label>
          <input type="date" name="fecha_cobro" placeholder="Ingrese la fecha..." class="span12" value="<?php echo $fecha_cobro; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span4">
          <label>Fecha Vencimiento</label>
          <input type="date" name="fecha_vencimiento" placeholder="Ingrese la fecha..." class="span12" value="<?php echo $fecha_vencimiento; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>
  </div>

  <div class="row-fluid">

      <div class="span6">
          <label>Importe</label>
          <input type="text" name="importe" placeholder="Ingrese el importe..." class="span12" value="<?php echo $importe; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span6">
          <label>Numero de cheque</label>
          <input type="text" name="numero" placeholder="Ingrese el numero..." class="span12" value="<?php echo $numero; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>
  </div>
</fieldset>