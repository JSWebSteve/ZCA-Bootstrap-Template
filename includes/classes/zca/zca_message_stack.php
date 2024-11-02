<?php
/**
 * messageStack Class.
 *
 * BOOTSTRAP v5.0.0
 *
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Zcwilt 2020 Apr 07 Modified in v1.5.7 $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}
/**
 * messageStack Class.
 * This class is used to manage messageStack alerts
 *
 */
// -----
// Note: Overriding "only" the 'add' method, to ensure that the bootstrap classes are included.
//
class zca_messageStack extends messageStack
{
    function add($class, $message, $type = 'error') 
    {
        global $template, $current_page_base;
        $message = trim($message);
        $duplicate = false;
        if (strlen($message) > 0) {
            if ($type == 'error') {
                $theAlert = array(
                    'params' => 'id="msg-' . $class . '" class="alert alert-danger" role="alert"', 
                    'class' => $class, 
                    'text' => '<i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i><span class="visually-hidden">' . ICON_ERROR_ALT . '</span> ' . $message
                );
            } elseif ($type == 'warning') {
                $theAlert = array(
                    'params' => 'id="msg-' . $class . '" class="alert alert-warning" role="alert"', 
                    'class' => $class, 
                    'text' => '<i class="bi bi-exclamation-circle-fill" aria-hidden="true"></i><span class="visually-hidden">' . ICON_WARNING_ALT . '</span> ' . $message
                );
            } elseif ($type == 'success') {
                $theAlert = array(
                    'params' => 'id="msg-' . $class . '" class="alert alert-success" role="alert"', 
                    'class' => $class, 
                    'text' => '<i class="bi bi-check-circle-fill" aria-hidden="true"></i><span class="visually-hidden">' . ICON_SUCCESS_ALT . '</span> ' . $message
                );
            } elseif ($type == 'caution') {
                $theAlert = array(
                    'params' => 'id="msg-' . $class . '" class="alert alert-info" role="alert"', 
                    'class' => $class, 
                    'text' => '<i class="bi bi-info-circle-fill" aria-hidden="true"></i><span class="visually-hidden">' . ICON_WARNING_ALT . '</span> ' . $message
                );
            } else {
                $theAlert = array(
                    'params' => 'id="msg-' . $class . '" class="alert alert-danger" role="alert"', 
                    'class' => $class, 
                    'text' => $message
                );
            }

            foreach ($this->messages as $next_message) {
                if ($theAlert['text'] == $next_message['text'] && $theAlert['class'] == $next_message['class']) {
                    $duplicate = true;
                    break;
                }
            }
            if (!$duplicate) {
                $this->messages[] = $theAlert;
            }
        }
    }
}
