<?php

namespace App\Services;

use Firebase\Firestore\FirestoreClient;

class FileStorageService
{
    protected $firestore;
    protected $collectionName = 'todos';

    public function __construct(FirestoreClient $firestore)
    {
        $this->firestore = $firestore;
    }

    public function getAll(string $userId)
    {
        $collection = $this->firestore->collection($this->collectionName);
        $query = $collection->where('user_id', '=', $userId);
        $snapshot = $query->documents();

        $todosList = [];
        foreach ($snapshot as $document) {
            if ($document->exists()) {
                $todosList[] = $document->data() + ['id' => $document->id()];
            }
        }
        return $todosList;
    }

    public function get($id)
    {
        $document = $this->firestore->collection($this->collectionName)->document($id)->snapshot();
        if ($document->exists()) {
            return $document->data() + ['id' => $document->id()];
        }
        return null;
    }

    public function create(string $userId, array $data)
    {
        $collection = $this->firestore->collection($this->collectionName);
        $documentReference = $collection->add([
            'user_id' => $userId,
            'title' => $data['title'] ?? '', // Use null coalescing operator for safety
            'description' => $data['description'] ?? '', // Use null coalescing operator for safety
            'created_at' => now()->toDateTimeString(),
            'completed' => false,
            'updated_at' => now()->toDateTimeString(),
        ]);

        return $documentReference->id();
    }

    public function update($id, array $data)
    {
        $documentReference = $this->firestore->collection($this->collectionName)->document($id);
        $documentSnapshot = $documentReference->snapshot();

        if (!$documentSnapshot->exists()) {
            return null;
        }

        $updateData = [
            'title' => $data['title'] ?? $documentSnapshot->data()['title'] ?? '',
            'description' => $data['description'] ?? $documentSnapshot->data()['description'] ?? '',
            'updated_at' => now()->toDateTimeString(),
            'completed' => $data['completed'] ?? $documentSnapshot->data()['completed'] ?? false,
        ];

        $documentReference->update($updateData);

        return $this->get($id); // Return the updated document
    }

    public function toggle($id)
    {
        $documentReference = $this->firestore->collection($this->collectionName)->document($id);
        $documentSnapshot = $documentReference->snapshot();

        if (!$documentSnapshot->exists()) {
            return null;
        }

        $currentCompleted = $documentSnapshot->data()['completed'] ?? false;

        $documentReference->update([
            'completed' => !$currentCompleted,
            'updated_at' => now()->toDateTimeString(),
        ]);

        return $this->get($id); // Return the updated document
    }

    public function destroy($id)
    {
        $documentReference = $this->firestore->collection($this->collectionName)->document($id);
        $documentSnapshot = $documentReference->snapshot();

        if (!$documentSnapshot->exists()) {
            return false; // Or maybe throw an exception
        }

        $documentReference->delete();
        return true;
    }
}
