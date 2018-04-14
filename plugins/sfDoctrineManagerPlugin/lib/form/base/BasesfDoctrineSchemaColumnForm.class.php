<?php
abstract class BasesfDoctrineSchemaColumnForm extends sfDoctrineSchemaElementForm
{
  protected $_requiredFields = array(
      'type', 'name'
    );
}