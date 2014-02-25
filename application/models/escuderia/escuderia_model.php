<? 
class Escuderia_model extends CI_Model {
		
	private $ci;
	
    function Escuderia_model()
    {
        parent::__construct();
		$this->ci =& get_instance();
    }
	
	function obtenerPilotos()
	{
		
		// Obtener los datos de los circuitos
		$sql ="SELECT * FROM pilotos";
		$resultado = $this->db->query($sql)->result();
		
		return $resultado;
	}
	
	function insertarEscuderia()
	{
		$sql="INSERT INTO apuesta VALUES (?,?,?,?)";
		$this->db->query($sql,array('',$_SESSION['id_usuario'],$_POST['piloto1'],$_POST['piloto2']));
	}
	
	function comprobarEscuderia(){
		$sql="SELECT * FROM apuesta WHERE id_usuario = ?";
		return $this->db->query($sql,array($_SESSION['id_usuario']))->num_rows();
		
	}
}
?>