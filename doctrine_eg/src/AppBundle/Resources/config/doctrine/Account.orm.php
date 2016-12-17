<?php

use Doctrine\ORM\Mapping\ClassMetadataInfo;

$metadata->setInheritanceType(ClassMetadataInfo::INHERITANCE_TYPE_NONE);
$metadata->customRepositoryClassName = 'AppBundle\Repository\AccountRepository';
$metadata->setChangeTrackingPolicy(ClassMetadataInfo::CHANGETRACKING_DEFERRED_IMPLICIT);
$metadata->mapField(array(
   'fieldName' => 'id',
   'type' => 'integer',
   'id' => true,
   'columnName' => 'id',
  ));
$metadata->mapField(array(
   'columnName' => 'firstName',
   'fieldName' => 'firstName',
   'type' => 'string',
   'length' => '100',
  ));
$metadata->mapField(array(
   'columnName' => 'lastName',
   'fieldName' => 'lastName',
   'type' => 'string',
   'length' => '100',
  ));
$metadata->mapField(array(
   'columnName' => 'emailAddress',
   'fieldName' => 'emailAddress',
   'type' => 'string',
   'length' => '100',
  ));
$metadata->mapField(array(
   'columnName' => 'accountPassword',
   'fieldName' => 'accountPassword',
   'type' => 'string',
   'length' => '100',
  ));
$metadata->mapField(array(
   'columnName' => 'createDate',
   'fieldName' => 'createDate',
   'type' => 'datetime',
  ));
$metadata->mapField(array(
   'columnName' => 'modifiedDate',
   'fieldName' => 'modifiedDate',
   'type' => 'datetime',
  ));
$metadata->mapField(array(
   'columnName' => 'accountStatus',
   'fieldName' => 'accountStatus',
   'type' => 'integer',
  ));
$metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_AUTO);