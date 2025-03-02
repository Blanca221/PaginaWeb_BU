<?php
/**
 * Clase para gestionar la conexión a la base de datos mediante el patrón Singleton
 * 
 * Esta clase proporciona una única instancia de conexión a la base de datos
 * utilizando PDO para MySQL.
 */
class DB {
	/**
	 * @var PDO|null Instancia única de la conexión a la base de datos
	 */
	protected static $instance;

	/**
	 * Constructor protegido para evitar la creación directa de objetos
	 */
	protected function __construct() {}

	/**
	 * Obtiene la instancia única de la conexión a la base de datos
	 * 
	 * @return PDO Instancia de la conexión a la base de datos
	 * @throws PDOException Si hay un error en la conexión
	 */
	public static function getInstance() {

		if(empty(self::$instance)) {

			$db_info = array(
				"db_host" => "localhost",
				"db_port" => "3306",
				"db_user" => "root",
				"db_pass" => "",
				"db_name" => "tienda_deporte"
            );

			try {
				self::$instance = new PDO("mysql:host=".$db_info['db_host'].';port='.$db_info['db_port'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);  
				self::$instance->query('SET NAMES utf8');
				self::$instance->query('SET CHARACTER SET utf8');

			} catch(PDOException $error) {
				echo $error->getMessage();
			}

		}

		return self::$instance;
	}

}

?>