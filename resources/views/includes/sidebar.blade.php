<!-- Sidebar -->
<div id="sidebar-wrapper">

    <div id="MainMenu">
      <div>

        <a href="#demo3" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">Soporte</a>

        <div class="collapse" id="demo3">
          <a href="#SubMenu1" class="list-group-item" data-toggle="collapse" data-parent="#SubMenu1">Asignar Requerimientos <i class="fa fa-caret-down"></i></a>
          <div class="collapse list-group-submenu" id="SubMenu1">
            <a href="#" class="list-group-item" data-parent="#SubMenu1">Bandeja de Requerimientos a</a>
            <a href="#" class="list-group-item" data-parent="#SubMenu1">Subitem 2 b</a>
            <a href="#SubSubMenu1" class="list-group-item" data-toggle="collapse" data-parent="#SubSubMenu1">Subitem 3 c <i class="fa fa-caret-down"></i></a>
            <div class="collapse list-group-submenu list-group-submenu-1" id="SubSubMenu1">
              <a href="#" class="list-group-item" data-parent="#SubSubMenu1">Sub sub item 1</a>
              <a href="#" class="list-group-item" data-parent="#SubSubMenu1">Sub sub item 2</a>
            </div>
            <a href="#" class="list-group-item" data-parent="#SubMenu1">Subitem 4 d</a>
          </div>
          <a href="javascript:;" class="list-group-item">Subitem 2</a>
          <a href="javascript:;" class="list-group-item">Subitem 3</a>
        </div>

        <?php
            $proy='';
            $mod='';
            $smod='';
            foreach($menus as $menu){
                if ($proy != $menu->mod_proyecto){
                        echo "<a href='#$menu->mod_proyecto' class='list-group-item list-group-item-success' data-toggle='collapse' data-parent='#MainMenu'>$menu->mod_proyecto</a>";
                        $proy=$menu->mod_proyecto;

                        if ($mod != $menu->mod_nombre){
                            echo "<div class='collapse' id='$menu->mod_proyecto'>
                                                    <a href='#$menu->mod_nombre' class='list-group-item' data-toggle='collapse'>$menu->mod_nombre <i class='fa fa-caret-down'></i></a>
                                  </div>";
                            $mod != $menu->mod_nombre;

                        }

                }




            }
        ?>

      </div>
    </div>
</div>


<!-- /#sidebar-wrapper -->

<!-- /#sidebar-wrapper -->


