<?php

namespace App\Services;

class FileStorageService
{
    private $sourcePath;

    public function __construct()
    {
        $this->sourcePath = storage_path('app/todos');
        if (!file_exists($this->sourcePath)) {
            mkdir($this->sourcePath, 0755, true);
        }
    }

    public function getAll()
    {
        $todosList = [];

        $todosEntries = glob($this->sourcePath . '/*.json');

        foreach ($todosEntries as $entry) {
            $content = file_get_contents($entry);
            $todo = json_decode($content, true);
            $todosList[] = $todo;
        }

        usort($todosList, function ($a, $b) {
            return strtotime($b['created_at']) <=> strtotime($a['created_at']);
        });
        return $todosList;
    }

    public function get($id)
    {
        $filepath = $this->sourcePath . '/' . $id . '.json';
        if (file_exists($filepath)) {
            $content = file_get_contents($filepath);
            return json_decode($content, true);
        }
        return null;
    }

    public function create(array $data){
        $id = uniqid();
        $todo = [
            'id' => $id,
            'title' => $data['title'],
            'description' => $data['description'],
            'created_at' => date('Y-m-d H:i:s'),
            'completed' => false,
            'updated_at'=> date('Y-m-d H:i:s')
        ];

        $filepath = $this->sourcePath . '/' . $id . '.json';
        file_put_contents($filepath, json_encode($todo));

        return $todo;
    }

    public function update($id, array $data)
    {
        $todo = $this->get($id);
        if (!$todo) {
            return null;
        }
        $todo = array_merge($todo, $data);

        $todo['updated_at'] = date('Y-m-d H:i:s');

        $filepath = $this->sourcePath . '/' . $id . '.json';
        file_put_contents($filepath, json_encode($todo));

        return $todo;
    }

    public function toggle($id) {
        $todo = $this->get($id);
        if (!$todo) {
            return null;
        }
        $todo['completed'] = !$todo['completed'];
        $todo['updated_at'] = date('Y-m-d H:i:s');

        $filepath = $this->sourcePath . '/' . $id . '.json';
        file_put_contents($filepath, json_encode($todo));

        return $todo;
    }
    public function destroy($id){
        $filepath = $this->sourcePath . '/' . $id . '.json';
        if (file_exists($filepath)) {
            unlink($filepath);
            return true;
        }
        return false;
    }
}
