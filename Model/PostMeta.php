<?php
/**
 * Post Meta model
 *
 * PHP 5
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) 2012-2014, Hurad (http://hurad.org)
 * @link      http://hurad.org Hurad Project
 * @since     Version 0.1.0
 * @license   http://opensource.org/licenses/MIT MIT license
 */
App::uses('AppModel', 'Model');

/**
 * Class PostMeta
 */
class PostMeta extends AppModel
{
    /**
     * Custom database table name, or null/false if no table association is desired.
     *
     * @var string
     */
    public $useTable = 'post_meta';

    /**
     * List of behaviors to load when the model object is initialized. Settings can be
     * passed to behaviors by using the behavior name as index. Eg:
     *
     * public $actsAs = array('Translate', 'MyBehavior' => array('setting1' => 'value1'))
     *
     * @var array
     */
    public $actsAs = ['KeyValueStorage' => ['key' => 'meta_key', 'value' => 'meta_value', 'foreign_key' => 'post_id']];

    /**
     * Detailed list of belongsTo associations.
     *
     * @var array
     */
    public $belongsTo = [
        'Post' => [
            'className' => 'Post',
            'foreignKey' => 'post_id',
        ]
    ];

    public function getPostMeta($post_id, $meta_key)
    {
        $this->recursive = -1;
        return $this->find(
            'first',
            [
                'fields' => ['meta_value'],
                'conditions' => [
                    'PostMeta.post_id' => $post_id,
                    'PostMeta.meta_key' => $meta_key,
                ]
            ]
        );
    }
}
