<?php



class App
{
    protected array $routs = [
        '/news' => 'getNews',
        '/' => 'mainPage'
    ];
    public function handleRequest(array $request, ?callable $callback = null)
    {
        $path = $request['url']; // /news
        if (is_callable($callback)) {
            $callback($request);
        }
        return $this->{$this->routs[$path]}();

    }

    public function mainPage()
    {
        return '<body>Головна сторінка</body>';
    }

    public function getNews()
    {
        return [
            'news1' => [
                'title' => 'Соняшно',
                'text' => 'dsfsfsdfgsfgdfsgfd'
            ],
            'news2' => [
                'title' => 'Пахмурно',
                'text' => 'dsfsfsdfgsfgdfsgfd'
            ],
        ];
    }
}

$logger = [];
$callback = function ($request) use (&$logger){
    $prev = $logger[$request['url']] ?? [];
    $count = $prev['counter'] ?? 0;
    $stack = $prev['stack'] ?? [];
    $stack[] = $request;
    $logger[$request['url']] = [
        'counter' => ++$count,
        'stack' => $stack
    ];
};



$app = new App();

$response = $app->handleRequest(['url' => '/news', 'date' => rand()], $callback);
$response = $app->handleRequest(['url' => '/', 'date' => rand()], $callback);
$response = $app->handleRequest(['url' => '/news', 'date' => rand()], $callback);
$response = $app->handleRequest(['url' => '/', 'date' => rand()], $callback);

$response = $app->handleRequest(['url' => '/', 'date' => rand()], $callback);


exit;