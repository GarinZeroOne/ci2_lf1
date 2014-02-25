<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Boxes
 */
$lang['boxes_lbl_mi_oficina'] = 'My office';
$lang['boxes_lbl_comprar_pilotos'] = 'Sign drivers';
$lang['boxes_lbl_comprar_equipos'] = 'Buy teams';
$lang['boxes_lbl_stikis'] = 'Stikis';
$lang['boxes_lbl_grupos'] = 'Groups';
$lang['boxes_lbl_mis_pilotos'] = 'My drivers';
$lang['boxes_lbl_mis_equipos'] = 'My teams';
$lang['boxes_lbl_mis_perfil'] = 'My profile';
$lang['boxes_lbl_play_guru'] = 'PLAYtheGURU';
$lang['boxes_ttl_boxes'] = 'Pits';
$lang['boxes_ttl_panel_manager'] = 'Manager panel';
$lang['boxes_ttl_zona_boxes'] = 'Your pits zone';
$lang['boxes_prf_prf1'] = 'This is your pit area. Here you can manage your drivers and your teams.';
$lang['boxes_prf_prf2'] = 'If you do not have drivers, you have to buy them. The system provides all new users an amount of 250,000 € (100,000 € per GP) to start signing drivers or buying teams.';
$lang['boxes_prf_prf3'] = 'As Team Manager you will perform some actions to try to get the best benefits possible in every Grand Prix. From your office you can buy a number of improvements, order and degree depends on your skill as manager.';
$lang['boxes_prf_prf4'] = 'Your <b>goal</b> is to climb in the rankings to the top spot, for this you need Points Manager. The following list will clarify some concepts:';
$lang['boxes_lst_lst1'] = '<b>You earn money and points</b> on your <b>drivers</b> whenever they finish the race. You can see the points and money table in the ' . anchor('inicio/reglas', 'rules', 'style="color:#FF0000"') . '.';
$lang['boxes_lst_lst2'] = '<b>You make money</b> if your teams enter in the <strong>top 5</strong>';
$lang['boxes_lst_lst3'] = 'You can sell any driver or team if not giving you good results. Selling a system driver or team, will lose 50% of its initial value.';
$lang['boxes_lst_lst4'] = 'Each week you will receive € 100,000, regardless of the outcome.';
$lang['boxes_lst_lst5'] = 'You can have a maximum of <b>7 drivers</b> and <b>5 teams</b>.';
$lang['boxes_lst_lst6'] = 'You can stay in the red, ie have negative balance in the bank. The maximum allow negative balance is € 200,000. The negative balance penalized, if you start a weekend with the Points Manager deficit that triggered the GP will be reduced depending on how you approach the € 200,000. Similarly, the surplus will award points EXTRA Manager depending on the amount you have, the more quantity more Points Manager. In the rules you\'ll find a more specific table.';
$lang['boxes_lst_lst7'] = 'Read the ' . anchor('inicio/reglas', 'rules', 'style="color:#FF0000"') . ' before you start buying! For good results it is important to well-known rules and scoring options each driver and each team in a given circuit.';
$lang['boxes_mov_foros'] = 'There has been activity on the forums since you last visited them.';


/*
 * Fichar pilotos
 */

$lang['fich_piloto_lbl_boxes'] = 'Pits';
$lang['fich_piloto_lbl_fich_pilotos'] = 'Sign drivers';
$lang['fich_piloto_prf1'] = 'Here are all the available drivers. To buy top drivers you need have enough money to pay his tab. <strong>Remember that you can have € 200,000 negative balance</strong>';
$lang['fich_piloto_prf2'] = 'The price of the drivers tab varies depending on their race results, just as the selling price varies.';
$lang['fich_piloto_prf3'] = '<strong>The price shown in orange is the price at which the scouts have managed to pilot </strong> . Higher scouts level , will get lower purchase prices.';
$lang['fich_piloto_btn_comprar'] = 'Sign selected drivers';
$lang['fich_piloto_lbl_cartera_pilotos'] = 'Drivers';
$lang['fich_piloto_txt_piloto_existe'] = 'You have chosen a driver who already own!';
$lang['fich_piloto_txt_no_dinero'] = 'You do not have enough money to afford these drivers';
$lang['fich_piloto_txt_max_pilotos'] = 'You can only have a maximum of 7 drivers!';
$lang['fich_piloto_txt_fich_ok'] = 'Drivers successfully purchased.';

/*
 * Comprar_equipos
 */ 
 
