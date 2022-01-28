<!doctype html>
<html lang="en">

<head>
    <titlePHP with Axios Revision</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            .card {
                box-shadow: 5px 1px black;

            }
        </style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div id="data" class="text-success"></div>
                <div id="error" class="text-danger"></div>
                <div class="card pt-5 pl-4">
                    <h4 class="card-title">Registration</h4>
                    <div class="card-body">
                        <div class="container">
                            <form id="submitData">
                                <div class="form-group">
                                    <label for="inputName" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Your Name">
                                    <small id="nameErr" class="form-text text-danger"></small>

                                </div>
                                <div class="form-group">
                                    <label for="">User name</label>
                                    <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="Enter your username">
                                    <small id="usernameErr" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="Email">
                                    <small id="emailErr" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control" name="number" id="phone" aria-describedby="helpId" placeholder="">
                                    <small id="phoneErr" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('submitData').addEventListener('submit', function(e) {
                e.preventDefault(); /*To prevent the deault form action*/
                let name = document.getElementById('name').value;
                let username = document.getElementById('username').value;
                let email = document.getElementById('email').value;
                let phone = document.getElementById('phone').value;
                // if (name == '' || username == '' || email == '' || phone == '') {
                //     alert('Please fill all the fields');
                // } else {
                axios.post('action.php', {
                        sname: name,
                        susername: username,
                        semail: email,
                        sphone: phone,
                    })
                    .then(function(response) {

                        if (response.data.name_error) {
                            document.getElementById('nameErr').innerHTML = response.data.name_error;
                        }
                        if (response.data.username_error) {
                            document.getElementById('usernameErr').innerHTML = response.data.username_error;
                        }
                        if (response.data.email_error) {
                            document.getElementById('emailErr').innerHTML = response.data.email_error;
                        }
                        if (response.data.phone_error) {
                            document.getElementById('phoneErr').innerHTML = response.data.phone_error;
                        }
                        if (response.data.success) {
                            document.getElementById('data').innerHTML = response.data.success;
                            window.location.href = 'admin.php';
                        }
                        if (response.data.error) {
                            document.getElementById('data').innerHTML = response.data.error;
                        }

                        //document.getElementById('data').innerHTML = response.data;
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }


            /*}*/


        );
    </script>
</body>

</html>