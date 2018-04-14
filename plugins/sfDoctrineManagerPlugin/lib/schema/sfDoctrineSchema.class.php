<?php
class sfDoctrineSchema extends sfDoctrineSchemaRecordCollection
{
  protected
    $_name,
    $_paths = array(),
    $_schemaPaths = array(),
    $_data,
    $_elementClassName = 'sfDoctrineSchemaRecord';

  public function __construct($name, $paths)
  {
    parent::__construct();

    $this->_name  = $name;
    $this->_paths = (array) $paths;

    $this->loadSchema();
  }

  protected function _loadSchemaPaths()
  {
    $schemas = array();
    foreach ($this->_paths as $path)
    {
      $schemas = array_merge($schemas, glob($path . '/*.yml'));
    }
    foreach ($schemas as $schema)
    {
      $array = sfYaml::load($schema);
      if (!empty($array))
      {
        foreach (array_keys($array) as $className)
        {
          if (isset($this[$className]))
          {
            $this->_schemaPaths[$className] = $schema;
          }
        }
      }
    }
  }

  public function loadSchema($paths = null)
  {
    $paths = $paths ? $paths:$this->_paths;
    $this->_paths = $paths;
    $import = new Doctrine_Import_Schema();
    $schema = $import->buildSchema($paths, 'yml');

    foreach ($schema as $name => $definition)
    {
      if (isset($definition['columns']))
      {
        $this[$name] = $definition;
      }
    }

    $this->_loadSchemaPaths();

    // Mark plugin records
    foreach ($this as $name => $record)
    {
      if (isset($this->_schemaPaths[$name]))
      {
        $path = $this->_schemaPaths[$name];
        if (stristr($path, 'plugin'))
        {
          $record->isPlugin(true);
        }
      }
    }
  }

  public function reloadSchema()
  {
    $this->_data = array();
    $this->loadSchema();
  }

  public function getRecords()
  {
    return $this->_data;
  }

  public function getRecord($name)
  {
    if (isset($this->_data[$name]))
    {
      return $this->_data[$name];
    }
    return false;
  }

  public function saveSchema($path = null)
  {
    if ($path)
    {
      foreach ($this as $className => $class)
      {
        $classes[$className] = $class->toArray();
      }
      $this->_writeYamlSchema($path, $classes);
    } else if (!empty($this->_schemaPaths)) {
      $paths = array();
      foreach ((array) $this->_schemaPaths as $className => $path)
      {
        if (!isset($paths[$path]))
        {
          $paths[$path] = array();
        }
        if (isset($paths[$path][$className]))
        {
          $paths[$path][$className] = $this[$className]->toArray();
        }
      }
    }

    $num = count($paths, true) - count($paths);
    if (isset($paths) && !empty($paths) && $num)
    {
      foreach ($paths as $path => $classes)
      {
        $this->_writeYamlSchema($path, $classes);
      }
    } else {
      $path = end($this->_paths);
      $path = is_dir($path) ? $path . '/schema.yml':$path;

      $this->_writeYamlSchema($path, $this->toArray());
    }
    $this->reloadSchema();
  }

  protected function _writeYamlSchema($path, $array)
  {
    $yaml = $this->getYaml($array);
    return file_put_contents($path, $yaml);
  }

  public function getYaml($array = null)
  {
    $array = $array ? $array:$this->toArray();
    return sfYaml::dump($array, 4);
  }
}