<?php

function create_mysqli()
{
    return new mysqli("localhost", "root", "", "webbsaekerhet");
}