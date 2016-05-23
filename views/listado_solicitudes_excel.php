<?php
header('Content-Type: application/vnd.ms-excel'); // Para trabajar con los navegadores IE y Opera 
header('Content-type: application/x-msexcel'); // Para trabajar con el resto de navegadores
header('Content-Disposition: attachment; filename="reporte_solicitudes.xls"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header("Content-Type: charset=utf-8");
echo Open('table', array('id' => 'table_sol', 'class' => "table table-fixed-header"));
echo '<thead>';
echo '<th>CODIGO</th>';
echo '<th>Nombre Producto</th>';
echo '<th>Stock</th>';
echo '<th>Precio</th>';
// echo '<th class="actions">Acciones</th>';
echo '</thead>';
echo '<tbody>';
if (!empty($data)):
    foreach ($data as $val) {
        echo Open('tr');
        echo tagcontent('td class="actions"', $val->codigo);
        echo tagcontent('td', $val->nombreUnico);
        //echo tagcontent('td', $val->stock);
        if ($val->stock == "Disponible") {
            echo tagcontent('td', tagcontent('span', 'DISPONIBLE', array('class' => 'label label-success', 'style' => 'font-size:16px')));
        } else {
            echo tagcontent('td', tagcontent('span', 'NO DISPONIBLE', array('class' => 'label label-warning', 'style' => 'font-size:16px')));
        }
        echo tagcontent('td', "$ " . $val->costopromediokardex);
        /* echo tagcontent('td', $val->stock, array('style' => 'max-width: 30em')); */
        echo '<td class="actions">';
        ?>
        <!--<button type="button"  title = "Imprimir" data-target="print_solicitud" class="btn btn-success fa fa-print" id="ajaxpanelbtn" data-url="<?php echo base_url('laboratorio/index/mostrar_solicitud/' . $val->sol_id) ?>"></button>-->
        <!--<button type="button"  title = "Editar" data-target="opcion_elegida" class="btn btn-primary fa fa-edit" id="ajaxpanelbtn" data-url="<?php echo base_url('laboratorio/laboratorio/modificar_solicitud/' . $val->sol_id) ?>"></button>-->
        <!--<button type="button" name="btnreportes" title = "Anular" data-target="print_solicitud" class="btn btn-danger fa fa-trash-o" id="ajaxpanelbtn" data-url="<?php echo base_url('laboratorio/index/anular_solicitud_view/' . $val->sol_id) ?>"></button>-->
        <?php
        echo '</td>';
        echo Close('tr');
    }
endif;
echo '</tbody>';
echo '</table>';
