<?php

    function show($str)
    {
        echo htmlentities($str, ENT_QUOTES, 'UTF-8');
    }