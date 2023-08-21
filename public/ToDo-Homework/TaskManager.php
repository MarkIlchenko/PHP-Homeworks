<?php
//Ця частина коду встановлює заголовок HTTP-відповіді, який вказує, що відповідь має бути у форматі JSON з кодуванням UTF-8. Далі відбувається створення об'єкта TaskTracker
// для взаємодії зі списком завдань. Далі викликається метод interactiveTaskInput(), який запускає інтерактивний режим введення користувача для додавання, видалення та перегляду завдань.
// Після завершення введення виводяться всі завдання разом з їх назвами, пріоритетами та статусами.
require_once 'UserStatus.php';
header('Content-Type: tasks.json; charset=utf-8');

class TaskTracker
{
    // Оголошення приватних властивостей та констант
    private mixed $tasks;
    private string $filePath;

    private const COMMAND_ADD = 'add';
    private const COMMAND_DELETE = 'delete';
    private const COMMAND_VIEW = 'view';
    private const COMMAND_EXIT = 'exit';
    private const COMMAND_CHANGE = 'change status';

    public function __construct($filePath)
    {
        // Конструктор ініціалізує шлях до файлу даних та завантажує завдання з файлу
        $this->filePath = __DIR__ . DIRECTORY_SEPARATOR . $filePath;
        $this->tasks = $this->loadTasksFromFile();
    }

    public function addTask($taskName, $priority, $task, $statusInput): void
    {
        // Метод для додавання завдання
        $status = ($statusInput === 'yes') ? UserStatus::COMPLETE_NEW : UserStatus::NOT_COMPLETE_NEW;

        $task = [
            'id' => $this->getNextTaskId(),
            'name' => $taskName,
            'priority' => $priority,
            'status' => $status,
            'task' =>$task
        ];

        $this->tasks[] = [...$task];
        $this->sortTasksByPriority();
        $this->saveTasksToFile();
    }

    public function deleteTask($taskId): void
    {
        // Метод для видалення завдання
        $this->tasks = array_filter($this->tasks, function ($task) use ($taskId) {
            return $task['id'] != $taskId;
        });

        $this->saveTasksToFile();
    }

    public function getTasks()
    {
        // Метод для отримання всіх завдань, сортування та повернення їх
        usort($this->tasks, function ($task1, $task2) {
            return $task2['priority'] - $task1['priority'];
        });

        return $this->tasks;
    }

    // Методи для працювання з файлом tasks.json, для працювання з консолею
    private function loadTasksFromFile()
    {
        if (file_exists($this->filePath)) {
            $tasksData = file_get_contents($this->filePath);
            $tasks = json_decode($tasksData, true);
        } else {
            $tasks = [];
        }

        return $tasks;
    }

    // Цей метод для того, щоб зберегти данні в json
    private function saveTasksToFile(): void
    {
        $jsonData = json_encode($this->tasks, JSON_UNESCAPED_UNICODE);
        file_put_contents($this->filePath, $jsonData);
    }

    // Цей метод для того, щоб зробити в json перехід вiд одного id таска числа до iншого
    private function getNextTaskId()
    {
        if (empty($this->tasks)) {
            return 1;
        }

        $maxId = max(array_column($this->tasks, 'id'));
        return $maxId + 1;
    }

    // Цей метод для того, щоб зробити сорт в json файлі за пріоріті
    private function sortTasksByPriority(): void
    {
        usort($this->tasks, function ($task1, $task2) {
            if ($task1['priority'] === $task2['priority']) {
                return $task1['id'] - $task2['id'];
            }
            return $task2['priority'] - $task1['priority'];
        });
    }

    // Цей метод для того, щоб подивитися які в мене э таски, я зробив це за пріоріті, тому що якщо пріоріті таскає вище, то його треба зробити першим, я так думав
    public function viewTasksByPriority(): void
    {
        $tasks = $this->getTasks();

        echo "Tasks by Priority:\n";
        foreach ($tasks as $index => $task) {
            echo "";
            echo "{$index}. Task: {$task['name']}, Priority: {$task['priority']}, Status: {$task['status']}\n";
        }
    }

