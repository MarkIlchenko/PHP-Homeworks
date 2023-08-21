<?php
header('Content-Type: tasks.json; charset=utf-8');

enum UserStatus
{
    const COMPLETE_NEW = "виконано";
    const NOT_COMPLETE_NEW = "не виконано";
}
