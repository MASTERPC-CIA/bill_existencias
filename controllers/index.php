<?php

/**
 * Description of index
 *
 * @author MARIUXI
 */
class Index extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->user->check_session();
        $this->load->model('existencias_model');
    }

    public function index() {
        $res_head['productogrupo'] = $this->get_productogrupo();

        $res['view'] = $this->load->view('head_reportes_existencias', $res_head, TRUE);
        $res['slidebar'] = $this->load->view('slidebar', '', TRUE);
        //$res['top_nav_actions'] = $this->load->view('top_nav_actions_existencias', '', TRUE);
        $res['title'] = 'Existencias';
        $this->load->view('common/templates/dashboard_lte', $res);
    }

    public function get_productogrupo() {
        $fields = 'codigo, nombre'; //billing_productogrupo
        $formularios = $this->generic_model->get('billing_productogrupo', null, $fields, null, 0);
        return $formularios;
    }

    public function get_existencias() {
        $this->load->model('existencias_model');

        $product_id = $this->input->post('product_id');
        $lista_form_grupo = $this->input->post('lista_form_grupo');

        $res = $this->existencias_model->get_existencias($product_id, $lista_form_grupo);

        $this->load->view('listado_existencias', $res);
    }

}
