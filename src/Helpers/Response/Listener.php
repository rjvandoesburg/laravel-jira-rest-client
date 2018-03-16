<?php

namespace Atlassian\JiraRest\Helpers\Response;

use Illuminate\Support\Arr;

class Listener implements \JsonStreamingParser\Listener
{
    /**
     * The current key that is being parsed
     *
     * @var string
     */
    protected $key;

    /**
     * An stack of keys where the next value should go
     *
     * @var array
     */
    protected $keys;

    /**
     * The current object level
     *
     * @var int
     */
    protected $objectLevel;

    /**
     * The callback used to parse top level attributes
     *
     * @var callback|callable
     */
    protected $attributeCallback = null;

    /**
     * The callback used to parse a nested object
     *
     * @var callback|callable
     */
    protected $objectCallback = null;

    /**
     * The index of the object we want to start parsing
     *
     * @var string
     */
    protected $parseIndex = null;

    /**
     * Check if we are currently parsing the object
     *
     * @var bool
     */
    protected $parsingObject = false;

    /**
     * Counter to know what the 'top' level is we want to parse
     *
     * @var int
     */
    protected $topObjectLevel = 0;

    /**
     * The current object that is being parsed
     *
     * @var array
     */
    protected $currentObject = [];

    /**
     * An array that keeps track of the current index for the array
     *
     * @var array
     */
    protected $arrayIndexes = [];

    /**
     * Flag that tells the endArray method if we need to pop an extra key off the keys stack
     *
     * @var bool
     */
    protected $arrayIndexPushed = false;

    /**
     * Set the callback to use for top level attributes
     *
     * @param $callback
     *
     * @return \Atlassian\JiraRest\Helpers\Response\Listener
     */
    public function setAttributeCallback($callback)
    {
        $this->attributeCallback = $callback;

        return $this;
    }

    /**
     * Set the callback for the objects
     * @param $callback
     * @param string $objectKey The key of the object that needs to be parsed
     *
     * @return \Atlassian\JiraRest\Helpers\Response\Listener
     */
    public function setObjectCallback($callback, $objectKey = null)
    {
        $this->objectCallback = $callback;
        $this->parseIndex = $objectKey;
        if ($objectKey === null) {
            $this->parsingObject = true;
            $this->topObjectLevel = 1;
        }

        return $this;
    }

    public function startDocument()
    {
        $this->key = null;
        $this->keys = [];
        $this->objectLevel = 0;
        $this->currentObject = [];
        $this->arrayIndexes = [];
        if ($this->parseIndex === null) {
            $this->parsingObject = true;
            $this->topObjectLevel = 1;
        }
    }

    public function endDocument()
    {
        $this->key = null;
        $this->keys = [];
        $this->objectLevel = 0;
        $this->currentObject = [];
        $this->arrayIndexes = [];
        if ($this->parseIndex === null) {
            $this->parsingObject = true;
            $this->topObjectLevel = 1;
        }
    }

    public function startObject()
    {
        $this->objectLevel++;

        // Are we parsing the object we want
        if ($this->parsingObject) {
            if ($this->key !== null) {
                // Push the current key to the list of keys
                array_push($this->keys, $this->key);
            }

            // Check if we are dealing with an array
            if (array_key_exists($this->objectLevel, $this->arrayIndexes)) {
                array_push($this->keys, $this->arrayIndexes[$this->objectLevel]);
                // We pushed an array index, so flag it so
                $this->arrayIndexPushed = true;
                $this->arrayIndexes[$this->objectLevel] += 1;
            }
        }

        // Are we on the object key we want to parse and are we not parsing yet (i.e. not nested)
        // We only want to start parsing once we've passed the key
        if (($this->parseIndex === null || $this->key === $this->parseIndex) && !$this->parsingObject) {
            $this->parsingObject = true;
            // create a new object
            $this->topObjectLevel = $this->objectLevel;
        }
    }

    public function endObject()
    {
        array_pop($this->keys);

        if ($this->parsingObject && $this->objectLevel === $this->topObjectLevel) {
            if ($this->objectCallback !== null) {
                call_user_func($this->objectCallback, $this->currentObject);
            }

            // Reset the current object and the keys
            $this->currentObject = [];
            $this->keys = [];
        }

        // Reset the key
        $this->key = null;

        $this->objectLevel--;
    }

    public function startArray()
    {
        if ($this->parsingObject && $this->objectLevel > 0) {
            // Objectlevel + 1 because we want the child level
            $this->arrayIndexes[$this->objectLevel + 1] = 0;
            $key = $this->key;

            if (!empty ($this->keys)) {
                $key = implode('.', $this->keys) .'.'.$this->key;
            }

            // Create an empty array for the current key
            Arr::set($this->currentObject, $key, []);
        }
    }

    public function endArray()
    {
        // Check if the array index was pushed
        if ($this->arrayIndexPushed) {
            array_pop($this->keys);
        }
        // Objectlevel + 1 because we want the child level
        Arr::forget($this->arrayIndexes, $this->objectLevel + 1);

        $this->key = null;
        $this->arrayIndexPushed = false;
    }

    /**
     * @param string $key
     */
    public function key($key)
    {
        $this->key = $key;
    }

    /**
     * @param mixed $value
     */
    public function value($value)
    {
        // Replace a string with the php value
        switch ($value) {
            case 'true':
                $value = true;
                break;
            case 'false':
                $value = false;
                break;
            case 'null':
                $value = null;
                break;
        }

        // If the top level is an object, return the key values
        if ($this->objectLevel === 1 && $this->parseIndex !== null) {
            if ($this->attributeCallback !== null) {
                call_user_func_array($this->attributeCallback, [$this->key, $value]);
            }
            return;
        }

        $key = $this->key;
        if (!empty ($this->keys)) {
            $key = implode('.', $this->keys) .'.'.$this->key;
        }

        $currentValue = Arr::get($this->currentObject, $key);

        // check if we are dealing with an array, if so push the value instead of setting it directly
        if (is_array($currentValue)) {
            array_push($currentValue, $value);
            $value = $currentValue;
        }

        // Set the value for the key
        Arr::set($this->currentObject, $key, $value);
    }

    /**
     * @param string $whitespace
     */
    public function whitespace($whitespace)
    {
    }
}
