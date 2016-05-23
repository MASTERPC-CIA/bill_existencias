
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <?php
            echo $this->load->view('login/user_logo', '', TRUE);
            ?>
        </div>

        <ul class="sidebar-menu">
            <li class="header">PRODUCTOS</li>
            <li> <a href="<?= base_url('existencias/index') ?>"><i class="glyphicon glyphicon-list"></i> Ver existencias</a> </li>
        </ul>
    </section>
</aside>

<?php
/*$css = array(
    base_url('resources/css/solicitudes_informes.css')
);
echo csslink($css);*/
?>