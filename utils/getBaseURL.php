<?php
//-----------------Get Base URL-----------------------------------------------------------------------------------------
function getBaseUrl()
{
  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $host = $_SERVER['HTTP_HOST'];
  $script = $_SERVER['SCRIPT_NAME']; // e.g. /HFE-Store/customer/Main/hfe.php
  $parts = explode('/', trim($script, '/'));

  // Adjust 'HFE-Store' part length (here: 1 level deep)
  $basePath = '/' . $parts[0] . '/';

  return $protocol . $host . $basePath;
}
