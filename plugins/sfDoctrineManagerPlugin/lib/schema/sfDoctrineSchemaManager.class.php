<?php
class sfDoctrineSchemaManager extends sfDoctrineSchemaAccess
{
  protected static
    $_handlers = array(
      'attributes' => 'Attribute',
      'columns'    => 'Column',
      'indexes'    => 'Index',
      'options'    => 'Option',
      'relations'  => 'Relation',
      'actAs'      => 'ActAs',
      'inheritance'=> 'Inheritance'
    ),
    $_instance;

  public function __construct()
  {
    $paths = array();
    $paths[] = sfConfig::get('sf_config_dir') . '/doctrine';

    $plugins = sfContext::getInstance()->getConfiguration()->getPlugins();
    foreach ($plugins as $plugin)
    {
      $path = sfConfig::get('sf_plugins_dir') . '/' . $plugin . '/config/doctrine';
      if (is_dir($path))
      {
        $paths[] = $path;
      }
    }

    $this->loadSchema('main', $paths);
  }

  public static function getHandlers()
  {
    return self::$_handlers;
  }

  public function loadSchema($name, $paths)
  {
    $schema = new sfDoctrineSchema($name, (array) $paths);
    $this[$name] = $schema;
  }

  public function reloadSchema($name = null)
  {
    if ($name)
    {
      $this[$name]->reloadSchema();
    } else {
      foreach ($this as $name => $value)
      {
        $value->reloadSchema();
      }
    }
  }

  public function saveSchema()
  {
    foreach ($this as $schema)
    {
      $schema->saveSchema();
    }
  }

  public function getSchema()
  {
    return $this['main'];
  }

  public static function getInstance()
  {
    if ( ! self::$_instance)
    {
      self::$_instance = new self();
    }
    return self::$_instance;
  }
}