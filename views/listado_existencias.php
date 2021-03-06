<link rel="stylesheet" href="../resources/css/pagination/jq.css" type="text/css" media="print, projection, screen" />
<link rel="stylesheet" href="../resources/css/pagination/blue/style.css" type="text/css" media="print, projection, screen" />
<script src="../resources/js/pagination/jquery-latest.js"></script>
<!--<script src="../resources/js/pagination/jquery.metadata.js"></script>-->
<script src="../resources/js/pagination/jquery.tablesorter.js"></script>
<script src="../resources/js/pagination/jquery.tablesorter.min.js"></script>
<script src="../resources/js/pagination/jquery.tablesorter.pager.js"></script>
<script type="text/javascript">
    $(function () {
        $("table")
                .tablesorter({widthFixed: true, widgets: ['zebra']})
                .tablesorterPager({container: $("#pager")});
    });
</script>
<?php
/* Boton Imprimir */
//echo tagcontent('button', '<span class="glyphicon glyphicon-print"></span> Imprimir', array('id' => 'printbtn', 'data-target' => 'div_solicitudes_list', 'class' => 'btn btn-default pull-left'));
/* METODO PARA EXPORTA A EXCEL */
/* echo tagcontent('a', '<span class="glyphicon glyphicon-export"></span> Exportar a Excel', 
  array('href' => base_url('laboratorio/index/export_solicitudes_to_excel/'. $id_servicio. '/' . $id_tipo_form .'/'.$paciente_tipo.'/' . $fecha_emision_desde . '/' . $fecha_emision_hasta. '/' . $fecha_realiz_desde. '/' . $fecha_realiz_hasta. '/' . $id_prof_solicita. '/' . $id_paciente),
  'method' => 'post', 'target' => '_blank', 'class' => 'btn btn-success btn-sm')); */

echo Open('div', array('class' => 'col-md-12'));
//$caja_texto = '<input type="text" id="search_sol" placeholder="Ingrese el valor a buscar">';
echo Open('div', array('class' => 'panel panel-primary'));
echo '<span class="pull-left"><strong>LISTADO DE SOLICITUDES --- NUMERO DE REGISTROS ENCONTRADOS: ' . $num_reg . '</strong></span>';
//echo '<span class="pull-right">' . $caja_texto . '</span>';
echo Close('div');

echo Open('div', array('id' => 'div_solicitudes_list', 'class' => 'col-md-12'));
//Div para mostrar el logo en la cabecera para imprimir
echo Open('div', array('id' => 'div_header', 'style' => ''));
echo Close('div');
echo LineBreak(1);
?>
<div id="pager" class="pager">
    <!--<form>-->
    <img src="../resources/js/pagination/icons/first.png" class="first"/>
    <img src="../resources/js/pagination/icons/prev.png" class="previo"/>
    <input type="text" class="pagedisplay"/>
    <img src="../resources/js/pagination/icons/next.png" class="siguiente"/>
    <img src="../resources/js/pagination/icons/last.png" class="last"/>
    <select class="pagesize">
        <option selected="selected"  value="10">10</option>
        <option value="20">20</option>
        <option value="50">50</option>
        <option  value="100">100</option>
    </select>
    <!--</form>-->
</div>

<?php
echo Open('table', array('id' => 'tablesorter', 'class' => "tablesorter", 'cellspacing' => "2", 'width' => "100%")); // 
echo '<thead>';
echo '<tr>';
echo '<th width="10%">CODIGO  </th>';
echo '<th width="60%">Nombre Producto </th>';
echo '<th width="10%">Stock </th>';
echo '<th width="10%">Precio </th>';
echo '<th width="10%">Imagen </th>';

echo '</tr>';
echo '</thead>';
echo '<tbody>';
if (!empty($data)):
    foreach ($data as $val) {

        $imagen = "https://googledrive.com/host/0ByqQkg3INrbzQWR5aXdDWjc5UG8/" . $val->codigo . ".jpg";
        $nombre = "'".$val->nombreUnico."'";
        $link = '<a title="" href="#" onclick="afoto(' . $val->codigo . ', ' . $nombre . ')">Ver</a>';

        echo Open('tr');
        echo tagcontent('td ', $val->codigo);
        echo tagcontent('td', $val->nombreUnico);
        //echo tagcontent('td', $val->stock);
        if ($val->stock == "Disponible") {
            echo tagcontent('td', tagcontent('span', 'DISPONIBLE', array('class' => 'label label-success', 'style' => 'font-size:16px')));
        } else {
            echo tagcontent('td', tagcontent('span', 'NO DISPONIBLE', array('class' => 'label label-warning', 'style' => 'font-size:16px')));
        }
        echo tagcontent('td', "$ " . number_format($val->costopromediokardex, get_settings('NUM_DECIMALES')));
        echo tagcontent('td', $link, array('style' => 'width:10px'));
        /* echo tagcontent('td', $val->stock, array('style' => 'max-width: 30em')); */
        echo Close('tr');
    }
endif;
echo '</tbody>';
echo '</table>';
echo '</div>';
echo Close('div');
?>
<script>

    var ventana;
    var cont = 0;
    function afoto(toLink, nombre) {
        var titulopordefecto = nombre; //get_settings("RAZON_SOCIAL")
        var img = "https://googledrive.com/host/0ByqQkg3INrbzQWR5aXdDWjc5UG8/" + toLink + ".jpg";
        if (cont == 1) {
            ventana.close();
            ventana = null
        }

        ventana = window.open('', 'ventana', 'resizable=yes,scrollbars=no')
        ventana.document.write('<html><head><title>' + titulopordefecto + '</title></head><body style="overflow:hidden" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" scroll="no" onUnload="opener.cont=0"><img src="' + img + '" onLoad="opener.redimensionar(500, 500)" width="500px" heigth="500px">');
        ventana.document.close();
        cont++;
    }
    function redimensionar(ancho, alto) {
        //ventana.resizeTo(ancho + 12, alto + 28);
        ventana.resizeTo(ancho, alto);
        ventana.moveTo((screen.width - ancho) / 2, (screen.height - alto) / 2); //centra la ventana. Eliminar si no se quiere centrar el 
    }
</script>