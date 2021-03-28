<?php

require_once 'helpers.php';

session_start();
set_session_username(null);
session_destroy();
redirect('index.php');