<?php
abstract class BasesfDoctrineSchemaUIActions extends sfActions
{
  public function preExecute()
  {
    $this->setLayout(realpath(dirname(__FILE__) . '/../../../') . '/templates/layout');
    if (!$this->schemaManager = $this->getUser()->getAttribute('doctrine_schema_manager'))
    {
      $this->schemaManager = sfDoctrineSchemaManager::getInstance();
      $this->_saveSchemaToSession();
    }
    $this->schema = $this->schemaManager->getSchema();
  }

  protected function _saveSchemaToSession()
  {
    $this->getUser()->setAttribute('doctrine_schema_manager', $this->schemaManager);
  }

  public function executeIndex($request)
  {
  }

  public function getRecord()
  {
    $recordName = $this->getRequest()->getParameter('id');
    if ($recordName)
    {
      $this->record = $this->schema->getRecord($recordName);
      $this->forward404Unless($this->record);
    } else {
      $this->record = new sfDoctrineSchemaRecord(null, array());
    }
    return $this->record;
  }

  public function getRecordForm()
  {
    $this->record = $this->getRecord();
    $data = $this->record->toArray();

    $data['id'] = $data['className'];
    $recordName = $data['className'];

    $this->form = new sfDoctrineSchemaRecordEditForm($data);

    if ($this->elementName = $this->getRequestParameter('elementName'))
    {
      $this->elementForm = $this->getRecordElementForm($recordName, $this->elementName, $data[$this->elementName]); 
      $this->form->embedForm($this->elementName, $this->elementForm);
      unset($this->form['id'], $this->form['abstract'], $this->form['tableName'], $this->form['className'], $this->form['connection']);
    } else {
      $this->form->embedForm('options', new sfDoctrineSchemaOptionForm($data['options']));
      if ($this->getRequest()->getParameter('id'))
      {
        $widgets = $this->form->getWidgetSchema();
      }
    }
    return $this->form;
  }

  public function getRecordElementForm($recordName, $elementName, $defaults = array())
  {
    $handlers = sfDoctrineSchemaManager::getHandlers();
    $handler = isset($handlers[$elementName]) ? $handlers[$elementName]:ucfirst($elementName);

    switch ($handler)
    {
      case 'Index':
      case 'Relation':
      case 'Column':
        $className = 'sfDoctrineSchema' . $handler . 'CollectionForm';
      break;
      default:
        $className = 'sfDoctrineSchema' . $handler . 'Form';
    }

    return new $className($defaults);
  }

  public function executeAdd_record($request)
  {
    $this->form = $this->getRecordForm();
    $this->setTemplate('edit_record');
  }

  public function executeEdit_record($request)
  {
    $this->form = $this->getRecordForm();
    $this->forward404Unless($this->record);
  }

  public function executeSave_record($request)
  {
    $elementName = $request->getParameter('elementName');
    $postData = $request->getParameter('record');
    $elementName = $elementName ? $elementName:'record';

    $this->form = $this->getRecordForm();
    $this->forward404Unless($this->record);

    $this->form->bind($postData);
    if ($this->form->isValid())
    {
      $this->form->saveRecord($this->record);

      if ($request->getParameter('id') && $this->record['className'] != $request->getParameter('id'))
      {
        $id = $request->getParameter('id');
        unset($this->schema[$id]);
      }

      $this->schema[$this->record['className']] = $this->record;
      $this->_saveSchemaToSession();

      $url = 'sfDoctrineSchemaUI/edit_record?id=' . $this->record['className'];
      if ($this->elementName)
      {
        $url .= '&elementName=' . $this->elementName;
      }
      $this->getUser()->setFlash('notice', 'Saved ' . $this->elementName . ' information to session');
      $this->redirect($url);
    }
    $this->getUser()->setFlash('error', 'Could not save.');
    $this->setTemplate('edit_record');
  }

  public function executeReload_schema()
  {
    $this->schemaManager->reloadSchema();
    $this->_saveSchemaToSession();

    $this->getUser()->setFlash('notice', 'Reloaded schema from yaml files on disk');
    $this->redirect($this->getRequest()->getReferer());
  }

  public function executeExport_schema($request)
  {
    if ($request->getParameter('id'))
    {
      $object = $this->getRecord();
    } else {
      $object = $this->schema;
    }
    $this->yaml = $this->schema->getYaml($object->toArray());
    $this->getUser()->setFlash('notice', 'Exported schema to yaml. You can copy the yaml below.');
  }

  public function executeSave_schema()
  {
    $this->schemaManager->saveSchema();

    $this->getUser()->setFlash('notice', 'Saved yaml schema back to disk from session');
    $this->redirect($this->getRequest()->getReferer());
  }

  public function executeAdd_element($request)
  {
    $elementName = $request->getParameter('elementName');
    $this->record = $this->getRecord();
    $handlers = sfDoctrineSchemaManager::getInstance()->getHandlers();
    $handler = $handlers[$elementName];
    $formClassName = 'sfDoctrineSchema' . $handler . 'Form';

    $elementClassName = 'sfDoctrineSchema' . $handler;
    $template = call_user_func_array(array(new $elementClassName('tmp', array()), 'getTemplate'), array());

    $this->form = new $formClassName($template, array(), null, true);
  }

  public function executeSave_element($request)
  {
    $elementName = $request->getParameter('elementName');
    $className = $request->getParameter('id');
    $this->record = $this->getRecord();
    $handlers = sfDoctrineSchemaManager::getInstance()->getHandlers();
    $handler = $handlers[$elementName];
    $formClassName = 'sfDoctrineSchema' . $handler . 'Form';
    $elementClassName = 'sfDoctrineSchema' . $handler;
    $elementCollectionClassName = 'sfDoctrineSchema' . $handler . 'Collection';

    $postData = $this->getRequestParameter(strtolower($handler));

    $keys = array('name', 'alias');
    foreach ($keys as $key)
    {
      if (isset($postData[$key]) && $postData[$key])
      {
        $name = $postData[$key];
        break;
      }
    }

    $this->form = new $formClassName($postData, array(), null, true);
    $this->form->bind($postData);
    if ($this->form->isValid())
    {
      $coll = $this->record[$elementName];
      $coll = $coll instanceof sfDoctrineSchemaElementCollection ? $coll:new $elementCollectionClassName();
      $coll[$name] = new $elementClassName($name, $this->form->getValues());
      $this->record[$elementName] = $coll;
      $this->_saveSchemaToSession();

      if ($request->getParameter('save_and_add'))
      {
        $this->redirect('sfDoctrineSchemaUI/add_element?id=' . $className . '&elementName=' . $elementName);
      } else {
        $this->redirect('sfDoctrineSchemaUI/edit_record?id=' . $className . '&elementName=' . $elementName);
      }
    }
    $this->setTemplate('add_element');
  }

  public function executeDelete_record($request)
  {
    $className = $request->getParameter('id');
    $this->record = $this->getRecord();

    unset($this->schema[$className]);
    $this->_saveSchemaToSession();

    $this->getUser()->setFlash('notice', 'Record successfully deleted from schema');
    $this->redirect('sfDoctrineSchemaUI/index');
  }

  public function executeDelete_all_elements($request)
  {
    $className = $request->getParameter('id');
    $elementName = $request->getParameter('elementName');
    $this->record = $this->getRecord($className);
    $this->record[$elementName] = array();
    $this->_saveSchemaToSession();

    $this->getUser()->setFlash('notice', 'Successfully deleted all ' . $elementName . ' from ' . $className);
    $this->redirect('sfDoctrineSchemaUI/edit_record?id=' . $className . '&elementName=' . $elementName);
  }
}