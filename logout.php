<?php
include_once('include/factory.php');

Auth::logout();
header('location: login.php');