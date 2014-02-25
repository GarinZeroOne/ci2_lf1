<?
/**
  * Debug Helper
  *
  * Muestra el contenido de las variables que recibe e indica en que archivo y linea 
  * se ha puesto el debug.
  *
  * @access        public
  * @param        mixed    variables to be output
  */
function dump()
{
    list($callee) = debug_backtrace();
    $arguments = func_get_args();
    $total_arguments = count($arguments);

    echo '<fieldset style="background: #fefefe !important; border:2px red solid; padding:5px">';
    echo '<legend style="background:lightgrey; padding:5px;">'.$callee['file'].' @ linea: '.$callee['line'].'</legend><pre>';
    $i = 0;
    foreach ($arguments as $argument)
    {
        echo '<br/><strong>Debug #'.(++$i).' de '.$total_arguments.'</strong>: ';
        //var_dump($argument);
		print_r($argument);
    }

    echo "</pre>";
    echo "</fieldset>";
}