<?php
abstract class sfDoctrineSchemaElementCollection extends sfDoctrineSchemaAccess
{
  protected $_elementClassName;

  public function __construct(array $elements = array())
  {
    $className = get_class($this);
    if  (!$this->_elementClassName)
    {
      $this->_elementClassName = substr($className, 0, strlen($className) - 10);
    }

    foreach ($elements as $name => $element)
    {
      $this[$name] = $element;
    }
  }

  public function create($name, $value)
  {
    if (!$value instanceof sfDoctrineSchemaElement)
    {
      $className = $this->_elementClassName;
      $value = new $className($name, $value);
    }
    return $value;
  }
}