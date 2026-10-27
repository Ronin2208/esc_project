<?php
session_start();
session_destroy();
header('Location: /esc_project/public/');
exit;