<?php
abstract class BasesfDoctrineSchemaRecordEditForm extends sfDoctrineSchemaRecordForm
{
  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
    if (isset($taintedValues['actAs']))
    {
      foreach ($taintedValues['actAs'] as $name => $actAs)
      {
        if (!is_array($actAs) && $actAs == 'on')
        {
          $taintedValues['actAs'][$name] = 'on';
        }
        else if (!is_array($actAs))
        {
          $taintedValues['actAs'][$name]['delete'] = 'on';
        }
      }
    }

    parent::bind($taintedValues, $taintedFiles);
  }

  public function saveRecord(sfDoctrineSchemaRecord $record)
  {
    $values = $this->getValues();

    if (isset($values['actAs']))
    {
      foreach ($values['actAs'] as $name => $actAs)
      {
        if (!is_array($actAs) && $actAs == 'on')
        {
          continue;
        }
        else if (!$actAs)
        {
          unset($values['actAs'][$name]);
        }
      }
    }

    if (isset($values['actAs']['Sluggable']['builder']))
    {
      $builder = $values['actAs']['Sluggable']['builder'];
      $values['actAs']['Sluggable']['builder'] = array($builder[1], $builder[2]);
    }

    if (isset($values['attributes']))
    {
      foreach ($values['attributes'] as $name => $value)
      {
        if (Doctrine_Manager::getInstance()->getAttribute($name) == $value)
        {
          unset($values['attributes'][$name]);
        }
      }
    }

    // Remove deleted elements
    $handlers = sfDoctrineSchemaManager::getHandlers();
    foreach ($values as $key => $value)
    {
      if (isset($handlers[$key]))
      {
        foreach ($value as $name => $element)
        {
          if (is_array($element) && isset($element['delete']) && $element['delete'])
          {
            unset($values[$key][$name]);
          } else if (is_array($element) && isset($element['delete']) && !$element['delete']) {
            unset($values[$key][$name]['delete']);
          }
        }
      }
    }

    $record->fromArray($values);
    return $record;
  }
}