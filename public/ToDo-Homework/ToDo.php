<?php
//Цей код - це програма для ведення списку завдань з можливістю додавання, видалення та перегляду завдань.
require_once ('TaskManager.php');
header('Content-Type: tasks.json; charset=utf-8');

//Data File
$taskTracker = new TaskTracker('tasks.json');

// Usage example:
$taskTracker->interactiveTaskInput();
$tasks = $taskTracker->getTasks();

