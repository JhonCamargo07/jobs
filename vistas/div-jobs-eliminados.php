                <div class="card margin-bottom">
                    <div>
                        <p class="margin-bottom">Esta tarea fue eliminada el <?php echo formatoFecha($j['fechaEliminacion'], " de ");?></p>
                        <h5 class="margin-bottom"><?php echo $j['TituloJob'] . " (" . formatoFechaNum($j['FechaLimite']) . ")";?></h5>
                        <p class="margin-bottom"><?php echo $j['Descripcion'];?></p>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <input type="hidden" name="idJobE" value="<?php echo $j['IDJobEPK'];?>">
                            <input type="hidden" name="tituloJob" value="<?php echo $j['TituloJob'];?>">
                            <input type="hidden" name="descripcion" value="<?php echo $j['Descripcion'];?>">
                            <input type="hidden" name="fCreacion" value="<?php echo $j['fechaCreacion'];?>">
                            <input type="hidden" name="fLimite" value="<?php echo $j['FechaLimite'];?>">
                            <input type="hidden" name="estadoJob" value="<?php echo $j['EstadoJob'];?>">
                            <input type="hidden" name="idUsuarioPK" value="<?php echo $j['IDUsuarioFK'];?>">

                            <input type="submit" name="restablecerJob" value="<?php echo $mensajeTarea;?>" class="btn <?php echo $boton;?>">
                            <!-- <button type="submit" name="updateEstado" class="btn btn-success">Ya está terminada</button> -->
                        </form>
                    </div>
                </div>