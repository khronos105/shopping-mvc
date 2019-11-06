<?php
    global $msg;

    if ($msg->hasMessages()) {
        $msg->setMsgWrapper("<div class='alert-wrapper'><div class='alert-holder'><div class='%s'>%s</div></div></div>");
        $msg->display();
    }