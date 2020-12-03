<?php

class DB implements Iterator
{
	private $conn;
	private $select = '*';
	private $where = '';
	public $table = '';
	public $data = [];

	public function __construct()
	{
		$connection_data = simplexml_load_file("database.xml");

		$host = $connection_data->host;
		$user = $connection_data->user;
		$pass = $connection_data->password;
		$db = $connection_data->database;

		$this->conn = new mysqli($host, $user, $pass, $db);

		$this->table = strtolower(\get_called_class()) . "s";

		if ($this->conn->connect_errno > 0) {
			die("Connection failed! " . $this->conn->connect_error);
		}
	}

	function rewind() {
    return reset($this->data);
	}
	
  function current() {
    return (object) current($this->data);
	}
	
  function key() {
    return key($this->data);
	}
	
  function next() {
    return next($this->data);
	}
	
  function valid() {
    return key($this->data) !== null;
	}

	
	public function select(...$fields)
	{
		$this->select = $fields ? implode(', ', $fields) : "*";

		return $this;
	}
	
	public function find($id)
	{
		$sql = "SELECT {$this->select} FROM {$this->table} WHERE id = '{$id}'";
	
		$result = $this->conn->query($sql);
		
		if ($result->num_rows > 0) {
			return $this->data = (object) $result->fetch_assoc();
		}
	
		return null;
	}
	
	public function first()
	{
		$sql = "SELECT {$this->select} FROM {$this->table}" . ($this->where ? " WHERE {$this->where}" : "");

		$result = $this->conn->query($sql);
		
		if ($result->num_rows > 0) {
			return $this->data = (object) $result->fetch_assoc();
		}

		return null;
	}

	public function get()
	{
		return $this->all();
	}

	public function all()
	{
		$sql = "SELECT {$this->select} FROM {$this->table}" . ($this->where ? " WHERE {$this->where}" : "");

		$result = $this->conn->query($sql);
		
		if ($result->num_rows > 0) {
			$this->data = $result->fetch_all(MYSQLI_ASSOC);
		}

		return $this;
	}

	public function where(string $condition)
	{
		$this->where = $condition;

		return $this;
	}

	public function create(array $set)
	{
		$keys = implode(',', array_keys($set));
		$valSet = array_values($set);
		$value = [];

		array_walk($valSet, function($val, $key) use(&$value){
			$value [] = "'$val'";
		});

		$values = implode(',', $value);

		$sql = "INSERT INTO {$this->table} ({$keys}) VALUES ({$values})";

		return $this->conn->query($sql);
	}

	public function update(array $set)
	{
		$fields = [];

		array_walk($set, function($val, $key) use(&$fields) {
			$fields [] = "{$key} = '{$val}'";
		});

		$sql = "UPDATE {$this->table} SET ". implode(', ', $fields) ." WHERE {$this->where}";

		return $this->conn->query($sql);
	}

	public function delete()
	{
		$sql = "DELETE FROM {$this->table} WHERE {$this->where}";

		return $this->conn->query($sql);
	}

	public function toArray()
	{
		return $this->data;
	}
}
