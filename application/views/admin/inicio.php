<div id="mainAdmin">
    <h3>ADMINISTRADOR</h3>
    
    Carga los circuitos del año (Solo ejecutar al inicio del mundial, una vez)

    <form method="post" action="<?= site_url() ?>admin/guardarCircuitos">

        <table>
            <tr>
                <td>Temporada:</td>
                <td>
                    <select name="season">
                        <?php for ($i = 2013; $i <= 2025; $i++): ?>
                            <option value="<?= $i ?>"> <?= $i; ?></option>
                        <?php endfor; ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"> <input type="submit" value="Guardar Circuitos"></td>
            </tr>
        </table>

    </form>

    Guarda los resultados del Gp
    
    <form method="post" action="<?= site_url() ?>admin/guardarResultados">

        <table>
            <tr>
                <td>Temporada:</td>
                <td>
                    <select name="season">
                        <?php for ($i = 2013; $i <= 2025; $i++): ?>
                            <option value="<?= $i ?>"> <?= $i; ?></option>
                        <?php endfor; ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td>Sel.Circuito:</td>
                <td>
                    <select name="gpNumber">
                        <?php
                        foreach ($circuitos as $gp):
                            ?>
                            <option value="<?= $gp->id ?>"> <?= $gp->circuito . " (" . $gp->pais . ")"; ?></option>
                            <?
                        endforeach;
                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center"> <input type="submit" value="Guardar Resultado Gp"></td>
            </tr>
        </table>

        <?php
        echo $msgResultados;
        ?>

    </form>
    
    Modifica los precios con los resultados del Gp
    
    <form method="post" action="<?= site_url() ?>mercado/procesarPreciosPostGp">

        <table>

            <tr>
                <td colspan="2" align="center"> <input type="submit" value="Procesar valor pilotos"></td>
            </tr>
        </table>

        <?php
        echo $msgClasificacion;
        ?>

    </form>
    
    Guarda Clasificacion Mundial
    
    <form method="post" action="<?= site_url() ?>admin/guardarClasificacionMundial">

        <table>

            <tr>
                <td colspan="2" align="center"> <input type="submit" value="Guardar Clasificacion mundial"></td>
            </tr>
        </table>

        <?php
        echo $msgClasificacion;
        ?>

    </form>
    
    <form method="post" action="<?= site_url() ?>admin/cambioValorMovimientos">

        <table>

            <tr>
                <td colspan="2" align="center"> <input type="submit" value="Cambio valor por movimientos de mercado"></td>
            </tr>
        </table>        

    </form>
    
</div>
