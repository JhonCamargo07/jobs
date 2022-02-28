                <div class="card margin-bottom card-flex">
                    <div>
                        <h5 class="margin-bottom"><?php echo $j['TituloJob'] . " (" . formatoFechaNum($j['FechaLimite']) . ")";?></h5>
                        <p class="margin-bottom"><?php echo $j['Descripcion'];?></p>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo $j['IDJobPK'];?>">
                            <input type="hidden" name="estado" value="<?php echo $j['EstadoJob'];?>">
                            <input type="submit" name="updateEstado" value="<?php echo $mensajeTarea;?>" class="btn <?php echo $boton;?>">
                            <!-- <button type="submit" name="updateEstado" class="btn btn-success">Ya está terminada</button> -->
                        </form>
                    </div>
                    <div class="delete text-right">
                        <a href="newTrabajo.php?id=<?php echo $j['IDJobPK']; ?>"><button class="btn btn-warning"><i class="fas fa-edit"></i></button></a>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo $j['IDJobPK'];?>">
                            <button onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-danger" type="submit" name="deleteJob"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>