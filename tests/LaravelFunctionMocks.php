<?php

/*
 * We simulate the base_path function 
 */
function base_path($path)
{
    return __DIR__.'/../'.$path;
}
