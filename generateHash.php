<?php
$hash = password_hash('password',PASSWORD_BCRYPT);
echo $hash;
echo "<br/>".strlen($hash);