    // Цей метод для додання таска до json файла
    private function interactiveAddTask(): void
    {
        $taskName = readline("Enter task name: ");
        $priority = (int) readline("Enter priority: ");
        $taskDescription = readline("Enter task description: ");
        $statusInput = readline("Is the task completed? (yes/no): ");


        $this->addTask($taskName, $priority, $taskDescription, $statusInput);
        echo "Task added successfully!\n";
    }

    // Цей конструктор для deleteTaskByName(), я передаю тут name яке я хочу видалити та цей метод передаэ цей name до deleteTaskByName()
    private function interactiveDeleteTask(): void
    {
        $this->displayTasks();
        $taskToDelete = readline("Enter the task number or name to delete: ");

        if (is_numeric($taskToDelete)) {
            $this->deleteTask((int) $taskToDelete);
        } else {
            $this->deleteTaskByName($taskToDelete);
        }
    }

    // Цей конструктор для displayTasks()
    private function formatTask($index, $task): string
    {
        echo " ";
        return "{$index}. Task: {$task['name']}, Priority: {$task['priority']}, Status: {$task['status']}\n";
    }

    // Цей метод дає користувачу доступ для виведення тасків в консоль
    private function displayTasks(): void
    {
        $tasks = $this->getTasks();

        echo "Tasks:\n";
        foreach ($tasks as $index => $task) {
            echo $this->formatTask($index, $task);
        }
    }

    // Цей метод дає користувачу доступ для видалення данних про task, можно видалити за name таскає
    private function deleteTaskByName(string $taskName): void
    {
        $taskIndex = array_search($taskName, array_column($this->tasks, 'name'));
        if ($taskIndex !== false) {
            $this->deleteTask($this->tasks[$taskIndex]['id']);
            echo "Task '{$taskName}' deleted successfully!\n";
        } else {
            echo "Task '{$taskName}' not found.\n";
        }
    }

    // Цей метод дає користувачу доступ для введення даних о користувачеві
    public function interactiveTaskInput(): void
    {
        while (true) {
            $command = readline("Enter '" . self::COMMAND_ADD . "' to add a task, '" . self::COMMAND_DELETE . "' to delete a task, '" . self::COMMAND_VIEW . "' to see all the tasks, '" . self::COMMAND_CHANGE . "' to change task status or '" . self::COMMAND_EXIT . "' to quit: ");

            switch ($command) {
                case self::COMMAND_EXIT:
                    return;
                case self::COMMAND_ADD:
                    $this->interactiveAddTask();
                    break;
                case self::COMMAND_DELETE:
                    $this->interactiveDeleteTask();
                    break;
                case self::COMMAND_VIEW:
                    $this->viewTasksByPriority();
                    break;
                case self::COMMAND_CHANGE:
                    $this->interactiveChangeTaskStatus();
                    break;
                default:
                    echo "Unknown command. Please enter '" . self::COMMAND_ADD . "', '" . self::COMMAND_DELETE . "', '" . self::COMMAND_VIEW . "', '" . self::COMMAND_CHANGE . "' or '" . self::COMMAND_EXIT . "'.\n";
            }
        }
    }

    // Цей метод змiнюэ статус задачi
    public function changeTaskStatus($taskId, $newStatus): void
    {
        $taskIndex = array_search($taskId, array_column($this->tasks, 'id'));

        if ($taskIndex !== false) {
            $this->tasks[$taskIndex]['status'] = $newStatus;
            $this->saveTasksToFile();
            echo "Task status updated successfully!\n";
        } else {
            echo "Task with ID '{$taskId}' not found.\n";
        }
    }

    // Цей метод змiнюэ статус задачi
    public function interactiveChangeTaskStatus(): void
    {
        $this->displayTasks();
        $taskToUpdate = readline("Enter the task number or ID to change status: ");

        $taskIndex = is_numeric($taskToUpdate) ? (int)$taskToUpdate : null;

        if ($taskIndex !== null) {
            $taskId = $this->tasks[$taskIndex]['id'];
            $newStatus = readline("Enter new status (виконано/не виконано): ");
            if ($newStatus === 'виконано' || $newStatus === 'не виконано') {
                $this->changeTaskStatus($taskId, $newStatus);
            } else {
                echo "Invalid status input. Please enter 'виконано' or 'не виконано'.\n";
            }
        } else {
            echo "Invalid task number or ID.\n";
        }
    }

}

