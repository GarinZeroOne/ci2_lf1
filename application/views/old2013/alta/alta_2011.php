
<div id="formulario_alta">
    <div align="center" id="formulario">
		Rellene el siguiente formulario para darse de alta en Ligaformula1.com y poder participar en la liga.
        <br><br>
        <span>
            <?php echo $this->validation->error_string; ?>
        </span>
        <table>
            <form method="post" action="<?= site_url() ?>/alta/nuevo_usuario">
                <tr>
                    <td  width="47">Nick*:</td>
                    <td  width="46"><input type="text" name="usuario" /></td>
                </tr>
                <tr>
                    <td width="69">Password*:</td>
                    <td  width="46"><input type="password" name="passwd"/></td>
                </tr>
                <tr>
                    <td width="69">Confirmar password*:</td>
                    <td  width="46"><input type="password" name="passconf"/></td>
                </tr>
                <tr>
                    <td width="69">Email*:</td>
                    <td  width="46"><input type="text" name="email"/></td>
                </tr>
                <tr>
                <tr>
                    <td  width="47">Nombre:</td>
                    <td  width="46"><input type="text" name="nombre" /></td>
                </tr>
                <tr>
                    <td  width="47">Apellidos:</td>
                    <td  width="46"><input type="text" name="apellido" /></td>
                </tr>
                <td  width="47">Ubicacion:</td>
                <td  width="46"><input type="text" name="ubicacion" /></td>
                </tr>
                <tr>
                    <td  width="47">Año nacimiento:</td>
                    <td  width="46"><input type="text" name="ano_nacimiento" /></td>
                </tr>
                <tr>
                    <td width="51" colspan="2" align="center">

                        <div id="control-enviar">
                            <input type="submit" value="Crear nuevo Usuario" />
                        </div>

                    </td>
                </tr>
            </form>
        </table>
        * Campos obligatorios.
    </div>
</div>
