<?php

// start setup
$this->startSetup();

// get table
$table = $this->getTable('space48_bpf/application');

// build sql
$sql = "
    DROP TABLE IF EXISTS `{$table}`;
    CREATE TABLE `{$table}`(  
      `application_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
      `order_id` INT UNSIGNED NOT NULL,
      `token` VARCHAR(36),
      `proposal_id` INT UNSIGNED,
      `created_at` DATETIME,
      `updated_at` DATETIME,
      PRIMARY KEY (`application_id`),
      CONSTRAINT `FK_BPF_APPLICATION_TO_ORDER` FOREIGN KEY (`order_id`) REFERENCES `sales_flat_order`(`entity_id`) ON UPDATE NO ACTION ON DELETE CASCADE
    ) ENGINE=INNODB;
";

// run sql
$this->run($sql);

// end setup
$this->endSetup();
