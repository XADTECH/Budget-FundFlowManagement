<?php
$hashedPassword = '$2y$10$dimCvsUm71o5gRY3EMhu9u9t56sbcP46ZNxl5AqJED8N9DE9d552i';
$plainPassword = '12345678';

if (password_verify($plainPassword, $hashedPassword)) {
  echo 'Password is valid!';
} else {
  echo 'Invalid password.';
}
?>
