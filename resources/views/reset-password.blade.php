<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{ env('APP_NAME') }} | Reset Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Reset Password</h2>
  @include('flash-message')
  <form method="post" action="">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="email">New Password</label>
      <input type="password" class="form-control" id="new_password" placeholder="New Password" name="new_password">
    </div>
    <div class="form-group">
      <label for="pwd">Confirm Password:</label>
      <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirm_password">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
</body>
</html>
