<?php
class sfDoctrineSchemaAccess implements ArrayAccess, Countable, IteratorAggregate
{
  protected
    $_data = array(),
    $_parent;

  public function set($name, $value)
  {
    $this->_data[$name] = $this->create($name, $value);
  }

  public function create($name, $value)
  {
    return $value;
  }

  public function __set($name, $value)
  {
    $this->set($name, $value);
  }

  public function get($name)
  {
    return $this->_data[$name];
  }

  public function __get($name)
  {
    return $this->get($name);
  }

  public function __isset($name)
  {
    return $this->contains($name);
  }

  public function contains($name)
  {
    return isset($this->_data[$name]);
  }

  public function __unset($name)
  {
    return $this->remove($name);
  }

  public function remove($name)
  {
    unset($this->_data[$name]);
  }

  public function offsetExists($offset)
  {
    return $this->contains($offset);
  }

  public function offsetGet($offset)
  {
    return $this->get($offset);
  }

  public function offsetSet($offset, $value)
  {
    if ( ! isset($offset)) {
      $this->add($value);
    } else {
      $this->set($offset, $value);
    }
  }

  public function add($value)
  {
    $this->_data[] = $value;
  }

  public function offsetUnset($offset)
  {
    return $this->remove($offset);
  }

  public function getIterator()
  {
    return new ArrayIterator((array) $this->_data);
  }

  public function count()
  {
    return count($this->_data);
  }

  public function toArray()
  {
    $data = array();
    foreach ($this->_data as $key => $value)
    {
      if ($value instanceof sfDoctrineSchemaAccess)
      {
        $data[$key] = $value->toArray();
      } else {
        $data[$key] = $value;
      }
    }
    return $data;
  }

  public function fromArray(array $array)
  {
    foreach ($array as $key => $value)
    {
      if (is_array($value))
      {
        $this[$key] = $value;
      } else {
        $this[$key] = $value;
      }
      if ($this[$key] instanceof sfDoctrineSchemAccess)
      {
        $this[$key]->setParent($this);
      }
    }
  }
}