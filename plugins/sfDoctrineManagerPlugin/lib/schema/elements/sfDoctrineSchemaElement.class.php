<?php
abstract class sfDoctrineSchemaElement extends sfDoctrineSchemaAccess
{
  protected
    $_elementName;

  protected
    $_template = array();

  public function __construct($name, $definition)
  {
    $this->_elementName = $name;
    $this->_data = (array) $this->_template;

    if (is_array($definition))
    {
      $handlers = sfDoctrineSchemaManager::getHandlers();

      $definition = $definition;
      foreach ($definition as $key => $value)
      {
        if (isset($handlers[$key]))
        {
          $collectionClassName = 'sfDoctrineSchema' . $handlers[$key] . 'Collection';
          $elementClassName = 'sfDoctrineSchema' . $handlers[$key];

          if (class_exists($collectionClassName) && is_array($value))
          {
            $this->_data[$key] = new $collectionClassName($value);
          } else if (class_exists($elementClassName)) {
            $this->_data[$key] = new $elementClassName($key, $value);
          } else {
            $this->_data[$key] = $value;
          }
        } else {
          $this->_data[$key] = $value;
        }
      }
    } else {
      $this->_data[$name] = $definition;
    }
    $this->_clean($this->_data);
  }

  public function getTemplate()
  {
    return $this->_template;
  }

  protected function _clean(array &$data)
  {
    return $data;
  }

  public function getElementName()
  {
    return $this->_elementName;
  }
}