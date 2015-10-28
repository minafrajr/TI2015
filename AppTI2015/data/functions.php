<?php
function getErrorMessage()
{
    $errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : null;
    unset($_SESSION['errorMessage']);
    return $errorMessage;
}

function setErrorMessage($errorMessage)
{
    $_SESSION['errorMessage'] = $errorMessage;
}

function getSuccessMessage()
{
    $successMessage = isset($_SESSION['successMessage']) ? $_SESSION['successMessage'] : null;
    unset($_SESSION['successMessage']);
    return $successMessage;
}

function setSuccessMessage($successMessage)
{
    $_SESSION['successMessage'] = $successMessage;
}

function redirect($url)
{
    header("Location: {$url}", true, 302);
    exit;
}