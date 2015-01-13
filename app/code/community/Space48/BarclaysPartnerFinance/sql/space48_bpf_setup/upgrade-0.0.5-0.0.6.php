<?php

// start setup
$this->startSetup();

// get table
$table = $this->getTable('space48_bpf/application');

// build sql
$sql = "
    ALTER TABLE `{$table}`   
      ADD COLUMN `sent_accepted_email`  TINYINT DEFAULT 0  NULL AFTER `proposal_id`,
      ADD COLUMN `sent_referred_email`  TINYINT DEFAULT 0  NULL AFTER `sent_accepted_email`,
      ADD COLUMN `sent_declined_email`  TINYINT DEFAULT 0  NULL AFTER `sent_referred_email`,
      ADD COLUMN `send_cancelled_email` TINYINT DEFAULT 0  NULL AFTER `sent_declined_email`;
";

// run sql
$this->run($sql);

// end setup
$this->endSetup();
