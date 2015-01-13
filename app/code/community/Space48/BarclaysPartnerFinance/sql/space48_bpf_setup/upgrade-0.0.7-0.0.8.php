<?php

// start setup
$this->startSetup();

// get table
$table = $this->getTable('space48_bpf/application');

// build sql
$sql = "
    ALTER TABLE `{$table}`   
      CHANGE `send_cancelled_email` `sent_cancelled_email` TINYINT(4) DEFAULT 0  NULL,
      ADD COLUMN `sent_dispatch_notification` TINYINT(4) DEFAULT 0  NULL AFTER `sent_cancelled_email`;
";

// run sql
$this->run($sql);

// end setup
$this->endSetup();
