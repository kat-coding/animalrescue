<?php
echo '

<div class="container-fluid">

    <form action="admin.php" method="POST">
        <div class="row">
            <div class="col-6 mx-auto">
                <h1 class="login-header text-center">Admin Login</h1>
                <div class="form-group">
                    <label for="uname"><b>Username</b></label>
                    <input type="text" class="form-control" placeholder="Enter Username" name="{{@username}}" id="uname" required>
                </div>
                <div class="form-group">
                    <label for="psw"><b>Password</b></label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="{{@password}}" id="psw"  required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" onclick="return checkLogin()">Login</button>
                </div>
            </div>
        </div>
    </form>
</div>';
