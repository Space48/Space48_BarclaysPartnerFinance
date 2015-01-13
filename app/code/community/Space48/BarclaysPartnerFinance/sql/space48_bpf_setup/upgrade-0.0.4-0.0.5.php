<?php

// start setup
$this->startSetup();

// get table
$table = $this->getTable('space48_bpf/application_snag');
$applicationTable = $this->getTable('space48_bpf/application');

// build sql
$sql = "
    DROP TABLE IF EXISTS `{$table}`;
    CREATE TABLE `{$table}`(  
      `snag_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
      `application_id` INT UNSIGNED NOT NULL,
      `description` VARCHAR(240),
      `note` VARCHAR(240),
      `type` VARCHAR(64) NOT NULL,
      `created_at` DATETIME,
      `updated_at` DATETIME,
      PRIMARY KEY (`snag_id`),
      CONSTRAINT `FK_SPACE48_BPF_APPLICATION_SNAG_TO_APPLICATION` FOREIGN KEY (`application_id`) REFERENCES `{$applicationTable}`(`application_id`) ON UPDATE NO ACTION ON DELETE CASCADE
    ) ENGINE=INNODB;
";

// run sql
$this->run($sql);

// end setup
$this->endSetup();
