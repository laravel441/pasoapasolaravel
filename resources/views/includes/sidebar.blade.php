<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            
            <a href="#">
                Menu
            </a>
            
        </li>

        <li>
            <a href="#">Dashboard</a>
        </li>
        <li>
            <a href="#">Shortcuts</a>
        </li>
        <li>
            <a href="#">Overview</a>
        </li>
        <li>
            <a href="#">Events</a>
        </li>
        <li>
            <a href="#">About</a>
        </li>
        <li>
            <a href="#">Services</a>
        </li>
        <li>
            <a href="#">Contact</a>
        </li>
         <li>
                    <a href='http://192.168.46.39/glpi/?usuario={{ base64_encode(Auth::user()->usr_name) }}&password={{ base64_encode(Auth::user()->password) }}&valido=<?php echo base64_encode('T')?>' target="_blank"><span>Mesa de Ayuda</span></a>
         </li>
    </ul>
</div>
<!-- /#sidebar-wrapper -->
