        <header class="card card-2">
            <div class="header-div">
                <!-- <img src="imagenes/variedades-ampi_logo.png" alt="Logo" class="header-img"> -->
                <h1 class="header-titulo">ADSI</h1>
            </div>
            <div class="header-div">
                <?php
                    if(isset($_SESSION['datos']['IDUsuarioPK'])){
                        echo $_SESSION['datos']['NombreUsuario'];
                    }
                ?>
            </div>
        </header>
