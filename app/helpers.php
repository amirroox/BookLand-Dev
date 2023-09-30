<?php

# Limit Text Fot Show
function limitText($text, $limit = 60): string
{
    $dots = strlen($text) > $limit ? '...' : '';
    return substr($text, 0, $limit) . $dots;
}
