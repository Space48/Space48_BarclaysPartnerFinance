<?php

// start setup
$this->startSetup();

// get table
$table = $this->getTable('space48_bpf/application_address');
$applicationTable = $this->getTable('space48_bpf/application');

// build sql
$sql = "
    DROP TABLE IF EXISTS `{$table}`;
    CREATE TABLE `{$table}`(  
      `address_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
      `application_id` INT UNSIGNED NOT NULL,
      `house_number` VARCHAR(32),
      `house_name` VARCHAR(32),
      `flat` VARCHAR(32),
      `street` VARCHAR(64),
      `district` VARCHAR(64),
      `town` VARCHAR(64),
      `county` VARCHAR(32),
      `postcode` VARCHAR(10),
      PRIMARY KEY (`address_id`, `application_id`),
      CONSTRAINT `FK_SPACE48_BPF_APPLICATION_ADDRESS_TO_APPLICATION` FOREIGN KEY (`application_id`) REFERENCES `{$applicationTable}`(`application_id`) ON UPDATE NO ACTION ON DELETE CASCADE
    ) ENGINE=INNODB;
";

// run sql
$this->run($sql);

// end setup
$this->endSetup();
