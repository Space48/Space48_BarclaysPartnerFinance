<?php

// start setup
$this->startSetup();

// get table
$table = $this->getTable('space48_bpf/application_checklist');
$applicationTable = $this->getTable('space48_bpf/application');

// build sql
$sql = "
    DROP TABLE IF EXISTS `{$table}`;
    CREATE TABLE `{$table}`(  
      `checklist_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
      `application_id` INT UNSIGNED NOT NULL,
      `status` VARCHAR(64) NOT NULL,
      `satisfied` TINYINT NOT NULL DEFAULT 0,
      `satisfied_on` DATETIME,
      `type` VARCHAR(64) NOT NULL,
      `created_at` DATETIME,
      `updated_at` DATETIME,
      PRIMARY KEY (`checklist_id`),
      UNIQUE INDEX `UNIQUE_CHECKLIST` (`application_id`, `type`),
      CONSTRAINT `FK_SPACE48_BPF_APPLICATION_CHECKLIST_TO_APPLICATION` FOREIGN KEY (`application_id`) REFERENCES `{$applicationTable}`(`application_id`) ON UPDATE NO ACTION ON DELETE CASCADE
    ) ENGINE=INNODB;
";

// run sql
$this->run($sql);

// end setup
$this->endSetup();
