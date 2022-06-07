<?php

declare(strict_types=1);

function formatDate(string $date): string
{
    return date("M j, Y", strtotime($date));
}
