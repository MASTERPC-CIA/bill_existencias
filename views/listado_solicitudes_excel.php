<?php
header('Content-Type: application/vnd.ms-excel'); // Para trabajar con los navegadores IE y Opera 
header('Content-type: application/x-msexcel'); // Para trabajar con el resto de navegadores
header('Content-Disposition: attachment; filename="reporte_solicitudes.xls"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header("Content-Type: charset=utf-8");
        echo Open('table', array('id'=>'table_sol','class' => "table table-fixed-header"));
//                    echo '<th>ID</th>';
                    echo '<th>Nro.</th>';
    //                echo '<th>CI Paciente</th>';
                    echo '<th>Paciente</th>';
                    echo '<th>Profesional</th>';
                    echo '<th>F. Creaci&oacuten</th>';
                    echo '<th>Prioridad</th>';
                    echo '<th>Servicio</th>';
                    echo '<th>Formulario</th>';
                    echo '<th>Motivo</th>';
                    echo '<th class="actions">Acciones</th>';
                echo '</thead>';
                    echo '<tbody>';
                        if(!empty($data)):
                        foreach ($data as $val) {
                            echo Open('tr');
//                                echo tagcontent('td', $val->sol_id);
                                echo tagcontent('td', $val->sol_form_sec);
                                echo input(array('type'=>'hidden', 'id'=>'id_sol', 'name'=>'id_sol', 'value'=>$val->sol_id));
//                                echo tagcontent('td', $val->pced);
                                echo tagcontent('td', $val->nombres .' '. $val->apellidos);
                                echo tagcontent('td', $val->nom .' '. $val->ape);
                                echo tagcontent('td', $val->sol_fecha_realizacion);
                                echo tagcontent('td', $val->sol_prioridad);
                                echo tagcontent('td', $val->tipo);
                                echo tagcontent('td', $val->tipo_formulario);
                                echo tagcontent('td', $val->sol_motivo, array('style'=>'max-width: 30em'));
                                echo '<td class="actions">';
                                ?>
                                <button type="button"  title = "Imprimir" data-target="print_solicitud" class="btn btn-success fa fa-print" id="ajaxpanelbtn" data-url="<?php echo base_url('laboratorio/index/mostrar_solicitud/'.$val->sol_id)?>"></button>
                                <!--<button type="button"  title = "Editar" data-target="opcion_elegida" class="btn btn-primary fa fa-edit" id="ajaxpanelbtn" data-url="<?php echo base_url('laboratorio/laboratorio/modificar_solicitud/'.$val->sol_id)?>"></button>-->
                                <button type="button" name="btnreportes" title = "Anular" data-target="div1" class="btn btn-danger fa fa-trash-o" id="ajaxpanelbtn" data-url="<?php echo base_url('laboratorio/index/anular_solicitud_view/'.$val->sol_id)?>"></button>
                                <?php
                                echo '</td>';
                            echo Close('tr');
                        }
                    endif;
                echo '</tbody>';
            echo '</table>';