<?php

namespace App\Services;

class SysQueueService
{
    private $queueFile;

    public function __construct($queueFile = __DIR__ . '/../cache/queue.json')
    {
        $this->queueFile = $queueFile;
        if (!file_exists($this->queueFile)) {
            file_put_contents($this->queueFile, json_encode([]));
        }
    }

    public function push($task)
    {
        $queue = json_decode(file_get_contents($this->queueFile), true);
        $queue[] = $task;
        file_put_contents($this->queueFile, json_encode($queue));
    }

    public function process()
    {
        $queue = json_decode(file_get_contents($this->queueFile), true);
        foreach ($queue as $task) {
            // Aqui você deve implementar o processamento da tarefa
            // Por exemplo, chamar uma função ou executar um comando
            // Em seguida, remover a tarefa da fila
        }
        file_put_contents($this->queueFile, json_encode([]));
    }
}
