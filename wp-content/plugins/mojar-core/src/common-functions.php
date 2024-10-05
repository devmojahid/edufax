<?php
function mscore_breadcrumb($options = array())
{
    $breadcrumb = new \MojarCore\Breadcrumb($options);
    echo $breadcrumb->render();
}