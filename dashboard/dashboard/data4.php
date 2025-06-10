<?php
include '../../config.php';
// Check if the user is logged in
if (!isset($_SESSION['sb_id'])) {
    echo json_encode([
        'status' => 'not_logged_in',
        'message' => 'User not logged in.'
    ]);
    exit();
}

// get data post
$sb_id = $_SESSION['sb_id'];
$trip_id = $_POST['trip_id'] ?? '';

// get trip name
$stmt = $conn->prepare("SELECT c_name FROM t_trip WHERE id = ? AND c_user = ?");
$stmt->bind_param("si", $trip_id, $sb_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $trip = $result->fetch_assoc();
    $trip_name = $trip['c_name'];
}


// get list of participants
$stmt = $conn->prepare("SELECT id, c_name FROM t_member WHERE c_trip = ?");
$stmt->bind_param("s", $trip_id);
$stmt->execute();
$result = $stmt->get_result();
$participants = [];
while ($row = $result->fetch_assoc()) {
    $participants[] = [
        'id' => $row['id'],
        'name' => htmlspecialchars($row['c_name']) // escape HTML characters
    ];
}

// count total participants
$total_participant = count($participants);
if ($total_participant == 0) {
    $participants = ['No participants found'];
}

// get list destination
$stmt = $conn->prepare("SELECT d.id, d.c_name, d.c_payer, m.c_name AS payer_name
    FROM t_destination d
    LEFT JOIN t_member m ON d.c_payer = m.id
    WHERE d.c_trip = ?");
$stmt->bind_param("s", $trip_id);
$stmt->execute();
$result = $stmt->get_result();
$destinations = [];
while ($row = $result->fetch_assoc()) {
    $destinations[] = [
        'id' => $row['id'],
        'name' => $row['c_name'],
        'payer_id' => $row['c_payer'],
        'payer' => $row['payer_name']
    ];
}

// get all transactions
$stmt = $conn->prepare("SELECT id, c_user, c_trip, c_detail, c_price, c_destination FROM t_transaction WHERE c_trip = ?");
$stmt->bind_param("s", $trip_id);
$stmt->execute();
$result = $stmt->get_result();
$transactions = [];
while ($row = $result->fetch_assoc()) {
    $transactions[] = [
        'id' => $row['id'],
        'user' => $row['c_user'],
        'trip' => $row['c_trip'],
        'detail' => htmlspecialchars($row['c_detail']), // escape HTML characters
        'price' => $row['c_price'],
        'destination' => $row['c_destination']
    ];
}

// get all owners
$stmt = $conn->prepare("SELECT a.c_transaction, a.c_owner, b.c_name FROM t_owner a LEFT JOIN t_member b ON a.c_owner = b.id WHERE b.c_trip = ?");
$stmt->bind_param("s", $trip_id);
$stmt->execute();
$result = $stmt->get_result();
$owners = [];
while ($row = $result->fetch_assoc()) {
    $owners[] = [
        'id' => $row['c_owner'],
        'transaction' => $row['c_transaction'],
        'owner' => htmlspecialchars($row['c_name']), // escape HTML characters
    ];
}



$rekap = [];
foreach ($destinations as $destination) {
    foreach ($transactions as $transaction) {
        if ($transaction['destination'] == $destination['id']) {
            // count how much owner in this transaction
            $owner_count = 0;
            foreach ($owners as $owner) {
                if ($owner['transaction'] == $transaction['id']) {
                    $owner_count++;
                }
            }

            // divide the price by the number of owners
            if ($owner_count > 0) {
                $transaction['price_per_owner'] = $transaction['price'] / $owner_count;
            } else {
                $transaction['price_per_owner'] = 0; // avoid division by zero
            }

            // inject into rekap
            foreach ($owners as $owner) {
                if ($owner['transaction'] == $transaction['id']) {
                    $rekap[] = [
                        array(
                            'payer' => $destination['payer'],
                            'payer_id' => $destination['payer_id'],
                            'detail' => $transaction['detail'],
                            'total_price' => $transaction['price'],
                            'price_per_owner' => $transaction['price_per_owner'],
                            'owner' => $owner['owner'],
                            'owner_id' => $owner['id'],
                            'transaction_id' => $transaction['id'],
                        )
                    ];
                }
            }
        }
    }
}

// rampingkan
$rampingkan = [];
// sum price per owner with parameter payer_id and owner_id
// check first if payer_id and owner_id already exists in $rampingkan, if already exists, sum the price_per_owner
foreach ($rekap as $item) {
    $payer_id = $item[0]['payer_id'];
    $owner_id = $item[0]['owner_id'];
    $price_per_owner = $item[0]['price_per_owner'];

    // check if this payer_id and owner_id already exists in $rampingkan
    $exists = false;
    foreach ($rampingkan as &$ramp) {
        if ($ramp['penerima_id'] == $payer_id && $ramp['pengirim_id'] == $owner_id) {
            // sum the price_per_owner
            $ramp['total_price'] += $price_per_owner;
            $exists = true;
            break;
        }
    }

    // if not exists, add new entry
    if (!$exists) {
        $rampingkan[] = [
            'penerima' => $item[0]['payer'],
            'penerima_id' => $payer_id,
            'pengirim' => $item[0]['owner'],
            'pengirim_id' => $owner_id,
            'total_price' => $price_per_owner,
        ];
    }
}

// debug arrray rampingkan
// echo '<pre>';
// print_r($rampingkan);

// Step 1: Bangun mapping user_id ke nama
$userMap = [];
foreach ($rampingkan as $trx) {
    $userMap[$trx['pengirim_id']] = $trx['pengirim'];
    $userMap[$trx['penerima_id']] = $trx['penerima'];
}

// Step 2: Bangun matriks transaksi
$balances = [];

foreach ($rampingkan as $trx) {
    $from = $trx['pengirim_id'];
    $to = $trx['penerima_id'];
    $amount = $trx['total_price'];

    // Lewati jika pengirim dan penerima sama
    if ($from == $to) continue;

    if (!isset($balances[$from])) $balances[$from] = [];
    if (!isset($balances[$from][$to])) $balances[$from][$to] = 0;

    $balances[$from][$to] += $amount;
}

// Step 3: Netting antar user
$finalTransactions = [];
$processedPairs = [];

foreach ($balances as $from => $toList) {
    foreach ($toList as $to => $amount) {
        // Lewati jika sudah diproses sebelumnya (dalam arah manapun)
        if (isset($processedPairs["$from-$to"]) || isset($processedPairs["$to-$from"])) {
            continue;
        }

        $reverseAmount = $balances[$to][$from] ?? 0;

        if ($reverseAmount > 0) {
            if ($amount > $reverseAmount) {
                $netAmount = $amount - $reverseAmount;
                $finalTransactions[] = [
                    'from' => $from,
                    'to' => $to,
                    'amount' => $netAmount
                ];
            } elseif ($reverseAmount > $amount) {
                $netAmount = $reverseAmount - $amount;
                $finalTransactions[] = [
                    'from' => $to,
                    'to' => $from,
                    'amount' => $netAmount
                ];
            }
            // Tandai kedua arah sebagai sudah diproses
            $processedPairs["$from-$to"] = true;
            $processedPairs["$to-$from"] = true;
        } elseif ($amount > 0) {
            $finalTransactions[] = [
                'from' => $from,
                'to' => $to,
                'amount' => $amount
            ];
            $processedPairs["$from-$to"] = true;
        }
    }
}



// Step 4: Tampilkan hasil akhir
// foreach ($finalTransactions as $trx) {
//     $fromName = $userMap[$trx['from']] ?? $trx['from'];
//     $toName = $userMap[$trx['to']] ?? $trx['to'];
//     echo "$fromName harus membayar ke $toName sebesar {$trx['amount']}<br>";
// }

// check for debugging
// echo '<pre>';
// print_r($rampingkan);
?>

<!-- Title Start -->
<div class="row">
    <div class="col-12">
        <table style="font-size: 10px;">
            <tr>
                <th>Trip</th>
                <td>:</td>
                <td><?= $trip_name ?></td>
            </tr>
            <tr>
                <th>Partisipan</th>
                <td>:</td>
                <td><?= $total_participant ?></td>
            </tr>
        </table>
    </div>
</div>
<!-- Title End -->

<!-- Partisipan Start -->
<div class="row">
    <div class="col-12">
        <table style="font-size: 10px; " class="table table-bordered">
            <thead style="text-align: center;">
                <tr>
                    <th colspan="2">Partisipan</th>
                    <th style="width: 30%;">Total Spend</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($participants as $participant): ?>
                    <tr>
                        <td class="text-danger" style="width: 5%; text-align: center; cursor: pointer;" onclick="deleteParticipant('<?= $participant['id'] ?>')">
                            <i class="fa-solid fa-trash"></i>
                        </td>
                        <td><?= htmlspecialchars($participant['name']) ?></td>
                        <td style="text-align: right;">
                            <?php
                            // Calculate total spend for every participant
                            $total_spend = 0;
                            // loop destinations
                            foreach ($destinations as $destination) {
                                // loop transactions
                                foreach ($transactions as $transaction) {
                                    // check how many owners for this transaction
                                    $transaction_owners = array_filter($owners, function ($owner) use ($transaction) {
                                        return $owner['transaction'] == $transaction['id'];
                                    });
                                    $owner_count = count($transaction_owners);
                                    // if owner count is 0, continue
                                    if ($owner_count == 0) {
                                        continue;
                                    }
                                    // if transaction is for this destination
                                    if ($transaction['destination'] == $destination['id']) {
                                        // check if this participant is an owner of this transaction
                                        foreach ($transaction_owners as $owner) {
                                            if ($owner['owner'] == $participant['name']) {
                                                // add to total spend
                                                $total_spend += $transaction['price'] / $owner_count;
                                            }
                                        }
                                    }
                                }
                            }
                            echo number_format($total_spend, 0);
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: center; font-weight: bold; font-size:1.5em;" onclick="addParticipant('<?= $trip_id ?>')"><i class="fa-solid fa-plus"></i></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- Partisipan End -->

<!-- Pembayaran Start -->
<div class="row">
    <div class="col-12">
        <table class="table table-bordered" style="font-size: 10px; text-align: center;">
            <thead>
                <tr>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($finalTransactions as $transaction): ?>
                    <tr>
                        <td><?= htmlspecialchars($userMap[$transaction['from']]) ?></td>
                        <td><?= htmlspecialchars($userMap[$transaction['to']]) ?></td>
                        <td style="text-align: right;"><?= number_format($transaction['amount'], 0) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Pembayaran End -->

<!-- Destination Start -->
<?php foreach ($destinations as $destination): ?>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered" style="font-size: 10px;">
                <thead>
                    <tr>
                        <th colspan="4" style="font-size: 1.5em;">Destination : <?= htmlspecialchars($destination['name']) ?></th>
                        <th class="text-danger" style="text-align: center; cursor: pointer;" onclick="deleteDestination('<?= $destination['id'] ?>')">
                            <i class="fa-solid fa-trash"></i>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3">Payer : <?= htmlspecialchars($destination['payer']) ?></th>
                        <th colspan="2" style="text-align: right;">
                            <?php
                            // Calculate total price for this destination
                            $total_price = 0;
                            foreach ($transactions as $transaction) {
                                if ($transaction['destination'] == $destination['id']) {
                                    $total_price += $transaction['price'];
                                }
                            }
                            echo 'Total: ' . number_format($total_price, 0);
                            ?>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" style="width: 60%; text-align: center;">Detail</th>
                        <th style="width: 20%; text-align: center;">Owner</th>
                        <th style="width: 10%; text-align: center;">Price</th>
                        <th style="width: 10%; text-align: center;">@</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction): ?>
                        <?php if ($transaction['destination'] == $destination['id']): ?>
                            <tr>
                                <td class="text-success" style="width: 5%; text-align: center; cursor: pointer;" onclick="editTransaction('<?= $transaction['id'] ?>','<?= htmlspecialchars($transaction['detail']) ?>', '<?= $transaction['price'] ?>')">
                                    <i class="fa-solid fa-pencil"></i>
                                </td>
                                <td><?= htmlspecialchars($transaction['detail']) ?></td>
                                <td style="width: 5%; text-align: center;">
                                    <?php
                                    $transaction_owners = array_filter($owners, function ($owner) use ($transaction) {
                                        return $owner['transaction'] == $transaction['id'];
                                    });
                                    if (!empty($transaction_owners)) {
                                        foreach ($transaction_owners as $owner) {
                                            echo '<span class="badge bg-primary" style="margin:1px;">' . htmlspecialchars($owner['owner']) . '</span> ';
                                        }
                                    } else {
                                        echo '<span class="text-muted">-</span>';
                                    }

                                    ?>
                                </td>
                                <td style="text-align: right;"><?= number_format($transaction['price'], 0) ?></td>
                                <td style="text-align: right;">
                                    <?php
                                    // Find owners for this transaction
                                    $transaction_owners = array_filter($owners, function ($owner) use ($transaction) {
                                        return $owner['transaction'] == $transaction['id'];
                                    });
                                    $owner_count = count($transaction_owners);
                                    if ($owner_count > 0 && $transaction['price'] > 0) {
                                        $per_person = $transaction['price'] / $owner_count;
                                        echo number_format($per_person, 0);
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: center; font-weight:bold; font-size:1.5em" onclick="addTransaction('<?= $destination['id'] ?>', '<?= $destination['name'] ?>', '<?= $destination['payer'] ?>')"><i class="fa-solid fa-plus"></i></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
<?php endforeach; ?>
<!-- Destination End -->