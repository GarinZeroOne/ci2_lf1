
<div class="row">


	<div class="span6">

		<form class="form-signin" method="post" action="<?php echo site_url(); ?>inicio/login">
        <h1 class="form-signin-heading"><?php echo $this->lang->line('login_titulo');?></h1>
        <input type="text" placeholder="Usuario" class="input-block-level" name="usuario">
        <input type="password" placeholder="Password" class="input-block-level" name="passwd">

        <label class="checkbox">
          <a href="<?php echo site_url(); ?>inicio/recordar_login"><?php echo $this->lang->line('login_txt_olv_pass');?></a>
        </label>
        <input type="submit" value="<?php echo $this->lang->line('login_inicio')?>" class="btn btn-primary btn-large" />
      </form>


	</div>

	<div class="span6">

		<h2><?php echo $this->lang->line('login_txt_ini_sess');?></h2>

		<p><?php echo $this->lang->line('login_prf1');?></p>
		<div class="indent"><a class="minimal-indent" href="<?php echo site_url() ?>alta"><?php echo $this->lang->line('login_reg');?></a></div>

		<div align="center" class="logcar">
			<img src="<?php echo base_url() ?>/img/logincar.jpg" alt="">
		</div>



	</div>


</div>