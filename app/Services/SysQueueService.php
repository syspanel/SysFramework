<?php

/***************************************************************************
 * SysFramework - PHP Framework                                            *
 * ======================================================================= *
 *                                                                          *
 * PHP Framework                                                            *
 * (c) 2025 Marco Costa  |  sysframework@syspanel.com.br                    *
 * Website: https://sysframework.syspanel.com.br                            *
 *                                                                          *
 * Licensed under the MIT License                                           *
 *                                                                          *
 * Permission is hereby granted, free of charge, to any person obtaining    *
 * a copy of this software and associated documentation files (the          *
 * "Software"), to deal in the Software without restriction, including      *
 * without limitation the rights to use, copy, modify, merge, publish,      *
 * distribute, sublicense, and/or sell copies of the Software, and to       *
 * permit persons to whom the Software is furnished to do so, subject to    *
 * the following conditions:                                                *
 *                                                                          *
 * The above copyright notice and this permission notice shall be included  *
 * in all copies or substantial portions of the Software.                   *
 *                                                                          *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS  *
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF               *
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.   *
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY     *
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,     *
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE        *
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.                   *
 ***************************************************************************/

namespace App\Services;

class SysQueueService
{
    private $queueFile;
    private $logFile;

    public function __construct(
        $queueFile = __DIR__ . '/../cache/queue.json',
        $logFile   = __DIR__ . '/../cache/queue.log'
    ) {
        $this->queueFile = $queueFile;
        $this->logFile = $logFile;

        if (!file_exists($this->queueFile)) {
            file_put_contents($this->queueFile, json_encode([]));
        }
    }

    public function push($task)
    {
        $queue = $this->readQueue();
        $queue[] = $task;
        $this->writeQueue($queue);
        $this->log("Task pushed: " . json_encode($task));
    }

    public function process(callable $callback)
    {
        $queue = $this->readQueue();

        foreach ($queue as $task) {
            try {
                call_user_func($callback, $task);
                $this->log("Task processed: " . json_encode($task));
            } catch (\Exception $e) {
                $this->log("Task error: " . $e->getMessage());
            }
        }

        // Clear the queue after processing
        $this->writeQueue([]);
    }

    private function readQueue()
    {
        $file = fopen($this->queueFile, 'r');
        flock($file, LOCK_SH);
        $data = json_decode(file_get_contents($this->queueFile), true);
        flock($file, LOCK_UN);
        fclose($file);

        return is_array($data) ? $data : [];
    }

    private function writeQueue(array $queue)
    {
        $file = fopen($this->queueFile, 'w');
        flock($file, LOCK_EX);
        fwrite($file, json_encode($queue, JSON_PRETTY_PRINT));
        flock($file, LOCK_UN);
        fclose($file);
    }

    private function log($message)
    {
        $date = date('Y-m-d H:i:s');
        file_put_contents($this->logFile, "[$date] $message\n", FILE_APPEND);
    }
}
