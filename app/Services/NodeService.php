<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/23/2019
 * Time: 12:54 AM
 */

namespace App\Services;

use App\Node;

class NodeService
{
    /**
     * Wraps firstOrNew in order to better control which parameters are used to first the existing model.
     *
     * @param int   $id
     * @param array $data
     *
     * @return Node
     */
    public function firstOrCreate(int $id, array $data)
    {
        return Node::firstOrCreate(compact('id'), $data);
    }
}
