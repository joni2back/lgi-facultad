<?php

if (! $app->isAdmin()) {
    include_once 'content_404.php';
    exit;
}

$suma_debe = $suma_haber = 0;

?>

<div class="container">
    <div class="well">

        <ul class="breadcrumb well">
            <li><a href="index.php?page=home">Principal</a> <span class="divider">/</span></li>
            <li><a href="index.php?page=admin">Administrador</a> <span class="divider">/</span></li>
            <li class="active">Consulta de movimientos</li>
        </ul>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Concepto</th>
                    <th>Forma pago</th>
                    <th>Movimiento</th>
                    <th>Debito</th>
                    <th>Credito</th>
                    <th>IVA</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($app->getMovimientos() as $mov) { ?>
                    <?php $debe_iva = ($mov->debe * $mov->iva / 100) + $mov->debe; ?>
                    <?php $haber_iva = ($mov->haber * $mov->iva / 100) + $mov->haber; ?>
                    <?php $suma_debe += $debe_iva; ?>
                    <?php $suma_haber += $haber_iva; ?>
                    <tr>
                        <td><?php echo $mov->fecha; ?></td>
                        <td><?php echo $mov->first_name . ' ' .$mov->last_name; ?></td>
                        <td><?php echo $mov->concepto_detalle; ?></td>
                        <td><?php echo $mov->forma_pago_detalle; ?></td>
                        <td><?php echo $mov->tipo_movimiento; ?></td>
                        <td><?php echo (int)$debe_iva ? '-'.$debe_iva : ''; ?></td>
                        <td><?php echo (int)$haber_iva ? '+'.$haber_iva : ''; ?></td>
                        <td><?php echo (int)$mov->iva; ?></td>
                        <td><b><?php echo ($suma_haber - $suma_debe); ?></b></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="clearfix">
            <h3 class="pull-right">Saldo total actual: $<?php echo ($suma_haber - $suma_debe); ?></h3>
        </div>
    </div>
</div>

