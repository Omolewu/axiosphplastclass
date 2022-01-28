
<?php
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
} else {
    $email = $res['semail'];
    $sql = "SELECT email FROM registration WHERE email =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $select = $stmt->get_result();
    $result = $select->fetch_assoc();
    if ($result) {
        $response['email_error'] = 'Email already exist';
    }
}
if (empty($res['sphone'])) {
    $response['phone_error'] = 'Phone is required';
} else {
    if (!is_numeric($res['sphone'])) {
        $response['phone_error'] = 'Invalid phone number';
    } else {
        $phone = $res['sphone'];
        $sql = "SELECT phone FROM registration WHERE phone =?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $phone);
        $stmt->execute();
        $select = $stmt->get_result();
        $result = $select->fetch_assoc();
        if ($result) {
            $response['phone_error'] = 'Phone already exist';
        }
    }
}
if (!empty($response)) {
    echo json_encode($response);
} else {


    $sql = "INSERT INTO registration (name, username, email, phone) 
    VALUES (?, ?, ?, ?)"; // Sql query to insert data into database
    $stmt = $conn->prepare($sql); // Prepare the sql query
    $stmt->bind_param('ssss', $res['sname'], $res['susername'], $res['semail'], $res['sphone']); // Bind the parameters
    if ($stmt->execute()) { // Execute the sql query
        echo json_encode(array('success' => 'Your data has been submitted'));
    } else {
        echo json_encode(array('error' => 'Something went wrong'));
    }
}
?>