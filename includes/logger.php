<?php
function log_message($message)
{
  $logDir = dirname(__DIR__) . '/logs';

  // Create the directory if it doesn't exist
  if (!is_dir($logDir)) {
    mkdir($logDir, 0755, true);
  }

  // Use the current date for log filename
  $logFile = $logDir . '/app-' . date('Y-m-d') . '.log';

  // Prepend timestamp to message
  $timestamp = date('Y-m-d H:i:s');
  file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}
// Example usage:
// log_message('This is a log message.');