<?php

/**
 * Class MySQL
 *
 * Classe PHP para conectar e fazer queries MySQL
 *
 *
 * $mysql = new MysqlClass("localhost", "root", "root", "database");
 * $posts = $mysql->query('select * from table;');
 * $number_posts = mysql_num_rows($posts);
 *
 *
 * @author Wildney Brasil <http://devninja.cc>
 * @copyright 2016 Wildney Brasil
 * @license http://www.php.net/license/3_01.txt PHP License 3.01
 */

class MysqlClass
{
  /**
   * Variáveis
   *
   * @var string guarda dados para a classe
   */
  private $_host;
  private $_user;
  private $_password;
  private $_database;

  private $_link;
  private $_db;
  private $_query;
  private $_result;


  /**
   * Atribui um novo valor a $_host, $_user, $_password, $_database durante a instanciação da classe
   *
   * @param string $host, $user, $password, $database é o valor requerido pela classe
   * @return void
   */
  public function __construct( $host, $user, $password, $database )
  {
      $this->_host      = $host;
      $this->_user      = $user;
      $this->_password  = $password;
      $this->_database  = $database;
  }


  /**
   * Conecta ao Servidor
   *
   *
   * @return void
   */
  public function connect()
  {
      $this->_link = mysql_connect( $this->_host, $this->_user, $this->_password );

      if( $this->_link == false ){
        echo "Fail: " . mysql_error();
        die;
      }
      else{

        $this->_db = mysql_select_db( $this->_database, $this->_link );

        if( !$this->_db ){
          echo "Fail: " . mysql_error();
          die;
        }

      }

  }


  /**
   * Desconecta o Servidor
   *
   *
   * @return void
   */
  public function disconnect()
  {
      return mysql_close( $this->_link );
  }


  /**
   * Faz consultas ao Banco de Dados
   *
   * Aceita instruções SQL
   *
   * @param string $query uma instrução SQL para consulta ao Banco de Dados
   * @return resultado da query SQL
   */
  public function query( $query )
  {
      $this->connect();
      $this->_query = $query;

      $this->_result = mysql_query( $this->_query );

      if( $this->_result == false ){
        echo "Fail: " . mysql_error() . "<br>";
        echo "SQL: " . $this->_query;
        $this->disconnect();
        die;
      }
      else{

        $this->disconnect();
        return $this->_result;

      }

  }


}

?>
