<?php 

namespace kernel;

/**
 * Base model class
 * 
 * @property string $table
 * @property array $attributes
 */
abstract class Model
{
    protected $table;
    protected $attributes;

    public function __construct(array $attributes=[]) 
    {
        $this->table = $this->tableName();
        if (!empty($attributes)) $this->fill($attributes);
    }

    public function __set($name, $value): void
    {
        $this->attributes[$name] = $value;
    }

    public function __get($name): mixed
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }

    public function __serialize(): array
    {
        $result = [];
        foreach ($this->attributes as $key => $value)
            if (is_int($key)) continue;
            else $result[$key] = $value;
        return $result;
    }

    final public static function find(int $id): static
    {
        global $db;
        $table = static::tableName();
        $stmt = $db->prepare("SELECT * FROM `{$table}` WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return new static($result);
    }

    final public static function tableName(): string
    {
        $exploded = explode('\\', static::class);
        $raw = array_pop($exploded);
        $raw = preg_replace('/[A-Z]/', '_$0', $raw);

        return substr(strtolower($raw . 's'), 1);
    }

    final public static function create(array $attributes): static 
    {
        $instance = new static($attributes);
        return $instance->save();
    }

    final public function save()
    {
        if ($this->id) $query = $this->updateStatement();
        else $query = $this->insertStatement();

        global $db;
        $db->query($query);

        return $this;
    }

    final protected function insertStatement(): string
    {
        $table = self::tableName();
        $query = "INSERT INTO `{$table}` ";
        $columns = "(";
        $values = " VALUES (";
        foreach ($this->attributes as $key => $value) 
        {
            $columns .= "`{$key}`, ";
            if (is_string($value)) $values .= "'{$value}', ";
            else if (is_bool($value)) {
                $value = (int) $value;
                $values .= "{$value}, ";
            }
            else $values .= "{$value}, ";
        }
        $columns = substr($columns, 0, -2) . ')';
        $values = substr($values, 0, -2) . ')';
        $query .= $columns . $values;

        return $query;
    }

    final protected function updateStatement(): string
    {
        $table = self::tableName();
        $query = "UPDATE `{$table}` SET ";
        $params = '';
        foreach ($this->attributes as $key => $value) 
        {
            $params .= "`{$key}` = ";
            if (is_string($value)) $params .= "'{$value}', ";
            else if (is_bool($value)) {
                $value = (int) $value;
                $params .= "{$value}, ";
            }
            else $params .= "{$value}, ";
        }

        
        $params = substr($params, 0, -2) . ' ';
        $params .= "WHERE `id` = " . $this->id;
        $query .= $params;

        return $query;
    }

    final public function all()
    {
        $query = "SELECT * FROM `{$this->table}`";
        global $db;
        $sth = $db->prepare($query);
        $sth->execute();

        return $sth->fetchAll();
    }

    final protected function hasOne(string $related, string $foreignKey, string $localKey): self
    {
        $relatedTableName = $related::tableName();
        $localValue = $this->$localKey;
        $query = "SELECT * FROM `{$relatedTableName}` WHERE `{$foreignKey}` = $localValue";

        global $db;
        $result = $db->query($query);
        return $result[0];
    }

    final protected function hasMany(string $related, string $foreignKey, string $localKey): array
    {
        $relatedTableName = $related::tableName();
        $localValue = $this->$localKey;
        $query = "SELECT * FROM `{$relatedTableName}` WHERE `{$foreignKey}` = $localValue";

        global $db;
        $sth = $db->prepare($query);
        $sth->execute();

        return array_map(fn($data) => new $related($data), $sth->fetchAll());
    }

    final protected function fill(array $attributes): void
    {
        foreach ($attributes as $key => $value)
        {
            $this->$key = $value;
        }
    }

    final protected function belongsTo()
    {

    }

    final protected function belongsToMany()
    {

    }

}