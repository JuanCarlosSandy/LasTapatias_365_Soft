<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">

                    <li @click="menu=42" class="nav-item">
                        <a class="nav-link active" href="#"><i class="fa fa-dashboard"></i> ESCRITORIO</a>
                    </li>
                    <li class="nav-title">
                        Operaciones
                    </li>

                    <!--Menu Restaurante-->

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-briefcase"  ></i> RESTAURANTE</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=13" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Inf. Local</a>
                            </li>
                            <li @click="menu=14" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Mis Sucursales</a>
                            </li>
                            <!--<li @click="menu=52" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Deliverys</a>
                            </li>-->
                        </ul>
                    </li>

                    <!--Menu Ventas-->

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-shopping-cart"></i> VENTAS</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=16" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Apertura/Cierre Caja</a>
                            </li>
                            <li @click="menu=39" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Vender</a>
                            </li>
                            <!--<li @click="menu=6" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Clientes</a>
                            </li>-->
                            <li @click="menu=49" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Reporte Ventas</a>
                            </li>
                        </ul>
                    </li>

                    <!--Menu Compras-->

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-shopping-bag"></i> COMPRAS</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Comprar</a>
                            </li>
                            
                        </ul>
                    </li>

                    <!--Menu Inventario-->

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-file-text"></i> INVENTARIO</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=24" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Mis Almacenes</a>
                            </li>
                            <li @click="menu=25" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Mi Inventario</a>
                            </li>
                        </ul>
                    </li>

                    <!--Menu-->

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-tags"></i> ARMA TU ORDEN</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=46" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Tacos</a>
                            </li>
                            <li @click="menu=47" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Categoria</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-cutlery"></i> OTRO MENU</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=2" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Productos</a>
                            </li>
                            <li @click="menu=1" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Categoria</a>
                            </li>
                            <li @click="menu=4" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Proveedores</a>
                            </li>
                            <!--<li @click="menu=27" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Medidas</a>
                            </li>-->
                        </ul>
                    </li>

                    <!--Menu Reportes-->

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-line-chart"></i> REPORTES</a>
                        <ul class="nav-dropdown-items">

                            <li @click="menu=50" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Ventas Detallado</a>
                            </li>

                            <li @click="menu=51" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Inventario</a>
                            </li>
                        </ul>
                    </li>


                    <!--Menu Usuarios-->

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-lock"></i> ACCESOS</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=7" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-list" style="font-size: 11px;"></i> Usuarios</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>