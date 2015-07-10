<?php

/**
 * abstract class RosetteParamsSetBase.
 *
 * The base class for the parameter classes that are used for Rosette API operations.
 *
 * @copyright 2014-2015 Basis Technology Corporation.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at
 * @license http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software distributed under the License is
 * distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and limitations under the License.
 **/

namespace rosette\api;

/**
 * Class RosetteParamsSetBase.
 */
abstract class RosetteParamsSetBase
{
    /**
     * Internal params array.
     *
     * @var array
     */
    protected $params = array();

    /**
     * Constructor.
     *
     * @param $repertoire
     */
    protected function __construct($repertoire)
    {
        foreach ($repertoire as $key) {
            $this->params[$key] = '';
        }
    }

    /**
     * Custom setter for the key/value parameter pair.
     *
     * @param $key
     * @param $val
     *
     * @throws RosetteException
     */
    public function set($key, $val)
    {
        if (!array_key_exists($key, $this->params)) {
            throw new RosetteException(
                sprintf('Unknown Api parameter key %s', $key),
                RosetteException::$BAD_REQUEST_FORMAT
            );
        }
        $this->params[$key] = $val;
    }

    /**
     * Custom getter for the key/value parameter pair.
     *
     * @param $key
     *
     * @return mixed
     *
     * @throws RosetteException
     */
    public function get($key)
    {
        if (!array_key_exists($key, $this->params)) {
            throw new RosetteException(
                sprintf('Unknown Api parameter key %s', $key),
                RosetteException::$BAD_REQUEST_FORMAT
            );
        }

        return $this->params[$key];
    }

    /**
     * Validates parameters before serializing them.
     *
     * @return mixed
     *
     * @throws RosetteException
     */
    abstract public function validate();

    /**
     * Serialize into a json string.
     *
     * @param bool $skip_null if null values should be skipped
     *
     * @return string
     */
    public function serialize($skip_null = true)
    {
        $this->validate();

        return json_encode($skip_null ? array_filter($this->params) : $this->params);
    }
}
