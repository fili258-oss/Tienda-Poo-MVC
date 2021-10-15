<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf8-8" />
        <title>Tienda de Camisetas</title>
        <link rel="stylesheet" href="assets/css/styles.css" type="text/css"/>
    </head>
    <body>
        <div id="container">

            <!-- CABECERA -->
            <header id="header">
                <div id="logo">
                    <img src="assets/img/camiseta.png" alt="camiseta logo"/>
                    <a href="principal.php">
                        Tienda de Camisetas
                    </a>
                </div>
            </header>
            <!-- MENU -->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="#">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Categoria 1
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Categoria 2
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Categoria 3
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Categoria 4
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Categoria 5
                        </a>
                    </li>
                </ul>

            </nav>

            <div id="content">
                <!-- BARRA LATERAL -->
                <aside id="lateral"> 
                    <h3>Entrar a la Web</h3>
                    <div id="login" class="block_aside">
                        <form action="#" method="post">
                            <label for="email">Email</label>
                            <input type="email" name="email">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password">        
                            <input type="submit" name="name" value="Enviar">
                        </form> 
                        <ul>
                            <li><a href="#">Mis pedidos</a></li>
                            <li><a href="#">Gestionar Productos</a></li>
                            <li><a href="#">Gestionar categorias</a></li>
                            <li><a href="#">Mis pedidos</a></li>                          
                        </ul>
                    </div>
                </aside>

                <!-- CONTENIDO CENTRAL -->  
                <div id="central">
                    <h1>Productos Destacados</h1>
                    <div class="product">
                        <img src="assets/img/camiseta.png" alt="camiseta"/>
                        <h2>Camiseta Azul Olgada Ancha</h2>
                        <p>$30.000 Cop</p>
                        <a href="#" class="button">Comprar</a>
                    </div>
                    <div class="product">
                        <img src="assets/img/camiseta.png" alt="camiseta"/>
                        <h2>Camiseta Azul Olgada Ancha</h2>
                        <p>$30.000 Cop</p>
                        <a href="#" class="button">Comprar</a>
                    </div>
                    <div class="product">
                        <img src="assets/img/camiseta.png" alt="camiseta">
                        <h2>Camiseta Azul Olgada Ancha</h2>
                        <p>$30.000 Cop</p>
                        <a href="#" class="button">Comprar</a>
                    </div>

                </div>

            </div>        
            <!-- PIE DE PAGINA -->

            <footer id="footer"> 
                <p>Desarrollado por Marino Botina &copy; <?= date('Y') ?></p>
            </footer>

        </div>
    </body>
</html>


