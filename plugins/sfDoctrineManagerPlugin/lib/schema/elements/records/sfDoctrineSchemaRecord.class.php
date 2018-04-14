<?php
class sfDoctrineSchemaRecord extends sfDoctrineSchemaElement
{
  protected
    $_template = array(
        'abstract'    => false,
        'tableName'   => null,
        'className'   => null,
        'actAs'       => array(),
        'attributes'  => array(),
        'columns'     => array(),
        'indexes'     => array(),
        'options'     => array(),
        'relations'   => array(),
        'connection'  => null,
        'inheritance' => array()
      ),
    $_isPlugin = false;

  protected function _clean(array &$data)
  {
    unset($data['templates'], $data['package'], $data['detect_relations'], $data['connectionClassName']);
  }

  public function isPlugin($plugin = null)
  {
    if ($plugin)
    {
      $this->_isPlugin = $plugin;
    }

    return $this->_isPlugin;
  }
}