$lang['fich_equipo_lbl_boxes'] = 'Pits';
$lang['fich_equipo_lbl_com_equipos'] = 'Buy team';
$lang['fich_equipo_lbl_cartera_equipos'] = 'Teams';
$lang['fich_equipo_prf1'] = 'Here you have available teams.';
$lang['fich_equipo_prf2'] = 'The team sell price varies according to the race results . Buy teams helps increase your profits per race.';
$lang['fich_equipo_btn_comprar'] = 'Buy selected teams';
$lang['fich_equipo_txt_equipo_existe'] = 'You have chosen a team that already own!';
$lang['fich_equipo_txt_no_dinero'] = 'You do not have enough money to afford these teams';
$lang['fich_equipo_txt_max_equipo'] = 'You can only have a maximum of 5 teams!';
$lang['fich_equipo_txt_ok'] = 'Teams successfully purchased.';
 
/*
 * Stikis
 */ 
 
$lang['stiki_lbl_boxes'] = 'Pits';
$lang['stiki_lbl_stiki'] = 'Stikis';
$lang['stiki_prf1'] = 'Increase your chances by doubling the points and the money of your star driver! The pilot who brings a car stiki doubled the points or the money earned, depending on the type of bearing stiki.';
$lang['stiki_prf2'] = 'The STIKI price depends on the mechanics level. With higher level of mechanics you can buy cheaper the stikis.';
$lang['stiki_prf3'] = 'If you cancel a STIKI, you are only refunded 50% of the value of the original STIKI (15,000 € the Stiki Money and 200,000 € for points Stiki)';
$lang['stiki_lst1'] = 'You can only carry two STIKIS per race.';
$lang['stiki_lst2'] = 'A driver can only carry one STIKI.';
$lang['stiki_lbl_desc'] = 'Description';
$lang['stiki_lbl_precio'] = 'Price';
$lang['stiki_txt_comprar_dinero'] = 'Money multiplier STIKI.';
$lang['stiki_txt_comprar_puntos'] = 'Points multiplier STIKI.';
$lang['stiki_ttl_gestion'] = 'STIKI managment'; 
$lang['stiki_txt_comprar1'] = 'Buy '; 
$lang['stiki_txt_comprar2'] = ' multiplier STIKI for the driver '; 
$lang['stiki_lbl_dinero'] = 'money';
$lang['stiki_lbl_puntos'] = 'points';
$lang['stiki_lbl_cancelar'] = 'Cancel';
$lang['stiki_btn_comprar'] = 'Buy'; 
$lang['stiki_ttl_pil_stiki'] = 'Drivers with STIKIS for ';
$lang['stiki_txt_compr_ok'] = 'Stiki successfully purchased, good luck!';
$lang['stiki_txt_piloto_stiki'] = 'The driver has already Stiki selected for this GP.';
$lang['stiki_txt_no_dinero'] = 'You do not have enough money to buy that Stiki.';
$lang['stiki_txt_2_stiki'] = 'You have 2 Stikis purchased, you can not buy more until the next GP.';

/*
* Mis pilotos
*/ 
 
$lang['piloto_lbl_boxes'] = 'Pits';
$lang['piloto_lbl_mis_pilotos'] = 'My drivers';
$lang['piloto_prf1'] = 'Here you can see the drivers that work for you. Each time your drivers get good results your earnings will be increased, and you will have the opportunity to sign more drivers. Here you can also sell the drivers that are not  giving you the results you expected, or simply sell it to buy a better pilot. The last line shows the points that a pilot has been achieved since you signed.';
$lang['piloto_btn_vender'] = 'Sell';
$lang['piloto_txt_vendido_ok'] = 'Driver(s) successfully sold.';

/*
* Mis equipos
*/ 
 
$lang['equipo_lbl_boxes'] = 'Pits';
$lang['equipo_lbl_mis_equipos'] = 'My teams';
$lang['equipo_prf1'] = 'Here you can see the teams that are at your command. In the tab you will see the money earned since you signed the team. You can sell teams that are not giving you the desired results, but this option will make you lose 50% of the original price of the team.';
$lang['equipo_prf2'] = 'You must be clear about the signings you want to do, a misstep can cost you dearly.';
$lang['equipo_btn_vender'] = 'Sell';
$lang['equipo_lbl_precio_venta'] = 'Sell price';
$lang['equipo_lbl_dinero_ganado'] = 'Money earned';
$lang['equipo_txt_vendido_ok'] = 'Team(s) successfully sold.';

/*
* Mi perfil
*/ 
 
$lang['perfil_lbl_boxes'] = 'Pits';
$lang['perfil_lbl_mi_perfil'] = 'My profile';
$lang['perfil_ttl_mis_datos'] = 'My data';
$lang['perfil_lbl_nombre'] = 'Name';
$lang['perfil_lbl_apellidos'] = 'Surnames';
$lang['perfil_lbl_poblacion'] = 'City';
$lang['perfil_lbl_ano_nac'] = 'Birth year';
$lang['perfil_btn_modificar'] = 'Modify';
$lang['perfil_ttl_avatar'] = 'My avatar';
$lang['perfil_ttl_subir_imagen'] = 'Upload Image';
$lang['perfil_lbl_imagen'] = 'Image';