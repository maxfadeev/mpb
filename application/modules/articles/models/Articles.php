<?php


namespace Application\Modules\Articles\Models;


use Phalcon\Mvc\Model;

class Articles extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $uid;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $created_at;

    /**
     * @var string
     */
    public $updated_at;

    /**
     * @var integer
     */
    public $page_views;

    public function initialize()
    {
        // set values of these attributes by default
        $this->skipAttributesOnCreate(['created_at', 'updated_at', 'page_views']);

        $this->belongsTo('uid', 'Application\Modules\Users\Models\Users', 'id');
    }
} 