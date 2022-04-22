    <div class="card margin-bottom">
                    <h5 class="margin-bottom"><?php echo $r['NombreClase'] . " (" . $r['HoraInicio'] . " - " . $r['HoraFin'] . ")";?></h5>
                    <a href="<?php echo $r['EnlaceClase']; ?>" <?php echo $r['EnlaceClase'] == null ? "" : 'target="blank"' ?>><i class="icono fas fa-laptop-code"></i></a>
                    <a href="<?php echo $r['EnlacePortafolio']; ?>" <?php echo $r['EnlacePortafolio'] == null ? "" : 'target="blank"' ?>><i class="icono fas fa-briefcase"></i></a>
                </div>