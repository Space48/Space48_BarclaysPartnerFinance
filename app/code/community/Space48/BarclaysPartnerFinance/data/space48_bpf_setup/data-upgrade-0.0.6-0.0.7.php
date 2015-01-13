<?php

// start setup
$this->startSetup();

$statuses = array(
    array(
        'status' => 'bpf_dispatched',
        'label'  => 'BPF: Dispatched',
    ),
);

foreach ( $statuses as $status ) {
    $model = Mage::getModel('sales/order_status');
    $model->setStatus($status['status']);
    $model->setLabel($status['label']);
    $model->assignState(Mage_Sales_Model_Order::STATE_PROCESSING);
    $model->save();
}

// end setup
$this->endSetup();
