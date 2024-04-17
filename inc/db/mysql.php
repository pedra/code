<?php
// namespace db;
class Mysql
{
	private $pdo = null;
	private $stmt = null;
	public $error;

	private $env;

	function __construct()
	{
		$this->env = parse_ini_file(ROOT_DB . "/.env");
		$this->pdo = new \PDO(
			"mysql:host=" . $this->env['DB_HOST'] .
			";dbname=" . $this->env['DB_NAME'] .
			";charset=" . $this->env['DB_CHARSET'],
			$this->env['DB_USER'],
			$this->env['DB_PASSWORD'],
			[
				\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
				\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
			]
		);
	}

	function __destruct()
	{
		if ($this->stmt !== null) $this->stmt = null;
		if ($this->pdo !== null) $this->pdo = null;
	}

	function query($sql, $data = null): array | null
	{
		$this->stmt = $this->pdo->prepare($sql);
		$this->stmt->execute($data);

		$res = [];
		while ($r = $this->stmt->fetch()) {
			$res[] = $r;
		}

		return $res;
	}
}