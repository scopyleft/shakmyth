<?php

/**
 * BaseProfile
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $sf_guard_user_id
 * @property string $first_name
 * @property string $last_name
 * @property clob $biography
 * @property string $photo
 * @property sfGuardUser $User
 * @property Doctrine_Collection $Myths
 * @property Doctrine_Collection $GroupUsers
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method integer             getSfGuardUserId()    Returns the current record's "sf_guard_user_id" value
 * @method string              getFirstName()        Returns the current record's "first_name" value
 * @method string              getLastName()         Returns the current record's "last_name" value
 * @method clob                getBiography()        Returns the current record's "biography" value
 * @method string              getPhoto()            Returns the current record's "photo" value
 * @method sfGuardUser         getUser()             Returns the current record's "User" value
 * @method Doctrine_Collection getMyths()            Returns the current record's "Myths" collection
 * @method Doctrine_Collection getGroupUsers()       Returns the current record's "GroupUsers" collection
 * @method Profile             setId()               Sets the current record's "id" value
 * @method Profile             setSfGuardUserId()    Sets the current record's "sf_guard_user_id" value
 * @method Profile             setFirstName()        Sets the current record's "first_name" value
 * @method Profile             setLastName()         Sets the current record's "last_name" value
 * @method Profile             setBiography()        Sets the current record's "biography" value
 * @method Profile             setPhoto()            Sets the current record's "photo" value
 * @method Profile             setUser()             Sets the current record's "User" value
 * @method Profile             setMyths()            Sets the current record's "Myths" collection
 * @method Profile             setGroupUsers()       Sets the current record's "GroupUsers" collection
 * 
 * @package    shakmyth
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseProfile extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('profile');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('sf_guard_user_id', 'integer', 4, array(
             'type' => 'integer',
             'unique' => true,
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('first_name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('last_name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('biography', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('photo', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'sf_guard_user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Myth as Myths', array(
             'refClass' => 'ContributorMyth',
             'local' => 'profile_id',
             'foreign' => 'myth_id'));

        $this->hasMany('ContributorMyth as GroupUsers', array(
             'local' => 'id',
             'foreign' => 'profile_id'));

        $searchable0 = new Doctrine_Template_Searchable(array(
             'fields' => 
             array(
              0 => 'biography',
             ),
             ));
        $this->actAs($searchable0);
    }
}