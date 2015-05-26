<!-- Sidebar -->
<div class="sidebar-nav">
       <?php
             $proy = '';
             $mod = '';
             $smod = '';
             $count = 0;
             while ( count($menus) > $count ) {
                    // Recorre los Proyectos
                    $menu = $menus[$count++];
                    if ($proy != $menu->mod_proyecto) {
                           echo "<a href='#$menu->mod_proyecto' class='list-group-item list-group-item-success' data-toggle='collapse' data-parent='#sidebar-wrapper'>$menu->mod_proyecto</a>";
                           $proy = $menu->mod_proyecto;
                    }
                    // Recorre los modulos.
                    echo "<div class='collapse' id='$menu->mod_proyecto'>";
                    if ($mod != $menu->mod_nombre) {
                            if ( $menu->mod_nombre!= $menu->smod_nombre) {
                               echo "<a href='#$menu->mod_nombre' class='list-group-item' data-toggle='collapse'>$menu->mod_nombre <i class='fa fa-caret-down'></i></a>";
                               $mod = $menu->mod_nombre;
                            } else {
                                if ($menu->smod_nombre=='Mesa de Ayuda') {
                     ?>

                                <a href ='<?php echo $menu->smod_ruta?>?usuario={{ base64_encode(Auth::user()->usr_name) }}&password={{ base64_encode(Auth::user()->password) }}&valido={{ base64_encode('T') }}'
                                                                         target='_blank' class='list-group-item'><?php echo $menu->smod_nombre?><i class ='fa fa-caret-down'></i></a>
                     <?php
                                 } else {
                     ?>
                                 <a href ='<?php echo $menu->smod_ruta?>' target='_blank' class='list-group-item'><?php echo $menu->smod_nombre?><i class ='fa fa-caret-down'></i></a>
                     <?php
                                }
                            }
                    }

                    // Recorre los submodulos.
                    echo   "<div class='collapse list-group-submenu' id='$menu->mod_nombre'>";
                           foreach ( $menus as $submenu ) {
                                  if ($submenu->mod_nombre == $mod){
       ?>

                                        <a href ='<?php echo $menu->smod_ruta?>' class='list-group-item'><?php echo $submenu->smod_nombre?><i class ='fa fa-caret-down'></i></a>
       <?php
                          }
                                }
                                unset($submenu);


                    echo   "</div>";

                    echo "</div>";

             }
       ?>


       </div>


<!-- /#sidebar-wrapper -->
