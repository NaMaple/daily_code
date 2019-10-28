<?php
    echo 1;die;

    function muMu($i) {
        $times = $i++;
        if ($i >= 1) {
            return '沐沐小可爱，我想你了/n';
            muMu($times);
        }
    }

    echo muMu(1);