<?php

namespace Smark\Smark;

/**
 * $cache = new Cache('file');
 * $cache->set('name', 'John Doe');
 * echo $cache->get('name'); // Outputs: John Doe
 */

// Cache class to handle caching using different storage mechanisms
class Cache {
    // Protected variable to hold the storage instance (FileCache or MemoryCache)
    protected $storage;

    // Constructor to initialize the cache storage type
    public function __construct($storage = 'file') {
        // Check if the specified storage type is 'file'
        if ($storage === 'file') {
            // If so, create a new instance of FileCache and assign it to $storage
            $this->storage = new FileCache();
        // Check if the specified storage type is 'memory'
        } elseif ($storage === 'memory') {
            // If so, create a new instance of MemoryCache and assign it to $storage
            $this->storage = new MemoryCache();
        }
    }

    // Method to set a value in the cache using a specific key
    public function set($key, $value) {
        // Delegate the set operation to the current storage instance
        $this->storage->set($key, $value);
    }

    // Method to retrieve a value from the cache using a specific key
    public function get($key) {
        // Delegate the get operation to the current storage instance and return the result
        return $this->storage->get($key);
    }
}

// FileCache class for file-based caching implementation
class FileCache {
    // Method to store a value in the cache file
    public function set($key, $value) {
        // Serialize the value and write it to a file named after the key
        file_put_contents("cache/{$key}.cache", serialize($value));
    }

    // Method to retrieve a value from the cache file
    public function get($key) {
        // Construct the filename for the cache file
        $file = "cache/{$key}.cache";
        // Check if the cache file exists
        return file_exists($file) ? 
            // If it exists, read the file, unserialize the content, and return it
            unserialize(file_get_contents($file)) : 
            // If it doesn't exist, return null
            null;
    }
}

// MemoryCache class for in-memory caching implementation
class MemoryCache {
    // Protected array to hold cached data in memory
    protected $data = [];

    // Method to store a value in memory using a specific key
    public function set($key, $value) {
        // Store the value in the data array with the specified key
        $this->data[$key] = $value;
    }

    // Method to retrieve a value from memory using a specific key
    public function get($key) {
        // Return the value associated with the key if it exists; otherwise, return null
        return $this->data[$key] ?? null;
    }
}