<?php
    if ($score >= 4.5 and $score <= 5)
    {
        $grade = "5";
        $message = "Izvrstan";
    } elseif ($score < 4.5 and $score >= 3.5)
    {
        $grade = "4";
        $message = "Vrlo dobar";
    } elseif ($score < 3.5 and $score >= 2.5)
    {
        $grade = "3";
        $message = "Dobar";
    } elseif ($score < 2.5 and $score >= 1.5)
    {
        $grade = "2";
        $message = "Dovoljan";
    } elseif ($score < 1.5)
    {
        $grade = "1";
        $message = "Student nije položio";
    }
    echo $message."\n.";
    echo "$grade\n."
?>