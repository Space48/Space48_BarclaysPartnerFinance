<?php

// start setup
$this->startSetup();

$statuses = array(
    array(
        'status' => 'bpf_awaiting_customer',
        'label'  => 'BPF: Awaiting Customer',
    ),
    array(
        'status' => 'bpf_accepted',
        'label'  => 'BPF: Accepted',
    ),
    array(
        'status' => 'bpf_referred',
        'label'  => 'BPF: Referred',
    ),
    array(
        'status' => 'bpf_introducer_pending',
        'label'  => 'BPF: Introducer Pending',
    ),
    array(
        'status' => 'bpf_documents_recieved',
        'label'  => 'BPF: Documents Recieved',
    ),
    array(
        'status' => 'bpf_snagged',
        'label'  => 'BPF: Snagged',
    ),
    array(
        'status' => 'bpf_parked',
        'label'  => 'BPF: Parked',
    ),
);

foreach ( $statuses as $status ) {
    $model = Mage::getModel('sales/order_status');
    $model->setStatus($status['status']);
    $model->setLabel($status['label']);
    $model->assignState(Mage_Sales_Model_Order::STATE_PENDING_PAYMENT);
    $model->save();
}

$statuses = array(
    array(
        'status' => 'bpf_ready_to_deliver',
        'label'  => 'BPF: Ready To Deliver',
    ),
    array(
        'status' => 'bpf_ready_for_live',
        'label'  => 'BPF: Ready For Live',
    ),
    array(
        'status' => 'bpf_active',
        'label'  => 'BPF: Active',
    ),
);

foreach ( $statuses as $status ) {
    $model = Mage::getModel('sales/order_status');
    $model->setStatus($status['status']);
    $model->setLabel($status['label']);
    $model->assignState(Mage_Sales_Model_Order::STATE_PROCESSING);
    $model->save();
}

$statuses = array(
    array(
        'status' => 'bpf_live',
        'label'  => 'BPF: Live',
    ),
);

foreach ( $statuses as $status ) {
    $model = Mage::getModel('sales/order_status');
    $model->setStatus($status['status']);
    $model->setLabel($status['label']);
    $model->assignState(Mage_Sales_Model_Order::STATE_COMPLETE);
    $model->save();
}

$statuses = array(
    array(
        'status' => 'bpf_declined',
        'label'  => 'BPF: Declined',
    ),
    array(
        'status' => 'bpf_not_taken_up',
        'label'  => 'BPF: Not Taken Up',
    ),
    array(
        'status' => 'bpf_bpf_cancelled',
        'label'  => 'BPF: BPF Cancelled',
    ),
    array(
        'status' => 'bpf_customer_cancelled',
        'label'  => 'BPF: Customer Cancelled',
    ),
    array(
        'status' => 'bpf_third_party_cancelled',
        'label'  => 'BPF: Third Party Cancelled',
    ),
);

foreach ( $statuses as $status ) {
    $model = Mage::getModel('sales/order_status');
    $model->setStatus($status['status']);
    $model->setLabel($status['label']);
    $model->assignState(Mage_Sales_Model_Order::STATE_CANCELED);
    $model->save();
}

// end setup
$this->endSetup();
