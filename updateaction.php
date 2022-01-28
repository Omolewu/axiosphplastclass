
<?php
$conn = new mysqli('localhost', 'root', '', 'axiosphp') or die(mysqli_error($conn));

$response = array();
$res = json_decode(file_get_contents('php://input'), true);

if (empty($res['sname'])) {
    $response['name_error'] = 'Name is required';
}
if (empty($res['susername'])) {
    $response['username_error'] = 'Username is required';
}
if (empty($res['semail'])) {
    $response['email_error'] = 'Email is required';
}
if (empty($res['sphone'])) {
    $response['phone_error'] = 'Phone is required';
} else {
    if (!is_numeric($res['sphone'])) {
        $response['phone_error'] = 'Invalid phone number';
    }
}
if (!empty($response)) {
    echo json_encode($response);
} else {

    $sql = "UPDATE registration SET name=?, username=?, email=?, phone=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssi', $res['sname'], $res['susername'], $res['semail'], $res['sphone'], $res['ssid']);
    if ($stmt->execute()) {
        echo json_encode(array('success' => 'Your data has been updated'));
    } else {
        echo json_encode(array('error' => 'Something went wrong, can not execute the query'));
    }
}
?>