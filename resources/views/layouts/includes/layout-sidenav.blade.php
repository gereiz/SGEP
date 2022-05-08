<?php $routeName = Route::currentRouteName(); ?>



<!-- Layout sidenav -->
<div id="layout-sidenav" class="{{ isset($layout_sidenav_horizontal) ? 'layout-sidenav-horizontal sidenav-horizontal container-p-x flex-grow-0' : 'layout-sidenav sidenav-vertical' }} sidenav bg-sidenav-theme">
    @empty($layout_sidenav_horizontal)
    <!-- Brand demo (see assets/css/demo/demo.css) -->
    <div class="app-brand head_navbar">
        <span class="app-brand-logo demo">
        </span>
            <div class="menu_navbar">
            <a href="#" class="demo-brand-name sidenav-text font-weight-normal ml-2 texto_sidenav">SGEP</a>
            <a href="javascript:void(0)" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
                <i class="ion ion-md-menu align-middle btn_menu"></i>
            </a>
        </div>
    </div>

    <div class="sidenav-divider mt-0"></div>
    @endempty

    <!-- Links -->
    <ul class="sidenav-inner{{ empty($layout_sidenav_horizontal) ? ' py-1' : '' }}">

        <!-- Pessoas -->
        <li class="sidenav-item{{ strpos($routeName, 'dashboards.') === 0 ? ' active open' : '' }}">
            <a href="{{route('home')}}" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-md-person-add"></i><div>Pessoas</div></a>
            
            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'dashboards.dashboard-1' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Cadastro de Usuários</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'cadastra.cliente' ? ' active' : '' }}">
                    <a href="{{ route('cadastra.cliente') }}" class="sidenav-link"><div>Cadastro de Clientes</div></a>
                </li>
            </ul>
        </li>

        <!-- Painéis -->
        <li class="sidenav-item{{ strpos($routeName, 'layout-examples.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-md-photos"></i><div>Painéis</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'layout-examples.options' ? ' active' : '' }}">
                    <a href="{{route('add_form_outdoor')}}" class="sidenav-link"><div>Cadastro de Painéis</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'layout-examples.helpers' ? ' active' : '' }}">
                    <a href="{{route('outdoor_grid')}}" class="sidenav-link"><div>Relação de Painéis</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'layout-examples.layout-1' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Relação de Painéis disponíveis</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'layout-examples.layout-1-flex' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Relação de Painéis Reservados</div></a>
                </li>
            </ul>
        </li>

        <li class="sidenav-item{{ strpos($routeName, 'layout-examples.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-md-photos"></i><div>Endereços</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'layout-examples.options' ? ' active' : '' }}">
                    <a href="{{ route('cad.cidades') }}" class="sidenav-link"><div>Cadastro de Cidades</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'layout-examples.helpers' ? ' active' : '' }}">
                    <a href="{{ route('cadastra.regiao') }}" class="sidenav-link"><div>Cadastro de Regiões</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'layout-examples.layout-1' ? ' active' : '' }}">
                <a href="{{ route('cadastra.bairro') }}" class="sidenav-link"><div>Cadastro de Bairros</div></a>
                </li>
            </ul>
        </li>

        <!--<li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">ELEMENTS</li>

        <li class="sidenav-item{{ $routeName == 'typography.typography' ? ' active' : '' }}">
            <a href="#" class="sidenav-link"><i class="sidenav-icon ion ion-md-quote"></i><div>Typography</div></a>
        </li>-->

        <!-- UI elements -->
        <!--<li class="sidenav-item{{ strpos($routeName, 'ui.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-md-cube"></i><div>User inteface</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'ui.buttons' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Buttons</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'ui.badges' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Badges</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'ui.button-groups' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Button groups</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'ui.dropdowns' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Dropdowns</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'ui.navs' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Navs</div></a>
                </li>
            </ul>
        </li>-->

        <!-- Relatórios -->
       <li class="sidenav-item{{ strpos($routeName, 'forms.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-md-document"></i><div>Relatórios</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'forms.layouts' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Relatório de Clientes</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'forms.controls' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Relatório de Todos Painéis</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'forms.custom-controls' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Relatório de Painéis Disponíveis</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'forms.input-groups' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Relatório de Painéis Reservados</div></a>
                </li>
            </ul>
        </li>

        <!--  Tables -->
        <!--<li class="sidenav-item{{ strpos($routeName, 'tables.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-md-grid"></i><div>Tables</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'tables.bootstrap' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Bootstrap</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'tables.datatables' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>DataTables</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'tables.bootstrap-table' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Bootstrap table</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'tables.bootstrap-sortable' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Bootstrap Sortable</div></a>
                </li>
            </ul>
        </li>-->

        <!-- Charts -->
        <!--<li class="sidenav-item{{ strpos($routeName, 'charts.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-md-pie"></i><div>Charts</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'charts.gmaps' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>GMaps</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'charts.mapael' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Mapael</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'charts.flot' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Flot.js</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'charts.c3' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>C3.js</div></a>
                </li>
            </ul>
        </li>-->

        <!--  Icons -->
        <!--<li class="sidenav-item{{ strpos($routeName, 'icons.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-ios-heart"></i><div>Icons</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'icons.font-awesome' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Font Awesome 5</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'icons.ionicons' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Ionicons</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'icons.linearicons' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Linearicons</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'icons.openiconic' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Open Iconic</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'icons.stroke7' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Stroke Icons 7</div></a>
                </li>
            </ul>
        </li>-->

        <!--  Miscellaneous -->
        <!--<li class="sidenav-item{{ strpos($routeName, 'misc.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-ios-flask"></i><div>Miscellaneous</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'misc.brand-colors' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Brand colors</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'misc.masonry' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Masonry</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'misc.spinkit' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>SpinKit</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'misc.ladda' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Ladda</div></a>
                </li>
            </ul>
        </li>-->

        <!--<li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">EXTRAS</li>-->

        <!-- Pages -->
        <!--<li class="sidenav-item{{ strpos($routeName, 'pages.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon ion ion-md-document"></i>
                <div>Pages</div>
                <div class="pl-1 ml-auto"><div class="badge badge-primary">59</div></div>
            </a>
            <ul class="sidenav-menu">

                <li class="sidenav-item{{ strpos($routeName, 'pages.articles.') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><div>Articles</div></a>

                    <ul class="sidenav-menu">
                        <li class="sidenav-item{{ $routeName == 'pages.articles.list' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>List</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.articles.edit' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Edit</div></a>
                        </li>
                    </ul>
                </li>

                <li class="sidenav-item{{ strpos($routeName, 'pages.authentication.') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><div>Authentication</div></a>

                    <ul class="sidenav-menu">
                        <li class="sidenav-item{{ $routeName == 'pages.authentication.login-v1' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Login v1</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.authentication.register-v1' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Register v1</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.authentication.login-v2' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Login v2</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.authentication.register-v2' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Register v2</div></a>
                        </li>
                    </ul>
                </li>

                <li class="sidenav-item{{ strpos($routeName, 'pages.education.') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><div>Education</div></a>

                    <ul class="sidenav-menu">
                        <li class="sidenav-item{{ $routeName == 'pages.education.courses-v1' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Courses v1</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.education.courses-v2' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Courses v2</div></a>
                        </li>
                    </ul>
                </li>

                <li class="sidenav-item{{ strpos($routeName, 'pages.e-commerce.') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><div>E-commerce</div></a>

                    <ul class="sidenav-menu">
                        <li class="sidenav-item{{ $routeName == 'pages.e-commerce.product-list' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Product list</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.e-commerce.product-item' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Product item</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.e-commerce.product-edit' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Product edit</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.e-commerce.order-list' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Order list</div></a>
                        </li>
                    </ul>
                </li>

                <li class="sidenav-item{{ strpos($routeName, 'pages.forums.') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><div>Forums</div></a>

                    <ul class="sidenav-menu">
                        <li class="sidenav-item{{ $routeName == 'pages.forums.list' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>List</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.forums.threads' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Threads</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.forums.discussion' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Discussion</div></a>
                        </li>
                    </ul>
                </li>

                <li class="sidenav-item{{ strpos($routeName, 'pages.messages-v1.') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><div>Messages v1</div></a>

                    <ul class="sidenav-menu">
                        <li class="sidenav-item{{ $routeName == 'pages.messages-v1.list' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>List</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.messages-v1.item' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Item</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.messages-v1.compose' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Compose</div></a>
                        </li>
                    </ul>
                </li>

                <li class="sidenav-item{{ strpos($routeName, 'pages.messages-v2.') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><div>Messages v2</div></a>

                    <ul class="sidenav-menu">
                        <li class="sidenav-item{{ $routeName == 'pages.messages-v2.list' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>List</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.messages-v2.item' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Item</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.messages-v2.compose' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Compose</div></a>
                        </li>
                    </ul>
                </li>

                <li class="sidenav-item{{ strpos($routeName, 'pages.messages-v3.') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><div>Messages v3</div></a>

                    <ul class="sidenav-menu">
                        <li class="sidenav-item{{ $routeName == 'pages.messages-v3.list' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>List</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.messages-v3.item' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Item</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.messages-v3.compose' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Compose</div></a>
                        </li>
                    </ul>
                </li>

                <li class="sidenav-item{{ strpos($routeName, 'pages.projects.') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><div>Projects</div></a>

                    <ul class="sidenav-menu">
                        <li class="sidenav-item{{ $routeName == 'pages.projects.list' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>List</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.projects.item' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Item</div></a>
                        </li>
                    </ul>
                </li>

                <li class="sidenav-item{{ strpos($routeName, 'pages.tickets.') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><div>Tickets</div></a>

                    <ul class="sidenav-menu">
                        <li class="sidenav-item{{ $routeName == 'pages.tickets.list' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>List</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.tickets.edit' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Edit</div></a>
                        </li>
                    </ul>
                </li>

                <li class="sidenav-item{{ strpos($routeName, 'pages.users.') === 0 ? ' active open' : '' }}">
                    <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><div>Users</div></a>

                    <ul class="sidenav-menu">
                        <li class="sidenav-item{{ $routeName == 'pages.users.list' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>List</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.users.view' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>View</div></a>
                        </li>
                        <li class="sidenav-item{{ $routeName == 'pages.users.edit' ? ' active' : '' }}">
                            <a href="#" class="sidenav-link"><div>Edit</div></a>
                        </li>
                    </ul>
                </li>

                <li class="sidenav-item{{ $routeName == 'pages.account-settings' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Account settings</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'pages.chat' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Chat</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'pages.clients' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Clients</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'pages.contacts' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>Contacts</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'pages.faq' ? ' active' : '' }}">
                    <a href="#" class="sidenav-link"><div>FAQ</div></a>
                </li>
            </ul>
        </li>-->

        <!--<li class="sidenav-item">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-logo-buffer"></i><div>Complete UI</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item">
                    <a target="_blank" href="#" class="sidenav-link"><div>Base</div></a>
                </li>
                <li class="sidenav-item">
                    <a target="_blank" href="#" class="sidenav-link"><div>Plugins</div></a>
                </li>
                <li class="sidenav-item">
                    <a target="_blank" href="#" class="sidenav-link"><div>Charts</div></a>
                </li>
            </ul>
        </li>-->
        
    </ul>
</div>
<!-- / Layout sidenav -->
